<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    protected $table = 'projects';
    protected $fillable = ['name', 'description'];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function attachments() {
        return $this->hasMany('App\Attachment', 'project_id');
    }

}
