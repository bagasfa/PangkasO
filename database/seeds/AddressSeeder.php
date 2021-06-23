<?php

use Illuminate\Database\Seeder;
use App\Address;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $address = [
             [
                'detail' => 'Jl. A RT.3/RW.2',
                'kecamatan' => 'MERAKURAK',
                'kabupaten' => 'KABUPATEN TUBAN',
                'provinsi' => 'JAWA TIMUR',
                'kode_pos' => '62351',
                'latitude' => '-6.8976',
                'longitude' => '112.0649',
            ],
            [
                'detail' => 'Jl. B RT.2/RW.4',
                'kecamatan' => 'SIMEULUE TIMUR',
                'kabupaten' => 'KABUPATEN SIMEULUE',
                'provinsi' => 'ACEH',
                'kode_pos' => '62352',
                'latitude' => '2.4920691',
                'longitude' => '96.3465379',
            ],
            [
                'detail' => 'Jl. C RT.5/RW.1',
                'kecamatan' => 'MERAKURAK',
                'kabupaten' => 'KABUPATEN TUBAN',
                'provinsi' => 'JAWA TIMUR',
                'kode_pos' => '62354',
                'latitude' => '-6.9976',
                'longitude' => '112.0649',
            ],
            [
                'detail' => 'Jl. D RT.4/RW.7',
                'kecamatan' => 'ILAGA',
                'kabupaten' => 'KABUPATEN PUNCAK',
                'provinsi' => 'PAPUA',
                'kode_pos' => '62355',
                'latitude' => '-3.9809447',
                'longitude' => '137.6332155',
            ],
        ];

        foreach ($address as $a) {
            Address::create($a);
        }
    }
}
