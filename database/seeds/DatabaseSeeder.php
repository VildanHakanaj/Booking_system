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

        //Add the admin first
        DB::table('users')->insert([
            'name' => "Vildan Hakanaj",
            'stdn' => "059373",
            'email' => "example@example.com",
            'password' => bcrypt('password'),
            'admin' => 1,
        ]);

        //Add the default reason
        DB::table('reasons')->insert([
            'title' => "other",
            'description' => "This is the default reason for the users",
            'expires_at' => date('Y-04-30'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //Auto generate data for the database
        factory(App\User::class, 50)->create();
        factory(App\Reason::class, 12)->create();
        factory(App\ReasonToBook::class, 30)->create();
        factory(App\Product::class, 100)->create();
        factory(App\Kit::class, 20)->create();

    }
}
