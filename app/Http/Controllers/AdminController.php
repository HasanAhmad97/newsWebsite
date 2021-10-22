<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function updateFcmToken(Request $request){

        $user=auth('web')->user();
        $user->update([
            'fcm_token'=>$request->fcm_token
        ]);

        if($user){
            $user->fcm_token=$request->fcm_token;
            $user->save();
        }

        return response()->json(['message'=>'تم حفظ التوكن بنجاح']);
    }
}
