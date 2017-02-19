<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\HarvestingService;
use \Carbon\Carbon;

class HarvestingServiceTest extends ResourceBaseHelper
{
    protected $now;
    protected $type;
    protected $service;

    public function setUp()
    {
        parent::setUp();

        $this->now = Carbon::now();
        $this->type = $this->mockResourceType();
        $this->service = new HarvestingService(new User([]));
    }

    public function testHarvestNothing()
    {
        $results = $this->service->doHarvest([]);

        $this->assertEquals(0, sizeof($results));
    } // end testHarvestNothing

    public function testNoYieldHarvest()
    {
        $resource = $this->mockResource(['last_harvested_at' => $this->now]);
        $results = $this->service->doHarvest([clone $resource], $this->now);

        $this->assertEquals($resource->quantity, $results[0]->quantity);
    } // end testNoYieldHarvest

    public function testOnePeriodHarvest()
    {
        $period_ago = $this->now->copy()->subSeconds($this->type->base_harvest_interval + 1);
        $resource = $this->mockResource([
            'last_harvested_at' => $period_ago,
            'type' => $this->type,
            'quantity' => 50,
        ]);
        $expected_addition = $resource->getProjectedHarvestAmount($this->now);
        $results = $this->service->doHarvest([clone $resource], $this->now);

        $this->assertEquals($resource->quantity + $resource->getProjectedHarvestAmount(), $results[0]->quantity);
    } // end testOnePeriodHarvest
} // end UserTest
