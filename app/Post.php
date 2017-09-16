<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function category() {
        return $this->belongsTo('App\Category');
    }

    protected $fillable = array('title', 'date', 'start', 'end', 'location', 'body', 'link', 'category_id');
}
