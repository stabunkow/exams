<?php

use Illuminate\Database\Seeder;
use App\Models\ExerciseBook;
use App\Models\Question;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exerciseBookIds = ExerciseBook::all()->pluck('id')->toArray();

        $faker = app(\Faker\Generator::class);

        $questions = factory(\App\Models\Question::class)
            ->times(100)
            ->make()
            ->each(function ($question) use ($exerciseBookIds, $faker) {
                $question->questionable_type = 'App\Models\ExerciseBook';
                $question->questionable_id = $faker->randomElement($exerciseBookIds);

                $type = rand(1, 2);
                $question->type = $type;

                $selections = [
                    $faker->sentence,
                    $faker->sentence,
                    $faker->sentence,
                    $faker->sentence
                ];
                $question->selections = json_encode($selections);

                if ($type === 1) {
                    $question->answer = 'A';
                } else {
                    $question->answer = 'A,B';
                }
            });

        Question::insert($questions->toArray());
    }
}
