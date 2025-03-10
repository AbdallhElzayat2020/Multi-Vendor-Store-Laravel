<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //        should insert store first after that User

//         \App\Models\Store::factory(10)->create();
//
//         \App\Models\Category::factory(10)->create();
//
//         \App\Models\Product::factory(100)->create();
//
//         \App\Models\Admin::factory(3)->create();

        $this->call([
            UserSeeder::class,
        ]);



        //-----------------------------------------

        //         \App\Models\User::factory()->create([
        //             'name' => 'Test User',
        //             'email' => 'test@example.com',
        //         ]);
    }
}
