<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\Post::class, function (Faker $faker) {

    return [
        'meta_description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'meta_keywords' => implode(',', $faker->words($nb = 3, $asText = false)),
        'excerpt' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
        'body' => $faker->paragraphs($nb = 8, $asText = true),
        'active' => true,
    ];
});
