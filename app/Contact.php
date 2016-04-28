<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {

    protected $table = 'contacts';
    protected $fillable = ['type', 'detail'];

    public function user() {
        $this->belongsTo('App\User', 'user_id');
    }

}
