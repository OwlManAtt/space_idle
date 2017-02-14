<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable 
{
    protected $fillable = ['provider', 'provider_id', 'display_name', 'email', 'avatar', 'banned'];

    public static function findByUserNameOrCreate($provider, $userData)
    {
        $user = User::where('provider_id', '=', $userData->id)->where('provider', '=', $provider)->first();
        if ($user == null)
        {
            $user = User::create([
                'provider' => $provider, 
                'provider_id' => $userData->id,
                'display_name' => $userData->name,
                'email' => $userData->email,
                'avatar' => $userData->avatar,
                'banned' => 0
            ]);
        } // not found

        return self::checkIfUserNeedsUpdating($userData, $user);
    } // end findByUserNameOrCreate

    public static function checkIfUserNeedsUpdating($userData, $user)
    {
        $socialData = [
            'avatar' => $userData->avatar,
            'display_name' => $userData->name,
            'email' => $userData->email,
        ];

        $dbData = [
            'avatar' => $user->avatar,
            'display_name' => $user->display_name,
            'email' => $user->email,
        ];

        if (empty(array_diff($socialData, $dbData)) != false)
        {
            $user->avatar = $socialData['avatar'];
            $user->display_name = $socialData['display_name'];
            $user->email = $socialData['email'];
            $user->save();

            return $user;
        }

        return $user;
    } // end checkIfUserNeedsUpdating
} // end User
