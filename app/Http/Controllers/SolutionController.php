<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solution;

class SolutionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $solution = new Solution;
        
        $this->validate($request, array(
            'paper_id' => 'required|numeric',
            'course_id' => 'required|numeric',
            'url' => 'required|url'
        ));
        
        $solution->paper_id = $request->input('paper_id');
        $solution->course_id = $request->input('course_id');
        $solution->url = $request->input('url');
    
        $solution->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Solution::where('course_id',$id)->get();
    }
}
