<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
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
                'name' => 'Super Admin',
                'email' => 'superadmin@pangkaso.com',
                'password' => bcrypt('superadmin'),
                'gender' => 'male',
                'address' => 'localhost',
                'phone_number' => '089612625266',
                'verify_status' => 'Approved',
                'id_role' => 1,
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@pangkaso.com',
                'password' => bcrypt('admin_pangkaso'),
                'gender' => 'male',
                'address' => 'localhost',
                'phone_number' => '089612625255',
                'verify_status' => 'Approved',
                'id_role' => 2,
            ],
            [
                'name' => 'Owner',
                'email' => 'owner@pangkaso.com',
                'password' => bcrypt('owner_pangkaso'),
                'gender' => 'male',
                'address' => 'localhost',
                'phone_number' => '089612625244',
                'verify_status' => '',
                'id_role' => 3,
            ],
            [
                'name' => 'Customer',
                'email' => 'customer@pangkaso.com',
                'password' => bcrypt('customer_pangkaso'),
                'gender' => 'male',
                'address' => 'localhost',
                'latitude' => '-6.5637928',
                'longitude' => '106.7535061',
                'phone_number' => '089612625277',
                'verify_status' => '',
                'id_role' => 4,
            ],
        ];

        foreach ($user as $u) {
            User::create($u);
        }
    }
}
