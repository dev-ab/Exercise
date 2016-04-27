<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    public function user() {
        $this->belongsTo('App\User', 'user_id');
    }

    public function attachments() {
        $this->hasMany('App\Attachments', 'project_id');
    }

}
