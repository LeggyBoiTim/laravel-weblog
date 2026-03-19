<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $article = Article::inRandomOrder()->first();

        if ($article->is_premium) {
            $user = User::where('has_premium', true)->inRandomOrder()->first();
        } else {
            $user = User::inRandomOrder()->first();
        }

        return [
            'article_id' => $article->id,
            'user_id' => $user->id,
            'content' => $this->faker->sentence(),
        ];
    }
}
