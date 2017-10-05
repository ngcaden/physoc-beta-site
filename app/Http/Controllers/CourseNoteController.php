<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseNote;
use App\Course;
use Illuminate\Support\Facades\Storage;

class CourseNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coursenotes = new CourseNote;
        
        $this->validate($request, array(
            'name' => 'required|max:64',
            'set' => "required",
            'course_id' => 'required',
            'notes' => 'sometimes|mimes:image/*,pdf'
        ));
        
        $coursenotes->name = $request->input('name');
        $coursenotes->set = $request->input('set');
        $coursenotes->course_id = $request->input('course_id');
        
        if ($request->hasFile('notes')) {
            $file = $request->file('notes');
            $coursename = str_replace(" ", "-", Course::where('id', $coursenotes->course_id)->first()->name);
            $filename = $coursename . '_' . str_replace(" ", "-", $coursenotes->set) . '_' . str_replace(" ", "-", $coursenotes->name) . '.' . $file->getClientOriginalExtension();
            $url = '/past_papers/' . $filename;

            
            $coursenotes->url = $url;
            
            Storage::putFileAs('past_papers', $file, $filename);

            $coursenotes->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($course_id)
    {
        return CourseNote::where('course_id', $course_id)->get();
    }

    public function showUniqueSets($course_id)
    {
        return CourseNote::where('course_id', $course_id)->select(['set'])->distinct()->get();
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
        //
    }
}
