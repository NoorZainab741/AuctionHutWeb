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
        $admins = array(
            [
                'first_name' => 'Noor',
                'last_name' => 'Zainab',
                'phone' => '1234567890',
                'email' => 'admin@system.com',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'gender' => 'Female',
                'role' => 'admin',
                'status' => 'Active'
            ],
        );

        foreach ($admins as $admin) {
            \App\User::create($admin);
        }
    }
}
