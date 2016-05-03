<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {

    protected $table = 'security_groups';
    protected $fillable = ['name'];

    public function permissions() {
        return $this->belongsToMany('App\Permission', 'sec_perms', 'sec_id', 'perm_id');
    }

    public function users() {
        return $this->hasMany('App\User', 'sec_id');
    }

}
