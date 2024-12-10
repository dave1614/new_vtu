<?php

namespace Database\Seeders;

use App\Models\VtuPlatform;
use Illuminate\Database\Seeder;

class VtuPlatformTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {




        \DB::table('vtu_platform')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'mtn_airtime',
                'platform' => 'eminence_vtu',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'airtel_airtime',
                'platform' => 'eminence_vtu',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'glo_airtime',
                'platform' => 'eminence',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => '9mobile_airtime',
                'platform' => 'clubkonnect',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'mtn_data',
                'platform' => 'gsubz_mtncg',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'airtel_data',
                'platform' => 'eminence',
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'glo_data',
                'platform' => 'eminence',
            ),
            7 =>
            array (
                'id' => 8,
                'name' => '9mobile_data',
                'platform' => 'eminence',
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'dstv_cable',
                'platform' => 'clubkonnect',
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'gotv_cable',
                'platform' => 'payscribe',
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'startimes_cable',
                'platform' => 'clubkonnect',
            ),
            11 =>
            array (
                'id' => 12,
                'name' => 'electricity',
                'platform' => 'buypower',
            ),
            12 =>
            array (
                'id' => 13,
                'name' => 'smile_router',
                'platform' => 'payscribe',
            ),
            13 =>
            array (
                'id' => 14,
                'name' => 'abuja_electricity',
                'platform' => 'buypower',
            ),
            14 =>
            array (
                'id' => 15,
                'name' => 'eko_electricity',
                'platform' => 'buypower',
            ),
            15 =>
            array (
                'id' => 16,
                'name' => 'enugu_electricity',
                'platform' => 'buypower',
            ),
            16 =>
            array (
                'id' => 17,
                'name' => 'ibadan_electricity',
                'platform' => 'buypower',
            ),
            17 =>
            array (
                'id' => 18,
                'name' => 'ikeja_electricity',
                'platform' => 'buypower',
            ),
            18 =>
            array (
                'id' => 19,
                'name' => 'jos_electricity',
                'platform' => 'buypower',
            ),
            19 =>
            array (
                'id' => 20,
                'name' => 'kaduna_electricity',
                'platform' => 'buypower',
            ),
            20 =>
            array (
                'id' => 21,
                'name' => 'kano_electricity',
                'platform' => 'buypower',
            ),
            21 =>
            array (
                'id' => 22,
                'name' => 'phc_electricity',
                'platform' => 'buypower',
            ),
            22 =>
            array(
                'id' => 23,
                'name' => 'spectranet_router',
                'platform' => 'clubkonnect',
            ),
            23 =>
            array(
                'id' => 24,
                'name' => 'waec_educational',
                'platform' => 'clubkonnect',
            ),
            24 =>
            array(
                'id' => 25,
                'name' => 'neco_educational',
                'platform' => 'payscribe',
            ),
        ));

        $betting_companies = ['msport', 'bet9ja', 'bangbet', 'betking', '1xbet', 'betway', 'merrybet', 'naijabet', 'nairabet', 'betland', 'betlion', 'supabet', 'mlotto', 'western-lotto', 'hallabet', 'green-lotto'];
        foreach ($betting_companies as $company) {
            VtuPlatform::create([
                'name' => $company . '_betting',
                'platform' => 'clubkonnect',
            ]);
        }
    }
}
