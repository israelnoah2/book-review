<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Book;
use \App\Models\Review;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

       Book::factory(33)->create()->each(function($book){
        Review::factory()->count(random_int(5,30))->good()->for($book)->create();
       });

       Book::factory(34)->create()->each(function($book){
        Review::factory()->count(random_int(5,30))->average()->for($book)->create();
       });

       Book::factory(33)->create()->each(function($book){
        Review::factory()->count(random_int(5,30))->bad()->for($book)->create();
       });


    }
}
