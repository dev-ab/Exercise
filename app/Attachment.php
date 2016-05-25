<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model {

    protected $table = 'attachments';
    protected $fillable = ['url', 'size'];

    public function project() {
        return $this->belongsTo('App\Project', 'project_id');
    }

}
