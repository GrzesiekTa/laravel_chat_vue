<?php

use App\Models\Message\ConversationUser;
use Illuminate\Database\Seeder;

class ConversationUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'recipient_user_id' => 1,
                'sender_user_id' => 2,
                'data' => '{"message":"czesc co u ciebie wiadomosc testowa"}',
                'unread' => true,
                'conversation_id' => 1,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'recipient_user_id' => 1,
                'sender_user_id' => 3,
                'data' => '{"message":"A daj spokój !!! to trzymaj sie :]"}',
                'unread' => true,
                'conversation_id' => 3,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],

        ];
        ConversationUser::insert($data);
    }
}
