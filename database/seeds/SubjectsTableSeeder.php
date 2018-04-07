<?php

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = factory(Subject::class)
            ->times(10)
            ->make();

        Subject::insert($subjects->toArray());
    }
}
