<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(HeadlinesTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(ExerciseBooksTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
