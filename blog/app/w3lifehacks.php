<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class w3lifehacks extends Model
{
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'name', 'description', 'user','image',
    ];


}
