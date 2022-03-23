<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $gender = ['M','F'];
        $selectGenger = $gender[rand(0,1)];
        $degree = ['master','doctors'];
        $selectDegree = $degree[rand(0,1)];
        return [
            'first_name'=>$this->faker->firstName(),
            'last_name'=>$this->faker->lastName(),
            'mobile'=>$this->faker->phoneNumber(),
            'gender'=>$selectGenger,
            'work_id'=>$this->faker->numberBetween(1000,9999),
            'degree'=>$selectDegree,
            'birth_date'=>$this->faker->date(),
            'password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'email'=>$this->faker->email(),
            'cv'=>$this->faker->imageUrl(),
            'avater'=>'login.png',
            'start_time'=>$this->faker->date(),
            'end_time'=>$this->faker->date(),
            'city_id'=>$this->faker->numberBetween(1,20),
            'specialite_id'=>$this->faker->numberBetween(1,20),

        ];
    }
}
