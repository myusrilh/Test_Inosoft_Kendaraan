<?php

namespace App\Http\Controllers;

use JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Exceptions\JWTException;

class ApiController extends Controller
{
    /**
     * Handle register
     * 
     * @param \Illuminate\Http\Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $req){
        // Data validation
        $data = $req->only('name','email','password');
        $validated = $req->validate($data,[
            'name' => 'required|min:5|max:30|unique',
            'email' => 'required|email|unique',
            'password' => 'required|min:5'
        ],
        ['name.required' => 'The name is required',
        'email.required' => 'The email is required',
        'password.required' => 'The password is required',
        'name.min' => 'The name is too short',
        'password.min' => 'The password is too short',
        ]);

        if(!$validated){
            return response()->json(['error'=> $validated]);
        };

        $user = new User();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = bcrypt($req->password);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }
    public function authenticate(Request $req){
        $credentials = $req->only('email', 'password');

        // Validate request
        $validated = $req->validate($credentials,[
            'email' => 'required|email|unique',
            'password' => 'required|min:5'
        ],
        ['email.required' => 'The email is required',
        'password.required' => 'The password is required',
        'password.min' => 'The password is too short'
        ]);

        if(!$validated){
            return response()->json(['error'=>$validated],Response::HTTP_OK);
        }

        // Request validated
        // Create token
        try {
            $token = JWTAuth::attempt($credentials);
            if(!$token){
                return response()->json([
                    'success'=>false,
                    'message'=>'Login credentials invalid!'
                ], Response::HTTP_BAD_REQUEST);
            }
        } catch (JWTException $je) {
            return response()->json([
                'success' => false,
                'message' => 'Could not create token',
                'credentials' => $credentials
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'success'=>true,
            'token'=>$token
        ]);
    }

    public function get_user(Request $req){
        $this->validate($req,[
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($req->token);

        return response()->json(['user'=>$user]);
    }

    public function logout(Request $req){
        
        // Validate request
        $validate = $req->validate([
            'token' => 'required'
        ]);

        // Request not valid, send failed response
        if(!$validate){
            return response()->json([
                'error' => $validate
            ]);
        }

        // Request validated, logout user
        try {
            JWTAuth::invalidate($req->token);

            return response()->json([
                'success'=> true,
                'message' => 'User has been logged out'
            ]);

        } catch (JWTException $je) {
            
            return response()->json([
                'success' => false,
                'message' => 'Sorry, User cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);

        }

    }
}
