<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|min:4|max:150|email',
            'password' => 'required|min:5|max:10'
        ]);




        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid field',
                'errors' => $validator->errors()
            ],422);
        }




        $user= User::where('email', $request->email)->first();




            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => 'Email or password incorrect'
                ], 401);
            }




            $accessToken = $user->createToken('ApiToken')->plainTextToken;
            $response = [
                'success'   => true,
                'user'      => $user,
                'accessToken'      => $accessToken,
            ];


        return response($response, 200);

    }
}
