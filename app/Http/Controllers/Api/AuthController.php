<?php

namespace App\Http\Controllers\Api;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{

    public function allUsers() {

        return response()->json(User::all(),200);

    }
    
    public function register(Request $request) {

        $validator = Validator::make($request->all(), [

            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min: 8|confirmed',

        ]);

        if($validator->fails()) {

            return response()->json($validator->errors(), 422);

        }

        $user = User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)

        ]);

        $token = Auth::login($user);

        return response()->json([

            'message' => 'User Created Successfully',
            'access_token' => $token,
            'token_type' => 'Bearer',

        ])->header('Authorization', $token);


    }

    public function login(Request $request) {

        $credentials = $request->only('email','password');

        if($token = Auth::attempt($credentials)) {

            return response()->json([

                'message' => 'User Logged in succssfully',
                'access_token' => $token,
                'token_type' => 'Bearer',

            ]);

            

        } else {

                return response()->json([

                    'message' => 'Unauthorized',

                ]);

    }

}

public function me() {

    return response()->json(auth()->user());

}

public function logout() {

    auth()->logout();
    return response()->json([

        'message' => 'user logged out successfully'

    ]);
    
}

public function refresh() {

    return response()->json([

        'access_token' => auth()->refresh(),
        'token_type' => 'Bearer',

    ]);

}

}
