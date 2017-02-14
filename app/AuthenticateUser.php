<?php
namespace App;

// use IlluminateContractsAuthGuard; 
use Illuminate\Contracts\Auth\Guard;
use Socialite;
use Request;
use App\Models\User;

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
        if($request == false)
        {
            return $this->getAuthorizationFirst($provider);
        }

        $user = User::findByUsernameOrCreate($provider, $this->getSocialUser($provider));
        $this->auth->login($user, true);

        return $listener->userHasLoggedIn($user);
    } // end execute

    private function getAuthorizationFirst($provider) 
    {
        return Socialite::driver($provider)->redirect();
    } // end getAuthorizationFirst

    private function getSocialUser($provider)
    {
        return Socialite::driver($provider)->user();
    } // end getSocialUser
} // end AuthenticateUser
