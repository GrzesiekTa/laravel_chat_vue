<?php

namespace App\Http\Controllers\Api\Massage;

use App\Events\MessageSent;
use App\Events\WebsocketDemoEvent;
use App\Http\Controllers\Controller;
use App\Models\Message\Message;
use Illuminate\Http\Request;

class MassageController extends Controller
{
    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    /**
     * send messages
     *
     * @param Request $request
     * 
     * @return void
     */
    public function sendMessages(Request $request)
    {
        $message = auth()->user()->messages()->create([
            'message' => $request->message,
            'conversation_id' => 1,
            //'user_id' => $request->user,
        ]);

        broadcast(new MessageSent($message->load('user')))->toOthers();

        return ['status' => 'success'];
    }
}
