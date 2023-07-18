<?php

namespace App\Http\Controllers\ap;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Validator;

class UserController extends Controller
{
     public function register(Request $req){
      // $user = new User;
      // $user->name = $req->name;
      // $user->email = $req->email;
      // $user->password = $req->password;
      // $res= $user->save();
      // if($res){
      //    return['Data has been saved'];
      // }else{
      //    return['operation faild'];
      // }
        $validateData = $req->validate([
           'name' =>  'required',
           'email' => ['required','email'],
           'password' => ['min:5']
        ]);
        $user = User::create($validateData);
        $token = $user->createToken("auth_token")->accessToken;
        return response()->json([
            'token' => $token,
            'user' => $user,
            'message' => 'user created successfully',
            'status' => 1
        ]);
     }
}
