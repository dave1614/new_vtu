<?php

namespace Database\Seeders;

use App\Models\VtuSale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VtuSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VtuSale::create([
            'type' => 'airtime',
            'service' => 'clubkonnect',
            'network' => 'mtn',
        ]);
        VtuSale::create([
            'type' => 'airtime',
            'service' => 'clubkonnect',
            'network' => 'airtel',
        ]);
        VtuSale::create([
            'type' => 'airtime',
            'service' => 'clubkonnect',
            'network' => 'glo',
        ]);
        VtuSale::create([
            'type' => 'airtime',
            'service' => 'clubkonnect',
            'network' => '9mobile',
        ]);
        VtuSale::create([
            'type' => 'airtime',
            'service' => 'payscribe',
            'network' => 'mtn',
        ]);
        VtuSale::create([
            'type' => 'airtime',
            'service' => 'payscribe',
            'network' => 'airtel',
        ]);
        VtuSale::create([
            'type' => 'airtime',
            'service' => 'payscribe',
            'network' => 'glo',
        ]);
        VtuSale::create([
            'type' => 'airtime',
            'service' => 'payscribe',
            'network' => '9mobile',
        ]);
        VtuSale::create([
            'type' => 'airtime',
            'service' => 'gsubz',
            'network' => 'mtn',
        ]);
        VtuSale::create([
            'type' => 'airtime',
            'service' => 'gsubz',
            'network' => 'airtel',
        ]);
        VtuSale::create([
            'type' => 'airtime',
            'service' => 'gsubz',
            'network' => 'glo',
        ]);
        VtuSale::create([
            'type' => 'airtime',
            'service' => 'gsubz',
            'network' => '9mobile',
        ]);
        VtuSale::create([
            'type' => 'data',
            'service' => 'clubkonnect',
            'network' => 'mtn',
        ]);
        VtuSale::create([
            'type' => 'data',
            'service' => 'clubkonnect',
            'network' => 'airtel',
        ]);
        VtuSale::create([
            'type' => 'data',
            'service' => 'clubkonnect',
            'network' => 'glo',
        ]);
        VtuSale::create([
            'type' => 'data',
            'service' => 'clubkonnect',
            'network' => '9mobile',
        ]);
        VtuSale::create([
            'type' => 'data',
            'service' => 'gsubz',
            'network' => 'mtn',
        ]);
        VtuSale::create([
            'type' => 'data',
            'service' => 'gsubz',
            'network' => 'airtel',
        ]);
        VtuSale::create([
            'type' => 'data',
            'service' => 'gsubz',
            'network' => 'glo',
        ]);
        VtuSale::create([
            'type' => 'data',
            'service' => 'gsubz',
            'network' => '9mobile',
        ]);
        VtuSale::create([
            'type' => 'data',
            'service' => 'payscribe',
            'network' => 'mtn',
        ]);
        VtuSale::create([
            'type' => 'data',
            'service' => 'payscribe',
            'network' => 'airtel',
        ]);
        VtuSale::create([
            'type' => 'data',
            'service' => 'payscribe',
            'network' => 'glo',
        ]);
        VtuSale::create([
            'type' => 'data',
            'service' => 'payscribe',
            'network' => '9mobile',
        ]);
        VtuSale::create([
            'type' => 'cable',
            'service' => 'clubkonnect',
            'network' => 'dstv',
        ]);
        VtuSale::create([
            'type' => 'cable',
            'service' => 'clubkonnect',
            'network' => 'gotv',
        ]);
        VtuSale::create([
            'type' => 'cable',
            'service' => 'clubkonnect',
            'network' => 'startimes',
        ]);
        VtuSale::create([
            'type' => 'cable',
            'service' => 'gsubz',
            'network' => 'dstv',
        ]);
        VtuSale::create([
            'type' => 'cable',
            'service' => 'gsubz',
            'network' => 'gotv',
        ]);
        VtuSale::create([
            'type' => 'cable',
            'service' => 'gsubz',
            'network' => 'startimes',
        ]);
        VtuSale::create([
            'type' => 'cable',
            'service' => 'payscribe',
            'network' => 'dstv',
        ]);
        VtuSale::create([
            'type' => 'cable',
            'service' => 'payscribe',
            'network' => 'gotv',
        ]);
        VtuSale::create([
            'type' => 'cable',
            'service' => 'payscribe',
            'network' => 'startimes',
        ]);
        VtuSale::create([
            'type' => 'electricity',
            'service' => 'buypower',
            'network' => 'abuja',
        ]);
        VtuSale::create([
            'type' => 'electricity',
            'service' => 'buypower',
            'network' => 'eko',
        ]);
        VtuSale::create([
            'type' => 'electricity',
            'service' => 'buypower',
            'network' => 'enugu',
        ]);
        VtuSale::create([
            'type' => 'electricity',
            'service' => 'buypower',
            'network' => 'ibadan',
        ]);
        VtuSale::create([
            'type' => 'electricity',
            'service' => 'buypower',
            'network' => 'ikeja',
        ]);
        VtuSale::create([
            'type' => 'electricity',
            'service' => 'buypower',
            'network' => 'jos',
        ]);
        VtuSale::create([
            'type' => 'electricity',
            'service' => 'buypower',
            'network' => 'kaduna',
        ]);
        VtuSale::create([
            'type' => 'electricity',
            'service' => 'buypower',
            'network' => 'kano',
        ]);
        VtuSale::create([
            'type' => 'electricity',
            'service' => 'buypower',
            'network' => 'phc',
        ]);
        VtuSale::create([
            'type' => 'electricity',
            'service' => 'payscribe',
            'network' => 'abuja',
        ]);
        VtuSale::create([
            'type' => 'electricity',
            'service' => 'payscribe',
            'network' => 'eko',
        ]);
        VtuSale::create([
            'type' => 'electricity',
            'service' => 'payscribe',
            'network' => 'enugu',
        ]);
        VtuSale::create([
            'type' => 'electricity',
            'service' => 'payscribe',
            'network' => 'ibadan',
        ]);
        VtuSale::create([
            'type' => 'electricity',
            'service' => 'payscribe',
            'network' => 'ikeja',
        ]);
        VtuSale::create([
            'type' => 'electricity',
            'service' => 'payscribe',
            'network' => 'jos',
        ]);
        VtuSale::create([
            'type' => 'electricity',
            'service' => 'payscribe',
            'network' => 'kaduna',
        ]);
        VtuSale::create([
            'type' => 'electricity',
            'service' => 'payscribe',
            'network' => 'kano',
        ]);
        VtuSale::create([
            'type' => 'electricity',
            'service' => 'payscribe',
            'network' => 'phc',
        ]);
        VtuSale::create([
            'type' => 'electricity',
            'service' => 'gsubz',
            'network' => 'abuja',
        ]);
        VtuSale::create([
            'type' => 'electricity',
            'service' => 'gsubz',
            'network' => 'eko',
        ]);
        VtuSale::create([
            'type' => 'electricity',
            'service' => 'gsubz',
            'network' => 'enugu',
        ]);
        VtuSale::create([
            'type' => 'electricity',
            'service' => 'gsubz',
            'network' => 'ibadan',
        ]);
        VtuSale::create([
            'type' => 'electricity',
            'service' => 'gsubz',
            'network' => 'ikeja',
        ]);
        VtuSale::create([
            'type' => 'electricity',
            'service' => 'gsubz',
            'network' => 'jos',
        ]);
        VtuSale::create([
            'type' => 'electricity',
            'service' => 'gsubz',
            'network' => 'kaduna',
        ]);
        VtuSale::create([
            'type' => 'electricity',
            'service' => 'gsubz',
            'network' => 'kano',
        ]);
        VtuSale::create([
            'type' => 'electricity',
            'service' => 'gsubz',
            'network' => 'phc',
        ]);
        VtuSale::create([
            'type' => 'router',
            'service' => 'clubkonnect',
            'network' => 'smile',
        ]);
        VtuSale::create([
            'type' => 'router',
            'service' => 'clubkonnect',
            'network' => 'spectranet',
        ]);
        VtuSale::create([
            'type' => 'educational',
            'service' => 'clubkonnect',
            'network' => 'waec',
        ]);
        VtuSale::create([
            'type' => 'educational',
            'service' => 'payscribe',
            'network' => 'waec',
        ]);
        VtuSale::create([
            'type' => 'educational',
            'service' => 'payscribe',
            'network' => 'neco',
        ]);


        $betting_companies = ['msport', 'bet9ja', 'bangbet', 'betking', '1xbet', 'betway', 'merrybet', 'naijabet', 'nairabet', 'betland', 'betlion', 'supabet', 'mlotto', 'western-lotto', 'hallabet', 'green-lotto'];
        foreach ($betting_companies as $company) {



            VtuSale::create([
                'type' => 'betting',
                'service' => 'clubkonnect',
                'network' => $company,
            ]);
        }



    }
}
