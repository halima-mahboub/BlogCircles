<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //$user = DB::table('users')->where('email', 'algorithm@gmail.com')->first();

        if (! $user) {
          User::create([
            'name' => 'algorithm',
            'email' => 'algorithm@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'admin'
          ]);
    }
}