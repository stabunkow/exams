<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(\App\Models\User::class)
            ->times(10)
            ->make()
            ->makeVisible(['password', 'remember_token']);

        User::insert($users->toArray());

        $user = User::find(1);
        $user->name = 'stabunkow';
        $user->email = 'stabunkow@outlook.com';
        $user->save();
    }
}
