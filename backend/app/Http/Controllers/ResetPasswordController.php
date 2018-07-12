<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Mail\PasswordResetEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordController extends Controller
{
    public function sendEmail(Request $request) {

        if(!$this->validateEmail($request->email)){

            return $this->failedResponse();

        }

        $this->send($request->email);
        return $this->successResponse();

    }

    public function validateEmail($email) {

        return !!User::where('email', $email)->first();

    }

    
    public function successResponse() {

        return response()->json([

            'data' => 'Reset Email is send successfully, please check your inbox.'

        ], Response::HTTP_OK);

    }

    public function failedResponse(){

        return response()->json([

            'error' => 'Email doesn\'t exist on our database'

        ], Response::HTTP_NOT_FOUND);

    }

    public function send($email) {

        $token = $this->createToken($email);
        Mail::to($email)->send(new PasswordResetEmail($token, $email));

    }

    public function createToken($email) {

        $oldToken = DB::table('password_resets')->where('email', $email)->first();

        if($oldToken){

            return $oldToken;

        }

        $token = str_random(60);
        $this->saveToken($token, $email);
        return $token;
    }

    public function saveToken($token, $email) {

        DB::table('password_resets')->insert([

            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now(),
            
        ]);
    }

}
