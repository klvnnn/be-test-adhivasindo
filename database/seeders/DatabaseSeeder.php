<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //dummy user
        User::factory(3)->create();
        //registered user
        User::factory()->create([
            'name' => 'User Test',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
