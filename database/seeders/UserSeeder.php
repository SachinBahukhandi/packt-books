<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert(
            [
                [
                    'email' => 'admin@example.com',
                    'password' => Hash::make('admin@123'),
                    'name' => 'Admin',
                    'is_admin' => 1
                ],
                [
                    'email' => 'user@example.com',
                    'password' => Hash::make('user@123'),
                    'name' => 'User',
                    'is_admin' => 0
                ]
            ]
        );
    }
}
