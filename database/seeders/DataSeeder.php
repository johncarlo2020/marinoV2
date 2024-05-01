<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Network;
use App\Models\Amount;
use App\Models\Package;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Network::create([
            'name' => 'AIS',
            'image' => 'test',
        ]);

        Network::create([
            'name' => 'DTAC',
            'image' => 'test',
        ]);

        Network::create([
            'name' => 'TRUE',
            'image' => 'test',
        ]);

        Network::create([
            'name' => 'Network Loop',
            'image' => 'test',
        ]);


        Package::create([
            'name' => '2 days 1GB',
            'description' => '2 days 1GB',
            'code' => '11',
            'baht' => '119',
            'php_amount' => '300',
        ]);

        Package::create([
            'name' => '8 days 4GB',
            'description' => '8 days 4GB',
            'code' => '12',
            'baht' => '300',
            'php_amount' => '300',
        ]);

        Package::create([
            'name' => 'Global 3 days 1GB',
            'description' => 'Global 3 days 1GB',
            'code' => '21',
            'baht' => '300',
            'php_amount' => '300',
        ]);

        Package::create([
            'name' => 'Global 15 days 4GB',
            'description' => 'Global 15 day s4GB',
            'code' => '22',
            'baht' => '799',
            'php_amount' => '300',
        ]);

        Amount::create([
            'baht' => '10',
            'peso' => '70',
            ]);
        Amount::create([
            'baht' => '20',
            'peso' => '90',
            ]);
        Amount::create([
            'baht' => '30',
            'peso' => '100',
            ]);
        Amount::create([
            'baht' => '50',
            'peso' => '130',
            ]);
        Amount::create([
                'baht' => '100',
                'peso' => '200',
                ]);
        Amount::create([
                'baht' => '120',
                'peso' => '230',
                ]);
       
                
    }
}
