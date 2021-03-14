<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

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
        return [
            'firstname'=> $this->faker->firstName(),
            'lastname'=>$this->faker->lastName(),
            'age'=>$this->faker->numberBetween($min = 16, $max = 30),
            'arrival_year'=>$this->faker->year($max = 'now'),
            'promotion_id' => $promotion_id,
            'promotion_name' => $promotion_name[0]->name,
        ];
    }
}
