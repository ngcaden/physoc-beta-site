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
    public function store(Request $request) {
        $this->validate($request, array(
            'title' => 'required|max:64',
            'date' => 'required|regex:/^[0-9\-]+$/|min:10|max:10',
            'start' => 'required|regex:/^[0-9:]+$/|min:5|max:5',
            'end' => 'required|regex:/^[0-9:]+$/|min:5|max:5',
            'category_id' => 'required|numeric',
            'location' => 'required|max:64',
            'link' => 'sometimes|url'
        ));
        Post::create($request->all());
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
