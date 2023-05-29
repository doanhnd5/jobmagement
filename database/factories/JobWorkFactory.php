<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\JobWork;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidates>
 */
class JobWorkFactory extends Factory
{
    protected $model = JobWork::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_name'             => Str::random(5),
            'category_id'          => 'batito',
            'employment_type_id'   => 'employee',
            'salary_min'           => 10,
            'salary_max'           => 25,
            'work_time_from'       => '0800',
            'work_time_to'         => '1800',
            'workplace_prefecture' => 'kyushu',
            'workplace_address'    => $this->faker->address(),
        ];
    }
}
