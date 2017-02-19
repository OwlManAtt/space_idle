<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['display_name', 'avatar',];

    public function resources($types = [])
    {
        $rel = $this->hasMany(Resource::class);

        if (sizeof($types) > 0) {
            $rel->join('resource_types', 'resources.resource_type_id', 'resource_types.id');
            $rel = $rel->whereIn('resource_types.short_code', $types);
        }

        return $rel;
    } // end resources

    public function homepage()
    {
        return '/harvest';
    }
} // end User
