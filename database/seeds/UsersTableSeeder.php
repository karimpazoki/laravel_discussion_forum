<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "karim",
            "email" => "admin@laravel.dev",
            "admin" => 1,
            "avatar" => "avatar.png",
            "password" => bcrypt("admin")
            ]
        );

        User::create([
                "name" => "VD",
                "email" => "vd@laravel.dev",
                "avatar" => "avatar.png",
                "password" => bcrypt("admin")
            ]
        );

        User::create([
                "name" => "Farid",
                "email" => "farid@laravel.dev",
                "avatar" => "avatar.png",
                "password" => bcrypt("admin")
            ]
        );

        User::create([
                "name" => "Ali",
                "email" => "Ali@laravel.dev",
                "admin" => 1,
                "avatar" => "avatar.png",
                "password" => bcrypt("admin")
            ]
        );
    }
}
