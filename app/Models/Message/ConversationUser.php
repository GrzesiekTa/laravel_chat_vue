<?php

namespace App\Models\Message;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ConversationUser extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'conversation_user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['recipient_user_id', 'sender_user_id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_user_id');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_user_id');
    }
}
