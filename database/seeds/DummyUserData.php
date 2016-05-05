<?php

use Illuminate\Database\Seeder;

class DummyUserData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $aaData =
            [
                'firstname' => str_random(10),
                'lastname' => str_random(10),
                'bithdate' => date('Y-m-d'),
                'gender' => 'm',
                'email' => str_random(10).'@gmail.com',
                'password' => bcrypt('secret'),
            ];
        //DB::table('users')->insert($aaData);
        factory(App\User::class,50)->create();
    }
}
