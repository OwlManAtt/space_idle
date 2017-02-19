<?php

namespace Tests\Unit;

use Mockery as m;
use App\Models\Resource;
use \Carbon\Carbon;

class ResourceTest extends ResourceBaseHelper 
{
    public function testHarvestablePeriods()
    {
        $now = Carbon::now();
        $type = $this->mockResourceType();

        $resource = $this->mockResource(['last_harvested_at' => $now]);
        $this->assertEquals(0, $resource->getHarvestablePeriods($now));

        $period_ago = $now->copy()->subSeconds($type->base_harvest_interval + 1);
        $resource = $this->mockResource(['last_harvested_at' => $period_ago, 'type' => $type]);
        $this->assertEquals(1, $resource->getHarvestablePeriods($now));

        $period_ago = $now->copy()->subSeconds(($type->base_harvest_interval * 10) + 1);
        $resource = $this->mockResource(['last_harvested_at' => $period_ago, 'type' => $type]);
        $this->assertGreaterThan(1, $resource->getHarvestablePeriods($now));

        $period_ago = $now->copy()->subSeconds(($type->base_harvest_interval * 97) + 1);
        $resource = $this->mockResource(['last_harvested_at' => $period_ago, 'type' => $type]);
        $this->assertEquals(Resource::MAX_PERIODS, $resource->getHarvestablePeriods($now));
    } // end testIsHarvestable

    public function testIsHarvestable()
    {
        $now = Carbon::now();

        $resource = $this->mockResource(['last_harvested_at' => $now]);
        $this->assertEquals(false, $resource->isHarvestable($now));

        $type = $this->mockResourceType();
        $period_ago = $now->copy()->subSeconds($type->base_harvest_interval + 1);
        $resource = $this->mockResource(['last_harvested_at' => $period_ago, 'type' => $type]);
        $this->assertEquals(true, $resource->isHarvestable($now));
    } // end testIsHarvestable

} // end UserTest
