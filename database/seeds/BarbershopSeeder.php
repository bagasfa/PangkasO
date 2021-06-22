<?php

use Illuminate\Database\Seeder;
use App\Barbershop;

class BarbershopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $barber = ['owner_id' => '3'];
        
        Barbershop::create($barber);
    }
}
