<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

use App\Events\NewMessageAdded;

class ChatController extends Controller
{
    public function index()    {
        $messages =  Message::all();
        return view('chat.index', compact('messages'));
    }

    public function store(Request $request){
        $message =  Message::create($request->all());
        dd($message);
        event(
            new NewMessageAdded($message)
        );

        return redirect()->back();
    }

}
