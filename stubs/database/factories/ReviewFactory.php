<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition()
    {
        return [
            'team_id' => 1,
            'user_id' => 1,
            'reviewable_type' => 'App\\Models\\Item',
            'reviewable_id' => 1,
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->paragraph(),
            'approved_at' => now(),
        ];
    }
}
