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
                'gender' => 'L',
                'address_id' => 1,
                'phone_number' => '089612625266',
                'verify_status' => 'Approved',
                'id_role' => 1,
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@pangkaso.com',
                'password' => bcrypt('admin_pangkaso'),
                'gender' => 'L',
                'address_id' => 2,
                'phone_number' => '089612625255',
                'verify_status' => 'Approved',
                'id_role' => 2,
            ],
            [
                'name' => 'Owner',
                'email' => 'owner@pangkaso.com',
                'password' => bcrypt('owner_pangkaso'),
                'gender' => 'L',
                'address_id' => 3,
                'phone_number' => '089612625244',
                'verify_status' => '',
                'id_role' => 3,
            ],
            [
                'name' => 'Customer',
                'email' => 'customer@pangkaso.com',
                'password' => bcrypt('customer_pangkaso'),
                'gender' => 'L',
                'address_id' => 4,
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
