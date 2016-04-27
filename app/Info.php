<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model {

    public function user() {
        $this->belongsTo('App\User', 'user_id');
    }

}
