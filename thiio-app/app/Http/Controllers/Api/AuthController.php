<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function user() {
        return Auth::user();
    }
    

    public function login(Request $request){
        
        if(!Auth::attempt($request->only('email','password'))){
            
            return response([
                'message' => 'Invalid credentials.'
            ], Response::HTTP_UNAUTHORIZED);
        }
        
        /** @var \App\Models\MyUserModel $user **/
        $user = Auth::user();

        $token = @$user->createToken('token')->plainTextToken;
        
        $cookie = cookie('jwt', $token, 60 * 24);

        return response([
            'message' => $token
        ])->withCookie($cookie);
    }

    public function logout() {
        $cookie = Cookie::forget('jwt');

        return response([
            'message' => 'Success.'
        ])->withCookie($cookie);
    }
}
