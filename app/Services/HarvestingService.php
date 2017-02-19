<?php
namespace App\Services;

use App\Models\User;
use \Carbon\Carbon;

class HarvestingService
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    } // end __construct

    public function doHarvest($resources, $now = null)
    {
        $now = $now ?? Carbon::now();

        for ($i = 0; $i < sizeof($resources); $i++) {
            $resources[$i]->quantity += $resources[$i]->getProjectedHarvestAmount($now);
            $resources[$i]->penultimate_harvested_at = $resources[$i]->last_harvested_at;
            $resources[$i]->last_harvested_at = $now;
        }

        return $resources;
    } // end doHarvest
} // end HarvestingService
