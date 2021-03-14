<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Promotion;
use App\Models\Score;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
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
        Schema::disableForeignKeyConstraints();
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
        User::factory(10)->create();

        DB::table('promotions')->truncate();
        Promotion::factory(5)->create();

        DB::table('teachers')->truncate();
        Teacher::factory(15)->create();

        DB::table('students')->truncate();
        Student::factory(25)->create();

        DB::table('courses')->truncate();
        Course::factory(10)->create();

        // Change here to add more scores automatically
        DB::table('scores')->truncate();
        Score::factory(5)->create();

        Schema::enableForeignKeyConstraints();
    }
}
