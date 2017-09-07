<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Subject;
use App\Wiki;
use Session;


class WikiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
         $this->middleware('auth');
     }

    public function index()
    {
        $ones = Subject::where('year',1)->get();
        $twos = Subject::where('year',2)->get();
        $threes = Subject::where('year',3)->get();
        $options = Subject::where('year',0)->get();
        $subjects = [$ones, $twos, $threes, $options];
        return view('wikis.index')->withOnes($ones)->withTwos($twos)->withThrees($threes)->withOptions($options);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $year
     * @return \Illuminate\Http\Response
     */
    public function create($year)
    {
        $subjects = Subject::where('year',$year)->get();

        return view('wikis.create')->withSubjects($subjects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'paper' => 'required|mimes:pdf|max:10000',
            'year' => 'required|numeric',
            'subject_id' => 'required|numeric',
            'questions' => 'required|numeric',
        ));

        // Store in the database
        $wiki = new Wiki;

         if ($request->hasFile('paper')) {

            $paper = $request->file('paper');
            $subject = Subject::where('id',$request->subject_id)->first()->name;
            
            $filename = $subject . $request->year . '.' . $paper->getClientOriginalExtension();

            $paper->storeAs('past_papers/', $filename);

            $wiki->paper = $filename;
        }

        $wiki->year = $request->year;
        $wiki->subject_id = $request->subject_id;
        $wiki->questions = $request->questions;

        $wiki->save();

        Session::flash('success', 'The paper was successfully uploaded!');

        //Redirect to another page
        return redirect()->route('wikis.show', $wiki->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $wiki = Wiki::find($id);
        return view('wikis.show')->withWiki($wiki);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
