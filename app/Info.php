<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model {

    protected $table = 'users_info';
    protected $fillable = ['profile_thumb', 'profile_pic', 'title', 'fullname', 'job', 'birthdate'];

    public function user() {
        return $this->belongsTo('App\User');
    }

}
