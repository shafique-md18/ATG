<?php

namespace App\Http\Controllers;

use App\ATG;
use App\Http\Resources\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserCollection;
use App\Mail\WelcomeMail;
use App\Http\Controllers\Traits\UserTrait;


class WebServicesController extends Controller
{
    use UserTrait;

    /**
     * Send all user info using pagination
     *
     * @return App\Http\Resources\ATG
     */
    public function index()
    {
        // Get atgs
        $atgs = ATG::paginate(15);

        // Return collection of atgs as resource
        return (User::collection($atgs)->additional(
            [
                'status' => 1,
                'message' => 'Data sent successfully!'
            ]
        ));
    }


    /**
     * Store user info
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JSON data
     */
    public function store(Request $request)
    {
        if ($this->validateUserData($request->all()) == false)
        {
            return [
                'status' => 0,
                'message' => 'Information submitted is not valid! Please check the data! Required Parameters: name, email, pincode',
                'data' => $request->all(),
                'errors' => $this->validator->errors()
            ];        
        }

        if ($this->checkRecordExists($request->all()))
        {
            return [
                'status' => 0,
                'message' => 'Same record already exists!',
                'data' => $request->all(),
                // same format as of the Validator->errors()
                'errors' => ['duplicate' => ['Same record already exists!']]
            ];
        }

        // save this record
        $atg = $this->saveRecord([
            'name' => strtolower($request->name),
            'email' => strtolower($request->email),
            'pincode' => $request->pincode
        ]);

        // send email
        $this->sendAndLogEmail($atg);

        return [
            'status' => 1,
            'message' => 'Successfully received information and saved to database!',
            'data' => $request->all()
        ];
    }

    /**
     * Display the single user info by id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get user data
        $atg = ATG::findOrFail($id);

        return new ATGResouce($atg); 
    }

     /**
     * Display the specified resource.
     *
     * @param  string email
     * @return \Illuminate\Http\Response
     */
    public function show_by_email($email)
    {
        $input = [
            'email' => $email
        ];

        $validator = Validator::make($input, [
            'email' => 'required|email:rfc,dns',
        ]);

        if ($validator->fails()) {
            return [
                'status' => 0,
                'message' => 'Information submitted is not valid! Please check the email data!',
                'errors' => $this->validator->errors()
            ];        
        }

        $atgs = ATG::where('email', $email)->paginate(15);

        if ($atgs->count() == 0) {
            return [
                'status' => 0,
                'message' => 'No records associated with this email found!',
                'errors' => 'No records associated with this email found!'
            ];;
        }

        return User::collection($atgs)->additional([
            'status' => 1,
            'message' => 'successfully processed data'
        ]);
    }
}
