<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $promotion_id = DB::table('promotions')->select('id')->inRandomOrder()->limit(1)->value('id');
        $promotion_name = DB::table('promotions')->where('promotions.id', $promotion_id)
            ->select('promotions.name')
            ->get();
        $teacher_id = DB::table('teachers')->select('id')->inRandomOrder()->limit(1)->value('id');
        $teacher_name = DB::table('teachers')->where('teachers.id', $teacher_id)
            ->select('teachers.firstname', 'teachers.lastname')
            ->get();
        $start_date = $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+ 5 days');
        $end_date = $this->faker->dateTimeBetween($startDate = $start_date, $endDate = '+ 5 days');

        return [
            'name'=> $this->faker->catchPhrase(),
            'start_at'=>$start_date,
            'end_at'=>$end_date,
            'promotion_id' => $promotion_id,
            'promotion_name' => $promotion_name[0]->name,
            'teacher_id' => $teacher_id,
            'teacher_name' => $teacher_name[0]->firstname . ' ' . $teacher_name[0]->lastname,
        ];
    }
}
