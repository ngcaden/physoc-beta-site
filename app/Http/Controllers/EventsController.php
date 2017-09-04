<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class EventsController extends Controller
{
    public function getIndex() {
        $posts = Post::paginate(10);
        $categories = Category::all();
        return view('events.index')->withPosts($posts)->withCategories($categories);
    }

    public function getSingle($slug) {
        $post = Post::where('slug', '=', $slug)->first();
        return view('events.single')->withPost($post);
    }

}
