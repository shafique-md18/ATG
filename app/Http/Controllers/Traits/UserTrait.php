<?php

namespace App\Http\Controllers\Traits;

use App\ATG;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

trait UserTrait
{
    public $validator;

    /**
     * Validate user data
     *
     * @param  array user data ['name', 'email', 'pincode']
     * @return Boolean
     */
    public function validateUserData($input) 
    {
        // validate the data
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'pincode' => 'required|digits:6',
        ]);

        $this->validator = $validator;

        if ($validator->fails())
            return false;
        else
            return true;
    }

    /**
     * Check if same record exists
     *
     * @param  array user data ['name', 'email', 'pincode']
     * @return JSON data
     */
    public function checkRecordExists($data)
    {
        // check if entered record already exists
        $num_records = ATG::where('name', $data['name'])
                            ->where('email', $data['email'])
                            ->where('pincode', $data['pincode'])
                            ->count();

        if ($num_records > 0)
            return true;
        else
            return false;
    }

    /**
     * Save the record
     *
     * @param  array user data ['name', 'email', 'pincode']
     * @return App\ATG $atg
     */
    public function saveRecord($data)
    {
        // save the info to db
        $atg = new ATG;

        $atg->name = $data['name'];
        $atg->email = $data['email'];
        $atg->pincode = $data['pincode'];

        $atg->save();
        return $atg;
    }

    /**
     * Send email and log this
     *
     * @param  App\ATG $atg
     * @return
     */
    public function sendAndLogEmail(ATG $atg)
    {
        // send email
        try {
            Mail::to($atg->email)->send(new WelcomeMail($atg));   
            // log email
            Log::channel('atg_log')->info('[ATGController.php] Email sent to '.$atg->email);
        } catch (Exception $e) {
            Log::channel('atg_log')->error($e);
        }
    }
}
