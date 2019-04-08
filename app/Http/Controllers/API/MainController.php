<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class MainController extends Controller
{
    //
    public function customResponse($code,$success,$message,$data){
        $status = [
            'code'=>''.$code,
            'success'=>$success,
            'created_at'=>Carbon::now()->format('Y m, d'),
            'message'=>$message,
        ];

        return response()->json(['status' => $status,'data'=>$data], $code);
    }
}
