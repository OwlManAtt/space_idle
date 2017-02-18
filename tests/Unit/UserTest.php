<?php

namespace Tests\Unit;

use Mockery as m;
use App\Repositories\UserRepository;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    private function getSocialiteUser()
    {
        return m::mock('StdClass', function($mock) 
        {
            $mock->id = '12345';
            $mock->nickname = null;
            $mock->name = 'Owls';
            $mock->avatar = 'https://cdn.abcdefjiakjdhdjhahkdjhd.abchjd/aAaAAa/icon.png?size=20';
            $mock->email = 'test@example.org';
        });
    } // end getSocialiteUser

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
} // end UserTest
