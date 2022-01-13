<?php

namespace Farid\User\Database\Seeds;
use Illuminate\Foundation\Testing\WithFaker;

use Illuminate\Database\Seeder;
use Farid\User\Models\User;


class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'طارق نظری',
            'email' => 't@gmail.com',
            'password' => bcrypt('t12345'),
            'mobile' => '9186152691',

        ])->givePermissionTo('super admin');
        for ($i = 1;$i<10;$i++) {
            User::create([
               'name' => 'user'.rand(1,10000),
                'email' => uniqid('User_'),
                'password' => bcrypt('t12345'),
                'mobile' => '918'.rand($min=1000000,$max=9999999),
                'status' => 'inactive'
            ]);
        }
    }
}
