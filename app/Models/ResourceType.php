<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResourceType extends Model
{
    public function resources()
    {
        $this->hasMany(Resource::class);
    }
}
