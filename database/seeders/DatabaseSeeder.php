<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate([
            'email' => 'admin@gmail.com'
        ],[
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456')
        ]);

        User::updateOrCreate([
            'email' => 'user@gmail.com'
        ],[
            'email' => 'user@gmail.com',
            'password' => Hash::make('123456')
        ]);

        User::updateOrCreate([
            'email' => 'collaborator@gmail.com'
        ],[
            'email' => 'collaborator@gmail.com',
            'password' => Hash::make('123456')
        ]);
    }
}