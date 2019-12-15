<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AppendAdminAndEditors extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = [
            [
                "role"      => "admin",
                "role_name" => "Администратор",
            ],
            [
                "role"      => "editor",
                "role_name" => "Редактор",
            ],
            [
                "role"      => "user",
                "role_name" => "Пользователь",
            ],
        ];

        $users = [
            [
                "role_id"           => 1,
                "name"              => "john",
                "email"             => "root@mail.ru",
                "email_verified_at" => null,
                "password"          => Hash::make("123456"),
                "invite"            => null,
                "remember_token"    => null
            ],
            [
                "role_id"           => 2,
                "name"              => "jack",
                "email"             => "jack@mail.ru",
                "email_verified_at" => null,
                "password"          => Hash::make("123456"),
                "invite"            => null,
                "remember_token"    => null
            ],
            [
                "role_id"           => 2,
                "name"              => "Robert",
                "email"             => "robert@mail.ru",
                "email_verified_at" => null,
                "password"          => Hash::make("123456"),
                "invite"            => null,
                "remember_token"    => null
            ],
            [
                "role_id"           => 3,
                "name"              => "mona",
                "email"             => "mona@mail.ru",
                "email_verified_at" => null,
                "password"          => Hash::make("123456"),
                "invite"            => null,
                "remember_token"    => null
            ],
        ];

        if (DB::table("roles")->count() < 1 && DB::table("users")->count() < 1){
            foreach ($roles as $role) {
                \App\Models\Role::create($role);
            }

            foreach ($users as $user) {
                \App\User::create($user);
            }
        }


    }
}
