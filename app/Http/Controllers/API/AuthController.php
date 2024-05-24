<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 401);
        }
        // check if email and password are correct or not
        if(!auth()->attempt($request->only('email', 'password'))){
            $response = [
                'success' => false,
                'message' => 'Invalid Email or Password'
            ];
            return response()->json($response, 401);
        }
        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('MyApp')->plainTextToken;
        $response = [
            'success' => true,
            'message' => 'Logged In Successfully',

            'user' => $user,
            'token' => $token
        ];
        return response()->json($response, 200);

    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 401);
        }

        $user = User::create([
            'role_id' => 2,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('MyApp')->plainTextToken;

        return response([
            'success' => true,
            'user' => $user,
            'token' => $token,
            'message' => 'Registered Successfully'
        ]);
    }
}
