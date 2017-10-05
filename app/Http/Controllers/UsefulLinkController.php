<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UsefulLink;

class UsefulLinkController extends Controller
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
        $usefullink = new UsefulLink;
        
        $this->validate($request, array(
            'name' => 'required|max:64',
            'course_id' => 'required|numeric',
            'url' => 'required|url'
        ));
        
        $usefullink->name = $request->input('name');
        $usefullink->course_id = $request->input('course_id');
        $usefullink->url = $request->input('url');
    
        $usefullink->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($course_id)
    {
        return UsefulLink::where('course_id', $course_id)->get();
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
