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
        $user = \App\user::create([
        	'name' => 'admin',
        	 'email' => 'admin@gmail.com',
        	 'password' => bcrypt('admin')
        ]);
        $user->attachRole('admin');
        return $user;
    }
}
