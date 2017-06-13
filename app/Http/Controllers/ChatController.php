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
}

