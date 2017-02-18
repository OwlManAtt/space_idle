<?php
namespace App;

use Illuminate\Contracts\Auth\Guard;
use Socialite;
use Request;
use App\Models\User;
use App\Repositories\UserRepository;

class AuthenticateUser
{
    private $auth;
    private $user_model;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    } // end __construct

    public function execute($request, $listener, $provider)
    {
        if ($request == false) {
            return $this->getAuthorizationFirst($provider);
        }

        $user = UserRepository::findByUsernameOrCreate($provider, $this->getSocialUser($provider));
        $this->auth->login($user, true);

        return $listener->userHasLoggedIn($user);
    } // end execute

    public function endSession($listener)
    {
        $this->auth->logout();

        return $listener->userHasLoggedOut();
    } // end endSession

    private function getAuthorizationFirst($provider)
    {
        return Socialite::driver($provider)->redirect();
    } // end getAuthorizationFirst

    private function getSocialUser($provider)
    {
        return Socialite::driver($provider)->user();
    } // end getSocialUser
} // end AuthenticateUser
