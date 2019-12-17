<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $create = \App\Permission::create([
    			'name' => 'create-user',
    			'display_name' => 'create user',
    	]);
    }
}
