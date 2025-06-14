<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' =>'Ismail',
            'email' => 'ismail@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
