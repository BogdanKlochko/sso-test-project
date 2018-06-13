<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Broker extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'secret',
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
