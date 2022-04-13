<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    protected $model = Client::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $ville = $this->faker->city;
        $pays = $this->faker->country;
        return [
            "nom" => $this->faker->lastName,
            "prenom" => $this->faker->firstName,
            "sexe" => array_rand(["H", "F"], 1),
            "dateNaissance" => $this->faker->dateTimeBetween("1990-01-01", "2020-01-01"),
            "lieuNaissance" => "$pays, $ville",
            "nationalite" => $pays,
            "ville" => $ville,
            "pays" => $pays,
            "adresse" => $this->faker->address,
            "telephone" => $this->faker->phoneNumber,
            "pieceIdentite" => array_rand(["CNI","PASSPORT", "PERMIS DE CONDUIRE"]),
            "numPieceIdentite" => $this->faker->creditCardNumber,
        ];
    }
}
