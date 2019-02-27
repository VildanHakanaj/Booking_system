<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => "Vildan Hakanaj",
            'stdn' => "059373",
            'email' => "example@example.com",
            'password' => bcrypt('password'),
            'admin' => 1,
        ]);

        DB::table('reasons')->insert([
            'title' => "other",
            'description' => "This is the default reason for the users",
            'expires_at' => date('Y-04-30'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);



        factory(App\User::class, 50)->create();

    }
}
