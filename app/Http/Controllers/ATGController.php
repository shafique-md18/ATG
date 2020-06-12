<?php

namespace App\Http\Controllers;

use App\ATG;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\UserTrait;
use Illuminate\Support\Facades\Log;

class ATGController extends Controller
{
    use UserTrait;
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
        if ($this->validateUserData($request->all()) == false)
        {
            return view('home')->withErrors($this->validator); 
        }

        if ($this->checkRecordExists($request->all()))
        {
           $message = array('classes' => 'alert alert-danger', 
                'body' => 'Same record already exists!',
                'success' => 0); 
            return view('home')->with('message', $message);
        }

        // save this record
        $atg = $this->saveRecord($request->all());

        // send and log email
        $this->sendAndLogEmail($atg);

        $message = array('classes' => 'alert alert-success', 'body' => 'Information submitted successfully! Email Sent !', 'success' => 1);

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
     * Display all the records
     *
     * @param 
     * @return \Illuminate\Http\Response
     */
    public function show_user_data()
    {
        $records = ATG::all();

        // if no records present
        if ($records->count() == 0)
        {
            $message = array('classes' => 'alert alert-danger', 'body' => 'No data to show!');

            return view('userdata')->with('message', $message); 
        }
        
        return view('userdata')->with('records', $records);
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
