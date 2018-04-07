<?php

use Illuminate\Database\Seeder;
use App\Models\Headline;

class HeadlinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $headlines = factory(Headline::class)
            ->times(4)
            ->make();

        Headline::insert($headlines->toArray());
    }
}
