<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@arcacorp.com',
                'is_admin' => '1',
                'password' => bcrypt('admin123'),
            ],
            [
                'name' => 'User',
                'email' => 'userbeta@arcacorp.com',
                'is_admin' => '0',
                'password' => bcrypt('user123'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
