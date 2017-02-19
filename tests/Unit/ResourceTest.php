<?php

namespace Tests\Unit;

use Mockery as m;
use App\Models\Resource;
use App\Models\ResourceType;
use Tests\TestCase;
use \Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ResourceTest extends TestCase
{
    use DatabaseMigrations;

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

    private function mockResource($values = [])
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

    private function mockResourceType($short_code = 'ore')
    {
        // Migration loads seeds for this table
        return ResourceType::where('short_code', $short_code)->first();
    }

    /*
    public function testRegistration()
    {
        $provider = 'testProvider';
        $userData = $this->getSocialiteUser();

        $user = UserRepository::findByUsernameOrCreate($provider, $userData);
        $this->assertInstanceOf(\App\Models\User::class, $user);

        $registered_user_id = $user->id;

        $user = UserRepository::findByUsernameOrCreate($provider, $userData);
        $this->assertEquals($registered_user_id, $user->id);
    } // end testRegistration

    public function testRegistrationCreatesResources()
    {
        $userData = $this->getSocialiteUser();
        $user = UserRepository::findByUsernameOrCreate('testProvider', $userData);

        $this->assertGreaterThan(0, sizeof($user->resources()->get()));
    } // end signupCreatesResources
     */
} // end UserTest
