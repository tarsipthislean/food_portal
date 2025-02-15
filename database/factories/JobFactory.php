<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\JobType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->jobTitle(),
            'category_id' => Category::factory(),
            'job_type_id' => JobType::factory(),
            'vacancy' => $this->faker->numberBetween(1, 5),
            'salary' => $this->faker->randomFloat(2, 2000, 5000),
            'location' => $this->faker->city(),
            'description' => $this->faker->text(),
            'benefits' => $this->faker->text(),
            'responsibility' => $this->faker->text(),
            'qualifications' => $this->faker->text(),
            'keywords' => $this->faker->words(3, true),
            'experience' => $this->faker->word(),
            'company_name' => $this->faker->company(),
            'company_location' => $this->faker->city(),
            'job_image' => $this->faker->image(storage_path('app/public/job_images'), 640, 480, 'business', false),
        ];
    }
}
