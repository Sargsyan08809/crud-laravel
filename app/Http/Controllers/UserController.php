<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json([
            'result' => $users,
        ],200);
    }

    public function store(UserStoreRequest $request)
    {
        try{
            // Create User
            User::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'password'=> $request->password,
            ]);
            //Return JSON response
            return response()->json([
                'meassage'=>"User created successfully"
            ],200);
        }catch (\Exception $e){
            //return JSON response
            return response()->json(['message' => 'Something went really wrong'], 500);
        }
    }

    public function show($id)
    {
        //User Detail
        $users = User::find($id);
        if(!$users){
            return response()->json([
                'message'=>"User not found."
            ], 404);
        }

        //return JSON Response
        return response()->json([
            'users'=>$users,
        ], 200);
    }

    public function update(UserStoreRequest $request, $id)
    {
        try{
            $users = User::find($id);
            if(!$users){
                return response()->json(['message' => 'User not found'], 404);
            }
            $users->name = $request->name;
            $users->email = $request->email;
            $users->save();

            //return JSON Response
            return response()->json([
                'users'=>$users,
            ], 200);

        } catch (\Exception $e){
            return response()->json(['message' => 'Something went really wrong'], 500);
        }
    }

    public function destroy($id)
    {
        $users = User::find($id);
            if(!$users){
                return response()->json(['message' => 'User not found'], 404);
            }
            $users->delete();
            return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
