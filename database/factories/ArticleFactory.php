<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\TypeArticle;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "nom"=> $this->faker->lastname,
            "numeroSerie"=> $this->faker->swiftBicNumber(),
            "imageUrl"=> "images/imageplaceholder.png",
            "estDisponible"=> rand(0,1),
            "type_article_id"=> rand(0,4),
        ];
    }
}
