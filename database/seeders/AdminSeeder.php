<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use User\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => Carbon::now(),
                'phone' => '9856263265',
                'password' => bcrypt('testing1234'),
            ]
        ];

        foreach($admins as $item){
            $admin = User::create($item);
            $admin->assignRole('admin');
        }
    }
}
