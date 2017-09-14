<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Session;
use Purifier;
use Image;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class PostController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('admin');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('posts.create')->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the data
        $this->validate($request, array(
            'title' => 'required|max:255',
            'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id' => 'required|numeric',
            'body' => 'required',
            'featured_image' => 'sometimes|image',
            'location' => 'required|max:255',
            'time' => 'required|date',
            'duration' => 'required|max:255',
        ));

        // Store in the database
        $post = new Post;

        $post->title = $request->title;
        $post->time = $request->time;
        $post->duration = $request->duration;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = Purifier::clean($request->body);
        $post->location = $request->location;

        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800,400)->save($location);
            
            $post->image = $filename;
        }

        $post->save();

        Session::flash('success', 'The blog post was successfully saved!');

        //Redirect to another page
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();

        return view('posts.edit')->withPost($post)->withCategories($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $this->validate($request, array(
            'title' => 'required|max:255',
            'slug' => "required|alpha_dash|min:5|max:255|unique:posts,slug,$id",
            'category_id' => 'required|numeric',
            'featured_image' => 'sometimes|image',
            'body' => 'required',
            'location' => 'required|max:255',
            'time' => 'required|date',
            'duration' => 'sometimes|max:255',
        ));
        
        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->time = $request->input('time');
        $post->duration = $request->input('duration');
        $post->slug = $request->input('slug');
        $post->category_id = $request->input('category_id');
        $post->location = $request->input('location');
        $post->body = Purifier::clean($request->input('body'));

        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800,400)->save($location);
            $oldfFilename = $post->image;
            
            $post->image = $filename;
            
            Storage::delete($oldfFilename);
        }

        $post->save();

        Session::flash('success', 'This post was succesfully saved.');

        return redirect()->route('posts.show', $post->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
    }
}
