<?php

namespace App\Http\Controllers;

use App\ATG;
use Illuminate\Http\Request;

class ATGController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'pincode' => 'required|digits:6',
        ]);

        $message = array('classes' => 'alert alert-success', 'body' => 'Information submitted successfully!');

        return view('home')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $atg = ATG::findOrFail($id);

        return atg;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ATG  $aTG
     * @return \Illuminate\Http\Response
     */
    public function edit(ATG $atg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ATG  $aTG
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ATG $atg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ATG  $aTG
     * @return \Illuminate\Http\Response
     */
    public function destroy(ATG $atg)
    {
        //
    }
}
