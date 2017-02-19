<?php

namespace Tests\Unit;

use Mockery as m;
use App\Models\Resource;
use App\Models\ResourceType;
use \Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

abstract class ResourceBaseHelper extends TestCase
{
    use DatabaseMigrations;

    protected function mockResource($values = [])
    {
        $now = Carbon::now();

        $values = array_merge([
            'type' => $this->mockResourceType(),
            'quantity' => 5,
            'last_harvested_at' => $now,
            'penultimate_harvested_at' => $now,
        ], $values);
        // print_r($values);

        return new Resource($values);
    } // end mockResource

    protected function mockResourceType($short_code = 'ore')
    {
        // Migration loads seeds for this table
        return ResourceType::where('short_code', $short_code)->first();
    }

} // end ResourceBaseHelper
