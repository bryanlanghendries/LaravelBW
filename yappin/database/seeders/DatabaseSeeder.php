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
        \App\Models\User::factory(10)->create();
        \App\Models\Post::factory(20)->create();
        \App\Models\Like::factory(20)->create();
        \App\Models\Comment::factory(20)->create();
        \App\Models\FAQCategory::factory(3)->create();
        \App\Models\FAQItem::factory(7)->create();

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@ehb.be',
            'password' => 'Password!321',
            'biography'=> 'My bio',
            'birthday'=> date('Y-m-d'),
            'is_admin'=> true,
        ]);
    }
}
