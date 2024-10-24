<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                [
                    'name' => 'Admin',
                    'username' => 'admin',
                    'email' => 'admin@gmail.com',
                    'password' => bcrypt('12345678'),
                    'role' => 'admin',
                    'status' => '1',
                ],
                [
                    'name' => 'instructor',
                    'username' => 'instructor',
                    'email' => 'instructor@gmail.com',
                    'password' => bcrypt('12345678'),
                    'role' => 'instructor',
                    'status' => '1',
                ],
                [
                    'name' => 'user',
                    'username' => 'user',
                    'email' => 'user@gmail.com',
                    'password' => bcrypt('12345678'),
                    'role' => 'user',
                    'status' => '1',
                ],
            ]
        );
    }
}
