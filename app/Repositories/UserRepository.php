<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\ResourceRepository;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository 
{
    public static function updateProfile($profile, $user)
    {
        $user->fill($profile);
        $user->signup_complete = true;
        $user->save();

        return $user;
    } // end updateUserProfile

    public static function findByUserNameOrCreate($provider, $userData)
    {
        $user = User::where('provider_id', '=', $userData->id)->where('provider', '=', $provider)->first();
        if ($user == null)
        {
            $user = self::createNewUser($provider, $userData);
        } // not found

        return self::checkIfUserNeedsUpdating($userData, $user);
    } // end findByUserNameOrCreate

    public static function createNewUser($provider, $userData)
    {
        // New users start with the basic resources.
        $basics = ResourceRepository::getInitialResources();
        
        return DB::transaction(function() use ($provider, $userData, $basics) {
            $user = new User();
            $user->provider = $provider;
            $user->provider_id = $userData->id;
            $user->display_name = $userData->nickname ?? $userData->name ?? 'Beautiful User';
            $user->email = $userData->email;
            $user->avatar = $userData->avatar;
            
            $user->save();
            $user->resources()->saveMany($basics);
            
            return $user; 
        });
    } // end createNewUser

    public static function checkIfUserNeedsUpdating($userData, $user)
    {
        // Only care about email matching. Other fields can diverge if the user wants.
        if ($userData->email != $user->email)
        {
            $user->email = $socialData['email'];
            $user->save();

            return $user;
        }

        return $user;
    } // end checkIfUserNeedsUpdating
} // end User
