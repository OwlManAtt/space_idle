<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use Carbon\Carbon;
use App\Models\Resource;
use App\Models\ResourceType;
use Illuminate\Support\Facades\DB;

class ResourceRepository extends BaseRepository
{
    public static function getInitialResources()
    {
        $resources = [];

        $types = ResourceType::where('basic', true)->get();
        foreach ($types as $type) {
            $resources[] = new Resource([
                'resource_type_id' => $type->id,
                'last_harvested_at' => Carbon::now(),
                'penultimate_harvested_at' => Carbon::now(),
                'quantity' => $type->base_harvest_amount,
            ]);
        }

        return $resources;
    } // end getInitialResources

    public static function updateResources($resources)
    {
        return DB::transaction(function () use ($resources) {
            $resources->map(function ($res) {
                $res->save();
            });
        });
    } // end updateResources
} // end User
