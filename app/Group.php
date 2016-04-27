<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {

    public function permissions() {
        $this->belongsToMany('App\Permission', 'sec_perms', 'sec_id', 'perm_id');
    }

    public function users() {
        $this->hasMany('App\User', 'sec_id');
    }

}
