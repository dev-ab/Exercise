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
        $this->belongsTo('App\Group', 'sec_id');
    }

    public function info() {
        $this->hasOne('App\Info', 'user_id');
    }

    public function contacts() {
        $this->hasMany('App\Contact', 'user_id');
    }

    public function projects() {
        $this->hasMany('App\Project', 'user_id');
    }

}
