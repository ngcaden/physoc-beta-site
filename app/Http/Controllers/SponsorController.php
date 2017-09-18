<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Sponsor;

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
        return $sponsors;
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
            'name' => 'required',
            'url' => 'required|active_url',
            'description' => 'required',
            'logo' => 'required|regex:/^[a-zA-Z\/\.]+$/'
        ));
        Sponsor::create($request->all());
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
        // Validate the data
        $this->validate($request, array(
            'name' => 'required',
            'url' => 'required|active_url',
            'description' => 'required',
            'logo' => 'required|regex:/^[a-zA-Z\/\.]+$/'
        ));
        $sponsor = Sponsor::find($id);
		$sponsor->fill($request->all());
		$sponsor->save();
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
        // Storage::delete($sponsor->image);       
        $sponsor->delete();
    }
}
