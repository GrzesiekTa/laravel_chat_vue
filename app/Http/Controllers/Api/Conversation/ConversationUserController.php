<?php

namespace App\Http\Controllers\Api\Conversation;

use App\Http\Controllers\Controller;
use App\Models\Message\ConversationUser;
use Illuminate\Http\Request;

class ConversationUserController extends Controller
{

    public function countUnreadMessages() {
        //TODO!!!!
        if(!auth()->user()) {
            return 0;
        }

        $authUser = auth()->user()->id;

        return response()->json(ConversationUser::where('recipient_user_id', $authUser)->where('unread', true)->count());
    }



    public function testttt(){
        $authUser = auth()->user()->id;

        return response()->json(ConversationUser::where('recipient_user_id', $authUser)->with('sender')->get());
    }
}
