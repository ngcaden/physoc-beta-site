<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wiki extends Model
{
    public function subject() {
        return $this->belongsTo('App\Subject');
    }

    public function answer() {
        return $this->hasMany('App\Answer');
    }
}