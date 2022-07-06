<?php

namespace Database\Factories\Notebook;

use Illuminate\Database\Eloquent\Factories\Factory;

class NotebookFactory extends Factory
{
    public function definition()
    {
        return [
            'id' => null,
            'name' => $this->faker->name,
            'company' => $this->faker->company,
            'phone_number' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'birthdate' => $this->faker->date('Y-m-d'),
            'photo' => null,
        ];
    }
}
