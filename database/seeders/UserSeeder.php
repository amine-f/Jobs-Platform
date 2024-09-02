<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* create admin, author, and user */
        /* password for these users is 'password' */

        $factoryUsers = [
            [
                'name' => 'admin user',
                'email' => 'admin@admin.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => 'admin'
            ],

            [
                'name' => 'author user',
                'email' => 'author@author.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => 'author'
            ],

            [
                'name' => 'simple user',
                'email' => 'user@user.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => 'user'
            ],
        ];

        foreach ($factoryUsers as $user) {
            $newUser = User::updateOrCreate(
                ['email' => $user['email']], // Check if the user with the email already exists
                [
                    'name' => $user['name'],
                    'password' => $user['password'], // Assign the hashed password
                ]
            );

            // Assign role if it hasn't been assigned yet
            if (!$newUser->hasRole($user['role'])) {
                $newUser->assignRole($user['role']);
            }
        }
    }
}
