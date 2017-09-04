<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function wikis() {
        return $this->hasMany('App\Wiki');
    }

}
