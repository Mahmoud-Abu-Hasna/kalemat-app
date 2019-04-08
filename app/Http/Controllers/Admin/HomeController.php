<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Quote;
use App\User;
use Validator;
use App\Helpers\FCM as FCM;
use Illuminate\Support\Facades\Notification;


class HomeController extends Controller
{
    public function index()
    {
        $quotes = Quote::query()->count();
        $users = User::query()->count();
        $fav_quotes = Quote::query()->with('category')->orderByDesc('fave')->limit(10)->get();
        return view('admin.home',compact(['quotes','users','fav_quotes']));
    }

    public function notify(Request $request){

        $users = User::all('fcm_token')->toArray();
        $message = $request['title_ar'];
        $extra_data = $request['body_ar'];
        $data['title_en']=$request['title_en'];
        $data['body_en']=$request['body_en'];
        $fcm = new FCM();
        $fcm->send($users,$message,$extra_data,$data);
        return back()->with(['success'=>'Notification has been sent successfully!']);

    }
}
