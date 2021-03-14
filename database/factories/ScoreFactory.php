<?php

namespace Database\Factories;

use App\Models\Score;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class ScoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Score::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $student_id = DB::table('students')->select('id')->inRandomOrder()->limit(1)->value('id');
        $student_name = DB::table('students')->where('students.id', $student_id)
            ->select('students.firstname', 'students.lastname')
            ->get();
        $course_id = DB::table('courses')->select('id')->inRandomOrder()->limit(1)->value('id');
        $course_name = DB::table('courses')->where('courses.id', $course_id)
            ->select('courses.name')
            ->get();
        return [
            'score'=> $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 20),
            'student_id' => $student_id,
            'student_name' => $student_name[0]->firstname . ' ' . $student_name[0]->lastname,
            'course_id' => $course_id,
            'course_name' => $course_name[0]->name,
        ];
    }
}
