<?php

namespace App\Http\Controllers;

use JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public $token = true;
    public function register(Request $request)
    {
    	//Validate data
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:30',
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], Response::HTTP_UNAUTHORIZED);
        }

        //Request is valid, create new user
        $user = new User();
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($this->token) {
            return $this->login($request);
        }

        //User created, return success response
        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $jwt_token = null;

        //valid credential
        $validator = Validator::make($credentials,[
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], Response::HTTP_OK);
        }

        //Request is validated
        //Crean token
        try {
            if (!$jwt_token = JWTAuth::attempt($credentials)) {
                return response()->json([
                	'success' => false,
                	'message' => 'Login credentials are invalid.',
                ], Response::HTTP_UNAUTHORIZED);
            }
        } catch (JWTException $e) {
            return response()->json([
                	'success' => false,
                	'message' => 'Could not create token.',
                    'credentials' => $credentials
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
 	
 		//Token created, return with success response and jwt token
        return response()->json([
            'success' => true,
            'token' => $jwt_token,
        ]);
    }
 
    public function logout(Request $request)
    {
        //valid credential
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

		//Request is validated, do logout        
        try {
            JWTAuth::invalidate($request->token);
 
            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ], Response::HTTP_OK);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
 
    public function get_user(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
 
        $user = JWTAuth::authenticate($request->token);
 
        return response()->json(['user' => $user]);
    }
}
