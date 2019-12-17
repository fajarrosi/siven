<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	$admin = \App\Role::create([
    			'name' => 'admin',
    			'display_name' => 'admin',
    			'description' =>'can do anything in the project'
    	]);
    	$guru = \App\Role::create([
    			'name' => 'guru',
    			'display_name' => 'guru',
    	]);
    	$juru_bengkel = \App\Role::create([
    			'name' => 'juru-bengkel',
    			'display_name' => 'juru bengkel',
    	]);
    	$kpk = \App\Role::create([
    			'name' => 'kpk',
    			'display_name' => 'kpk',
    	]);
    	$wks = \App\Role::create([
    			'name' => 'wks',
    			'display_name' => 'wks',
    	]);
    }
}
