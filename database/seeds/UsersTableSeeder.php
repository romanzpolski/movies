<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = array(
            'name' => 'roman',
            'email' => 'roman@test.com',
            'password'=> bcrypt('secret')
        );

        DB::table('users')->delete();
        User::create($user);
    }
}
