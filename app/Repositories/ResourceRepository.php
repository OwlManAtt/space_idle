<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use Carbon\Carbon;
use App\Models\Resource;
use App\Models\ResourceType;

class ResourceRepository extends BaseRepository 
{
    public static function getInitialResources()
    {
        $resources = [];

        $types = ResourceType::where('basic', true)->get();
        foreach ($types as $type)
        {
            $resources[] = new Resource([
                'resource_type_id' => $type->id,
                'last_harvested_at' => Carbon::now(),
                'penultimate_harvested_at' => Carbon::now(),
                'quantity' => $type->base_harvest_amount,
            ]);
        }

        return $resources;
    } // end getInitialResources
} // end User
