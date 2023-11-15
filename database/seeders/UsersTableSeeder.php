<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'test1',
                'email' => 'test1@example.com',
            ],
            [
                'name' => 'test2',
                'email' => 'test2@example.com',
            ]
        ];

        foreach ($users as $users) {
            DB::table('users')->insert([
                'name' => $users['name'],
                'email' => $users['email'],
                'password' => bcrypt('password'),
            ]);
        }
    }
}
