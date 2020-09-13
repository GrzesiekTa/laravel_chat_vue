<?php

use App\Models\Message\Message;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
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
                'conversation_id' => 1,
                'user_id' => 1,
                'message' => 'czesc co u ciebie wiadomosc testowa',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'conversation_id' => 1,
                'user_id' => 1,
                'message' => 'jestes ?',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'conversation_id' => 1,
                'user_id' => 2,
                'message' => 'a nic ciekawego a u ciebie ?',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'conversation_id' => 3,
                'user_id' => 3,
                'message' => 'A daj spokój !!! to trzymaj sie :]',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],

        ];
        Message::insert($data);
    }
}
