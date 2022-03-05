<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'first_name'=>$this->faker->firstName(),
            'last_name'=>$this->faker->lastName(),
            'mobile'=>$this->faker->phoneNumber(),
            'national_num'=>$this->faker->numberBetween(1000,9999),
            'ensurance_num'=>$this->faker->numberBetween(1000,9999),
            'birth_date'=>$this->faker->date(),
            'active'=>$this->faker->boolean(),
            'email'=>$this->faker->email(),
            'password'=>$this->faker->password(),
            'city_id'=>$this->faker->numberBetween(1,20),
        ];
    }
}
