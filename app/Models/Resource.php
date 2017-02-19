<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class Resource extends Model
{
    /**
     * No mass-assign guard on this -- I have no intention
     * to use form data to populate data for Resource, ever.
     */
    protected $guarded = [];
    protected $with = ['type'];
    protected $dates = ['last_harvested_at', 'penultimate_harvested_at',];
    public $timestamps = false;
    const MAX_PERIODS = 96; // @TODO: stupid place for this

    public function user()
    {
        return $this->belongsTo(User::class);
    } // end user

    public function type()
    {
        return $this->belongsTo(ResourceType::class, 'resource_type_id', 'id');
    } // end type

    public function isHarvestable($now = null)
    {
        return $this->getHarvestablePeriods($now) > 0;
    } // end isHarvestable

    public function getProjectedHarvestAmount($now = null)
    {
        $periods = $this->getHarvestablePeriods($now);
        if ($periods > self::MAX_PERIODS) {
            $periods = self::MAX_PERIODS;
        }

        return floor(($periods * $this->type->base_harvest_amount) * $this->getDrMultiplier());
    } // end getProtectedHarvestAmount

    public function getHarvestablePeriods(Carbon $now = null)
    {
        $now = $now ?? Carbon::now();

        $time_diff = $now->diffInSeconds($this->last_harvested_at);
        $periods = (int)floor($time_diff / $this->type->base_harvest_interval);

        if ($periods > self::MAX_PERIODS) {
            $periods = self::MAX_PERIODS;
        }

        return $periods;
    } // end getPeriods

    /**
     * Diminishing returns multiplier.
     *
     * @return float
     */
    public function getDrMultiplier()
    {
        $last_harvest_diff = $this->last_harvested_at->diffInSeconds($this->penultimate_harvested_at);
        $claimed_periods = $last_harvest_diff / $this->type->base_harvest_interval;
        if ($claimed_periods > self::MAX_PERIODS) {
            $claimed_periods = self::MAX_PERIODS;
        }

        $pct_of_total_periods = $claimed_periods / self::MAX_PERIODS;

        return 1 - ($pct_of_total_periods * 0.5);
    } // end getDrMultiplier

    /*
    public function getLastHarvestedAt()
    {
        return new Carbon($this->last_harvested_at);
    } // end getLastHarvestedAt

    public function getPenultimateHarvestedAt()
    {
        return new Carbon($this->penultimate_harvested_at);
    } // end getPenultimateHarvestedAt
    */

    /**
     * Array representation appropriate for JSON/templates.
     */
    public function toArray($now = null)
    {
        return [
            'short_code' => $this->type->short_code,
            'icon' => $this->type->icon,
            'name' => $this->type->name,
            'description' => $this->type->description,
            'quantity_stored' => $this->quantity,
            'projected_harvest' => $this->getProjectedHarvestAmount($now),
            'harvestable' => $this->isHarvestable($now),
            'diminishing_return_modifier' => $this->getDrMultiplier($now),
        ];
    } // end toArray
}
