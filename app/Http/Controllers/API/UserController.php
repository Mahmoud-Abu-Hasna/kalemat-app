<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Quote;
use App\Category;
use App\User;
use App\Helpers\UUID;
use Validator;


class UserController extends MainController
{
    //
    public function store(){
       $uuid = UUID::generate(32,User::class,'uuid');
       $device_id = request('device_id');
       $device_type = request('device_type');
       User::create([
           'uuid'=>$uuid,
           'device_id'=>$device_id,
           'device_type'=>$device_type,
       ]);
        return $this->customResponse(200,'true','UUID Back!',[['uuid'=>$uuid]]);


    }
    public function updateFCM(Request $request){
        $validator = Validator::make($request->all(),[
            'device_id'=>'nullable|min:1',
            'uuid'=>'nullable|min:1',
            'fcm_token'=>'required|min:2',
        ]);
        if($validator->fails()){
            return $this->customResponse(422,'false','Validation Error!',$validator->errors()->toArray());
        }
        $fcm_token = $request['fcm_token'];
        $user = User::query()->where('uuid','like',$request['uuid'])->orWhere('device_id','like',$request['device_id'])->first();
        if(!$user){
            return $this->customResponse(400,'false','User Not Found!',[]);
        }
        $user->save([
            'fcm_token'=>$fcm_token
        ]);
        return $this->customResponse(200,'true','FCM Token Saved!',[]);

    }
}
