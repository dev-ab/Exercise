<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {

    public function groups() {
        $this->belongsToMany('App\Group', 'sec_perms', 'perm_id', 'sec_id');
    }

}
