<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'image' => 'https://example.com/johndoe.jpg',
            'telephone' => '555-555-5555',
            'password' => Hash::make('password'),
        ]);
        
        $user->roles()->attach(Role::where('name', 'admin')->first());

    }
}
