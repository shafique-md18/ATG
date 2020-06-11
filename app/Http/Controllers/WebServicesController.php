<?php

namespace App\Http\Controllers;

use App\ATG;
use App\Http\Resources\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserCollection;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class WebServicesController extends Controller
{
    /**
     * Display a listing of the resource.
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
                'status' => '1',
                'message' => 'data sent successfully'
            ]
        ));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the data
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'pincode' => 'required|digits:6',
        ]);

        if ($validator->fails()) {
            return [
                'status' => '0',
                'message' => 'Information submitted is not valid! Please check the data!',
                'data' => $request->all()
            ];        
        }

        // check if entered record already exists
        $num_records = ATG::where('name', $request['name'])
                            ->where('email', $request['email'])
                            ->where('pincode', $request['pincode'])
                            ->count();

        if ($num_records > 0)
        {
            return [
                'status' => '0',
                'message' => 'Same record already exists!',
                'data' => $request->all()
            ];
        }

        // save the info to db
        $atg = new ATG;

        $atg->name = $request['name'];
        $atg->email = $request['email'];
        $atg->pincode = $request['pincode'];

        $atg->save();

        // send email
        try {
            Mail::to($atg->email)->send(new WelcomeMail($atg));   
            // log email
            Log::channel('atg_log')->info('[ATGController.php] Email sent to '.$atg->email);
        } catch (Exception $e) {
            Log::channel('atg_log')->error($e);
        }

        return [
            'status' => '1',
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
                'status' => '0',
                'message' => 'Information submitted is not valid! Please check the email data!'
            ];        
        }

        $atgs = ATG::where('email', $email)->paginate(15);

        if ($atgs->count() == 0) {
            return [
                'status' => '0',
                'message' => 'No records associated with this email found!'
            ];;
        }

        return User::collection($atgs)->additional([
            'status' => '1',
            'message' => 'successfully processed data'
        ]);
    }
}
