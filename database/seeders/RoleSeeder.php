<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'vendor'
            ],
            [
                'name' => 'admin'
            ],
            [
                'name' => 'superadmin'
            ]
            ];


            foreach($roles as $role){
                Role::create($role);
            }
    }
}
