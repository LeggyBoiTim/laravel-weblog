<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Article $article) {
            $article->categories()->attach($article->user->categories()->inRandomOrder()->limit(rand(1, 5))->get());
            if ($article->user->has_premium) {
                $article->is_premium = rand(0, 1);
                $article->save();
            }
        });
    }
}
