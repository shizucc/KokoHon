<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => 'admin12345',
            'role' => 'admin',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'kokom',
            'email' => 'kokom@example.com',
            'password' => 'kokom12345',
            'role' => 'user',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'ayaya',
            'email' => 'ayaya@example.com',
            'password' => 'ayaya12345',
            'role' => 'user',
        ]);
        \App\Models\Category::factory()->create([
            
                'name' => 'horror'
            
        ]);
        \App\Models\Category::factory()->create([
            
                'name' => 'comedy'
            
        ]);
        \App\Models\Category::factory()->create([
            
                'name' => 'sci-fi'
            
        ]);
        \App\Models\Category::factory()->create([
            
                'name' => 'romance'
            
        ]);
        \App\Models\Book::factory(60)->create();
    }
}
