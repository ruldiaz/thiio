<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class userController extends Controller
{
    public function index(){

        $users = User::all();

        /*if($users->isEmpty()){
            $data = [
                'message' => 'No users found.',
                'status' => 200
            ];
            return response()->json($data, 200);
        }*/
        $data = [
            'users' => $users,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:user',
            'password' => 'required',
            'phone' => 'required|digits:10',
            'language' => 'required|in:English,Spanish'
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error on data validation.',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'language' => $request->language
        ]);

        if(!$user){
            $data = [
                'message' => 'Error creating user',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'user' => $user,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    public function show($id){
        $user = User::find($id);

        if(!$user){
            $data = [
                'message' => 'User not found.',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'user' => $user,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($id) {  
        $user = User::find($id);

        if(!$user){
            $data = [
                'message' => 'User not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $user->delete();
        $data = [
            'message' => 'User deleted.',
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function update(Request $request, $id){
        $user = User::find($id);

        if(!$user){
            $data = [
                'message' => 'User not found.',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required|digits:10',
            'language' => 'required|in:English,Spanish'
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error validating data',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->language = $request->language;

        $user->save();
        $data = [
            'message' => 'User updated.',
            'user' => $user,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function updatePatch(Request $request, $id){
        $user = User::find($id);

        if(!$user){
            $data = [
                'message' => 'User not found.',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'max:255',
            'email' => 'email',
            'password' => 'max:10',
            'phone' => 'digits:10',
            'language' => 'in:English,Spanish'
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error validating data',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if($request->has('name')){
            $user->name = $request->name;
        }

        if($request->has('email')){
            $user->email = $request->email;
        }

        if($request->has('password')){
            $user->password = $request->password;
        }

        if($request->has('phone')){
            $user->phone = $request->phone;
        }

        if($request->has('language')){
            $user->language = $request->language;
        }

        $user->save();

        $data = [
            'message' => 'User updated.',
            'user' => $user,
            'status' => 200
        ];

        return response()->json($data, 200);

    }

    public function login(Request $request){
        
        if(!Auth::attempt($request->only('email','password'))){
            
            return response([
                'message' => 'Invalid credentials.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        return $user;
    }
}
