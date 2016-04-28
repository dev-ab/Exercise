<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model {

    protected $table = 'users_info';
    protected $fillable = ['title', 'fullname', 'job', 'birthdate'];

    public function project() {
        $this->belongsTo('App\Project', 'project_id');
    }

}
