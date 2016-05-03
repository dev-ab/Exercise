<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function group() {
        return $this->belongsTo('App\Group', 'sec_id');
    }

    public function info() {
        return $this->hasOne('App\Info');
    }

    public function contacts() {
        return $this->hasMany('App\Contact', 'user_id');
    }

    public function projects() {
        return $this->hasMany('App\Project', 'user_id');
    }

}
