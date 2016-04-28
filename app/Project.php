<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    protected $table = 'projects';
    protected $fillable = ['name', 'description', 'link'];

    public function user() {
        $this->belongsTo('App\User', 'user_id');
    }

    public function attachments() {
        $this->hasMany('App\Attachments', 'project_id');
    }

}
