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
                'images' => '{"avatar":{"small":"51989aff5b9455f1f59712797725e3f4small.jpeg","big":"51989aff5b9455f1f59712797725e3f4big.jpeg"}}'
            ],
            [
                'name' => 'janusz',
                'email' => 'janusz@o2.pl',
                'password' => '$2y$10$15zT/v2F2P4AQEiNws/COOt9VFyyNoTt3kD8Ki3Q9EOrJDD8Vxh96',
                'images' => '{"avatar":{"small":"c5f040ee83d60f11513b2e41f5882e62small.jpeg","big":"c5f040ee83d60f11513b2e41f5882e62big.jpeg"}}'
            ],
            [
                'name' => 'pioter',
                'email' => 'pioter@o2.pl',
                'password' => '$2y$10$15zT/v2F2P4AQEiNws/COOt9VFyyNoTt3kD8Ki3Q9EOrJDD8Vxh96',
                'images' => '{"avatar":{"small":"7823321d52d8a5013362536195292559small.jpeg","big":"7823321d52d8a5013362536195292559big.jpeg"}}'
            ]
        ];
        
        User::insert($data);
    }
}
