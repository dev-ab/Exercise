<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model {

    protected $table = 'users_info';
    protected $fillable = ['title', 'fullname', 'job', 'birthdate'];

    public function user() {
        return $this->belongsTo('App\User');
    }

}
