<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
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
                'name' => 'grzesiek',
                'email' => 'grzesiekneo2@o2.pl',
                'password' => '$2y$10$15zT/v2F2P4AQEiNws/COOt9VFyyNoTt3kD8Ki3Q9EOrJDD8Vxh96',
            ]
        ];
        User::insert($data);
    }
}
