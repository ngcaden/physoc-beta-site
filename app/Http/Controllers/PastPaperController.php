<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PastPaper;
use App\Course;
use Illuminate\Support\Facades\Storage;

class PastPaperController extends Controller
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
        $pastpaper = new PastPaper;
        
        $this->validate($request, array(
            'year' => "required",
            'course_id' => 'required|numeric',
            'paper' => 'required|mimes:jpeg,bmp,png,pdf'
        ));
        
        $pastpaper->year = $request->input('year');
        $pastpaper->course_id = $request->input('course_id');
        
        if ($request->hasFile('paper')) {
            $file = $request->file('paper');
            $coursename = str_replace(" ", "-", Course::where('id', $pastpaper->course_id)->first()->name);
            $filename = $coursename . '_' . $pastpaper->year . '.' . $file->getClientOriginalExtension();
            $url = 'wiki_resource/past_papers/' . $filename;

            
            $pastpaper->url = $url;
            
            Storage::putFileAs('wiki_resource/past_papers', $file, $filename);

            $pastpaper->save();
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
        return PastPaper::where('course_id', $course_id)->orderBy('year','ASC')->get();
    }

    public function show_individual($id)
    {
        return PastPaper::where('id',$id)->first();
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
