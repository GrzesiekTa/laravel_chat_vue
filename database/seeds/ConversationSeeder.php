<?php

use App\Models\Message\Conversation;
use Illuminate\Database\Seeder;

class ConversationSeeder extends Seeder
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
                'name' => 'test',
                'user_id' => 1,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'name' => 'test',
                'user_id' => 1,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'name' => 'test3',
                'user_id' => 3,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]
        ];
        Conversation::insert($data);
    }
}
