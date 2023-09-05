<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Genre;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('ru_RU');

        Genre::create(['name' => 'Комедия']);
        Genre::create(['name' => 'Ужасы']);
        Genre::create(['name' => 'Детектив']);
        Genre::create(['name' => 'Романтика']);
        Genre::create(['name' => 'Руководство']);
        Genre::create(['name' => 'Фантастика']);
        Genre::create(['name' => 'Фэнтази']);

        for ($i = 1; $i <= 12; $i++) {
            $author = Author::create([
                'first_name' => $faker->firstName('male'),
                'second_name' => $faker->lastName('male'),
                'login' => $faker->userName(),
                'password' => bcrypt($faker->password())
            ]);

            $bookNumber = rand(5, 13);

            for ($j = 1; $j <= $bookNumber; $j++) {
                $book = $author->books()->create([
                    'name' => $faker->realText(40),
                    'edition' => intval(rand(0, 2))
                ]);


                $genreNumber = rand(1, 3);
                $genreList = array();
                for ($k = 1; $k <= $genreNumber; $k++) {
                    $genre = rand(1, Genre::all()->count());
                    array_push($genreList, $genre);
                }

                $book->genres()->sync(array_unique($genreList));
            }
        }
    }
}
