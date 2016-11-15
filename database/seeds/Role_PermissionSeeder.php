<?php

use Illuminate\Database\Seeder;

class Role_PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\Role::create([
            'name' => 'admin',

        ]);
        \App\Model\Permission::create([
            'name' => 'delete user',
        ]);
    }
}
