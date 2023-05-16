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
        User::truncate();
        DB::table('role_user')->truncate();

       $admin= User::create([
             'name' => 'admin',
             'email' => 'admin@admin.com',
             'password' => Hash::make('password')
        ]);
       $auteur= User::create([
            'name' => 'auteur',
            'email' => 'auteur@auteur.com',
            'password' => Hash::make('password')
       ]);
      $utilisateur= User::create([
        'name' => 'utilisateur',
        'email' => 'utilisateur@utilisateur.com',
        'password' => Hash::make('password')
       ]);

       $adminRole = Role::where('name','admin')->first();
       $auteurRole = Role::where('name','admin')->first();
       $utilisateurRole = Role::where('name','admin')->first();

       $admin->roles()->attach($adminRole);
       $auteur->roles()->attach($auteurRole);
       $utilisateur->roles()->attach($utilisateurRole);
    }
}
