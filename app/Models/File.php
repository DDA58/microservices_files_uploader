<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $hidden = ['filecontent', 'updated_at', 'created_at'];

    public function getFileContentAttribute() {
        return base64_decode($this->attributes['filecontent']);
    }

    public function setFileContentAttribute($value) {
        $this->attributes['filecontent'] = base64_encode($value);
    }
}
