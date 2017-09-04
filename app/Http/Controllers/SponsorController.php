<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sponsor;
use Image;
use Session;
use Illuminate\Support\Facades\Storage;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sponsors = Sponsor::all();
        return view('sponsors.index')->withSponsors($sponsors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sponsors.create');
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
            'name' => 'required|max:255|unique:sponsors|alpha_dash',
            'url' => 'required|max:255|active_url',
            'featured_image' => 'image',
            'description' => 'required',
        ));

        // Store in the database
        $sponsor = new Sponsor;

        $sponsor->name = $request->name;
        $sponsor->url = $request->url;

        $image = $request->file('logo');
        $filename = $request->name . '.' . $image->getClientOriginalExtension();
        $location = public_path('logos' . $filename);
        Image::make($image)->resize(800,400)->save($location);
        $sponsor->logo = $filename;

        $sponsor->description = $request->description;

        $sponsor->save();

        Session::flash('success', 'The sponsor was successfully saved!');

        //Redirect to another page
        return redirect()->route('sponsors.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sponsor = Sponsor::find($id);

        return view('sponsors.edit')->withSponsor($sponsor);
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
        $sponsor = Sponsor::find($id);

        $this->validate($request, array(
            'name' => "required|max:255|unique:sponsors,name,$id|alpha_dash",
            'url' => 'required|max:255|active_url',
            'featured_image' => 'image',
            'description' => 'required',
        ));
        
         // Store in the database
    
        $sponsor = sponsor::find($id);

        $sponsor->name = $request->input('name');
        $sponsor->url = $request->input('url');

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('logos' . $filename);
            Image::make($image)->resize(800,400)->save($location);
            $oldfFilename = $sponsor->image;
            
            $sponsor->logo = $filename;
            
            Storage::delete($oldfFilename);
        }

        $sponsor->description = $request->input('description');

        $sponsor->save();

        Session::flash('success', 'The sponsor was successfully saved!');

        //Redirect to another page
        return redirect()->route('sponsors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sponsor = Sponsor::find($id);
        
        Storage::delete($sponsor->image);
        
        $sponsor->delete();

        Session::flash('success', 'The sponsor was successfully removed!');
        return redirect()->route('sponsors.index');
    }
}
