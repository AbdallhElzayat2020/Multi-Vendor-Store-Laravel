<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // new method
        // $user = new User();
        // $user->name = "Admin";
        // $user->email = "admin@gmail.com";
        // $user->password = Hash::make('password'); //  password
        // $user->phone_number = rand(123456789, 9999999999);
        // $user->save();


        // create method
        User::create([
            'name' => "user",
            'email' => "user@gmail.com",
            'password' => Hash::make('password'), //  password
            'phone_number' => '0123456788',
            'store_id' => Store::all()->random()->id,
        ]);

        // query builder
        DB::table('users')->insert([
            'name' => "Admin",
            'email' => "admin@gmail.com",
            'password' => Hash::make('password'), //  password
            'phone_number' => '0123456789',
            'store_id' => Store::all()->random()->id,

        ]);
    }
}
