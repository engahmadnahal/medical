<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'doctor_id'=>$this->faker->numberBetween(1,20),
            'patient_id'=>$this->faker->numberBetween(1,20),
            'date'=>$this->faker->date(),
            'time'=>$this->faker->time(),
            'urgent'=>$this->faker->boolean(),
            'report'=>$this->faker->realTextBetween(500,1500),
            'status'=>$this->faker->numberBetween(1,3),
        ];
    }
}
