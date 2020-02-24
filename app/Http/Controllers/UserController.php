<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;
use Auth;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
  
         $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
  
        $user = User::where('email', $request->input('email'))->first();
 
        if($user && Hash::check($request->input('password'), $user->password)){
 
            $apikey = base64_encode(Str::random(40));
     
            User::where('email', $request->input('email'))
                ->update(['api_token' => "$apikey"]);
     
            return response()->json([
                'user' => array_merge($user->toArray(), ['api_token' => $apikey])
            ]);
     
         }else{
     
            return response()->json(['response' => 'Email or password is invalid.'], 422);
     
        }
  
    }
 
    public function signup(Request $request)
    {
  
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);
 
        $api_token = base64_encode(Str::random(40));
 
        $result = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'api_token' => $api_token,
            'password' => Hash::make($request->input('password')),
        ]);
 
        return response()->json([
            'user' => $result->toArray()
        ]);
  
    }

    public function getLoggedUser(Request $request){
        return response()->json([
            'user' => Auth::user()->toArray()
        ]);
    }
}
