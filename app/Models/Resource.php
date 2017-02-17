<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    /**
     * No mass-assign guard on this -- I have no intention 
     * to use form data to populate data for Resource, ever.
     */
    protected $guarded = [];
    protected $with = ['type'];
    public $timestamps = false;

    public function user() 
    {
        return $this->belongsTo(User::class);
    } // end user

    public function type()
    {
        return $this->belongsTo(ResourceType::class, 'resource_type_id', 'id');
    } // end type
}
