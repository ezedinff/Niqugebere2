<?php

namespace App\Api\V1\Controllers;


use App\FirebaseToken;
use Dingo\Api\Http\Request;

class FirebaseTokenController extends Controller
{
    //

    public function addToken(Request $request){

        $firebase= new FirebaseToken();
        $firebase->token=$request->token;
        $firebase->save();

        return response()->json([
            'status' =>'ok',
            'token' => "ok"
        ], 201);
    }
}
