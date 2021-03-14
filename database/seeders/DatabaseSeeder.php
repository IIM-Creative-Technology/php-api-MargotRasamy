<?php

namespace Database\Seeders;

use App\Models\Promotion;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admins = ['Nicolas RAUBER', 'Alexis GYBOU', 'Karine MOUSDIK'];

        DB::table('users')->truncate();

        // Create admins
        foreach ($admins as $admin) {
            DB::table('users')->insert(['name'=> $admin,
                'email'=> str_replace(' ', '.', strtolower($admin)).'@edu.devinci.fr',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'password'=>Hash::make('password'),
                'remember_token'=> Str::random(10),
                'api_token'=> Str::random(32),
                'admin'=> true]);
        }
        // Other users
        User::factory(1)->create();

        DB::table('promotions')->truncate();
        Promotion::factory(5)->create();

        DB::table('teachers')->truncate();
        Teacher::factory(15)->create();
    }
}
