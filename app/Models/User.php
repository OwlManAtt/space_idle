<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable 
{
    protected $fillable = ['display_name', 'avatar',];

    public function resources()
    {
        return $this->hasMany(Resource::class);
    } // end resources

    public function homepage()
    {
        return '/harvest';
    }
} // end User
