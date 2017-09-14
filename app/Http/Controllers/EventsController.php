<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Carbon\Carbon;

class EventsController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth','admin'])->only('store','update','destroy');
    // }

    public function index() {
    
        $events = Post::where('date', '>=', Carbon::now())->join('categories', 'categories.id', '=', 'posts.category_id')->orderBy('date','DESC')->select('posts.*','categories.category')->get();
        return $events;
    }

    public function index_all() {
        
        $events = Post::join('categories', 'categories.id', '=', 'posts.category_id')->orderBy('date','DESC')->select('posts.*','categories.category')->get();
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
        $event = Post::find($id);
        $event->delete();
    }
}
