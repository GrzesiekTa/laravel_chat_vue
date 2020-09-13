<?php

namespace App\Models\Message;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'conversation';

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
