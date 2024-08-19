<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class TestController extends Controller
{
    public function fonction(){
        return inertia('Employer/Index');
    }
    public function test(){
        return inertia("Test2");
    }

    public function bar(Request $request){
        $request ->validate(['email'=>'required',
        'nom'=>'required',
        'message'=>'required']);
        $user = ['email'=>$request->email, 'nom'=>$request->nom, 'message'=>$request->message];
        Mail::to($user['email'])->send(new TestMail($user));
        return redirect()->back();
    }
}