<?php

namespace App\Models\Message;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Message\Conversation;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['message', 'conversation_id'];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
