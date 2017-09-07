<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class EventsController extends Controller
{
    // public function index() {
    //     $posts = Post::paginate(10);
    //     $categories = Category::all();
    //     return view('events.index')->withPosts($posts)->withCategories($categories);
    // }

    // public function getSingle($slug) {
    //     $post = Post::where('slug', '=', $slug)->first();
    //     return view('events.single')->withPost($post);
    // }

    public function index() {
    
        $events = Post::all();
        return $events;
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store() {
        $event = Post::create(Request::all());
        return $event;
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id) {
        $event = Post::find($id);
        $event->done = Request::input('done');
        $event->save();

        return $event;
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id) {
        Post::destroy($id);
    }

}
