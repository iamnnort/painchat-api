<?php

namespace App\Http\Controllers;


use App\ChatMessage;
use App\Events\ChatMessageAdded;
use App\Events\TestEvent;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $messages = ChatMessage::all();
        return view('chat.index', compact('messages'));
    }

    public function postMessage(Request $request)
    {
        $message = ChatMessage::create($request->all());
        event(
          new ChatMessageAdded($message)
        );
        return redirect()->back();
    }
}

