<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'tanim',
                'email' => 'shahidultanim@gmail.com',
                'password' => Hash::make('sugarsugar'),
            ],
            [
                'name' => 'shahidul',
                'email' => 'shahidultanim7@gmail.com',
                'password' => Hash::make('sugarsugar'),
            ]
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
