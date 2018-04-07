<?php

use Illuminate\Database\Seeder;
use App\Models\Section;
use App\Models\ExerciseBook;

class ExerciseBooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectionIds = Section::all()->pluck('id')->toArray();

        $faker = app(\Faker\Generator::class);

        $exerciseBooks = factory(ExerciseBook::class)
            ->times(30)
            ->make()
            ->each(function ($exerciseBook) use ($sectionIds, $faker) {
                $exerciseBook->section_id = $faker->randomElement($sectionIds);
            });

        ExerciseBook::insert($exerciseBooks->toArray());
    }
}
