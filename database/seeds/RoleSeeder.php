<?php

use Illuminate\Database\Seeder;
use App\Roles;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
             [
                'role_name' => 'Super Admin',
            ],
            [
                'role_name' => 'Admin',
            ],
            [
                'role_name' => 'Owner',
            ],
            [
                'role_name' => 'Customer',
            ],
        ];

        foreach ($role as $r) {
            Roles::create($r);
        }
    }
}
