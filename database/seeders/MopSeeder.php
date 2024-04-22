<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mop;

class MopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mop::create([
            'name' => 'BDO',
            'number' => '000161016650',
            'type' => 'Bank',
        ]);

        Mop::create([
            'name' => 'BPI',
            'number' => '0429714524',
            'type' => 'Bank',
        ]);

        Mop::create([
            'name' => 'Metrobank',
            'number' => '1813181377284',
            'type' => 'Bank',
        ]);

        Mop::create([
            'name' => 'Pnb',
            'number' => '110310085179',
            'type' => 'Bank',
        ]);

        Mop::create([
            'name' => 'Security Bank',
            'number' => '0000017041371',
            'type' => 'Bank',
        ]);

        Mop::create([
            'name' => 'Unionbank',
            'number' => '109430949568',
            'type' => 'Bank',
        ]);

        Mop::create([
            'name' => 'Flora Mae Llanera',
            'number' => '09159966353',
            'type' => 'Gcash',
        ]);

        Mop::create([
            'name' => 'Flora Mae Llanera',
            'number' => '09159966353',
            'type' => 'Gcash',
        ]);

        Mop::create([
            'name' => 'Jonathan Llanera J',
            'number' => '09106087577',
            'type' => 'Gcash',
        ]);

        Mop::create([
            'name' => 'Flora Mae Llanera',
            'number' => '09159966353',
            'type' => 'Gcash',
        ]);

        Mop::create([
            'name' => 'maridel almendras',
            'number' => '09386314151',
            'type' => 'Gcash',
        ]);

        Mop::create([
            'name' => 'Jonathan Llanera',
            'number' => '09534271035',
            'type' => 'Gcash',
        ]);

        Mop::create([
            'name' => 'Coins.ph',
            'number' => '09159966353',
            'type' => 'Others',
        ]);

        Mop::create([
            'name' => 'Paymaya',
            'number' => '09159966353',
            'type' => 'Others',
        ]);

        Mop::create([
            'name' => 'Grabpay',
            'number' => '09159966353',
            'type' => 'Others',
        ]);
    }
}
