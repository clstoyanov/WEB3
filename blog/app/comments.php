<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comments extends Model
{   
    protected $dates = ['created_at'];
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'lh_id', 'body'];
   
    /**
     * The belongs to Relationship
     *
     * @var array
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
