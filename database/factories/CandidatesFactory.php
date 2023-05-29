<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Candidates;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidates>
 */
class CandidatesFactory extends Factory
{
    protected $model = Candidates::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'last_name' => $this->faker->name(),
            'gender' => 'Nam',
            'email' =>  $this->faker->unique()->safeEmail(),
            'phone_number' => $this->faker->phoneNumber(),
            'content' => 'IT Engineer'
        ];
    }
}
