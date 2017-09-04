<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function wiki() {
        return $this->belongsTo('App\wiki');
    }
}
