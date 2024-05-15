<?php

namespace App\Database\Seeds;

use App\Models\User;
use App\Entities\UserEntity;
use CodeIgniter\Database\Seeder;
use UserRoles;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $users = model(User::class);
        $admin = new UserEntity([
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'jd@gmail.com',
            'username' => env('default.login.admin.username'),
            'password' => env('default.login.admin.password'),
            'roles' => UserRoles::ADMIN
        ]);

        // add new default admin if not one
        if (!$users->where('username', $admin->username)->first()) {
            model(User::class)->save($admin);
        }
    }
}
