<?php

use Illuminate\Database\Seeder;
use App\Models\Section;
use App\Models\Subject;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(\Faker\Generator::class);

        $subjectIds = Subject::all()->pluck('id')->toArray();

        $sections = factory(Section::class)
            ->times(20)
            ->make()
            ->each(function ($section) use ($subjectIds, $faker) {
                $section->subject_id = $faker->randomElement($subjectIds);
            });

        Section::insert($sections->toArray());
    }
}
