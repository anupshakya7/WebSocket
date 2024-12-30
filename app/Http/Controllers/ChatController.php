<?php

namespace App\Http\Controllers;

use App\Events\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function notFound(){
        return abort(404,'Not Found');
    }

    public function chat(Request $request){
        $request->validate([
            'username'=>'required'
        ]);
        $username = $request->username;
        return view('chat')->with(['name'=>$username]);
    }

    public function broadcastChat(Request $request){
        $request->validate([
            'username'=>'required',
            'msg'=>'required'
        ]);
        event(new Chat($request->username,$request->msg));
        return response()->json($request->all());
    }
    
}
