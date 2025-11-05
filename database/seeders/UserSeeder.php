<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'phone' => '9999999999',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'), // you can set a custom password
            'remember_token' => Str::random(60),
            'roles' => 'Super Admin',
            'profile_image' => null,
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
