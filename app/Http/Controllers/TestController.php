<?php

namespace App\Http\Controllers;

use App\Functions\UsefulFunctions;
use App\Models\VtuSale;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

// use \Response;

class TestController extends Controller
{

    public UsefulFunctions $functions;

    public function __construct()
    {
        $this->functions = new UsefulFunctions();
    }

    public function webTest(Request $request){


        $all_months = $this->functions->outPutMonthsBetweenTwoDates("Aug 2024", "Aug 2040");
        for($i = 0; $i < count($all_months); $i++){
            $all_months[$i] = strtolower(str_replace(' ', '_', $all_months[$i]));
        }

        // dd($sales);
        // return $all_months;
        $sales = VtuSale::all();
        $salesArray = $sales->toArray();
        foreach ($salesArray as $key => $value) {
            foreach ($value as $column => $val) {
                if(in_array($column, $all_months)){
                    return  $column . " " . $val;
                }
            }
        }
    }

    public function index(Request $request){

        // return strtotime(date('H:i:sa'));
        // return response()->json(['success' => true,'message' => 'Request Successful'], ($request->headers->has('X-Header') && Cookie::has('color')) ? 200 : 500);

        // $this->functions->getIdsToCreditVtu($mlm_db_id, $steps);

        // return $this->functions->fixGainAndSaleRecordsForVtu(17);

        // $order_id = "BP88677434";
        // $url = "https://api.buypower.ng/v2/transaction/" . $order_id;
        // $use_post = false;

        // $response = $this->functions->buyPowerVtuCurl($url, $use_post, $post_data = []);


        // if ($this->functions->isJson($response)) {
        //     $response = json_decode($response);
        //     return $response;
        // }

        // return preg_replace('/^[N]/',"","DStv Great Wall Standalone Bouquet N2500");

        $date1 = "Aug 2024";
        $date2 = "Aug 2030";

        // return $this->functions->outPutMonthsBetweenTwoDates($date1, $date2);
        $this->functions->resetVtuSalesAndProfit();

        $this->functions->inputDummyDataForVtuProfitAndSales();
    }

    public function testLogin(Request $request): JsonResponse{
        $user = auth()->user();


        return response()->json(['success' => true,'details' => ['user' => $user]],201);

    }

    public function generateDataPlansJsonDefault(Request $request){
        $gsubz_mtn_plans = $this->functions->getAllGsubzPlansForDefault('mtn');
        $gsubz_glo_plans = $this->functions->getAllGsubzPlansForDefault('glo');
        $gsubz_airtel_plans = $this->functions->getAllGsubzPlansForDefault('airtel');
        $gsubz_9mobile_plans = $this->functions->getAllGsubzPlansForDefault('9mobile');

        $club_mtn_plans = $this->functions->getAllClubPlansForDefault('MTN');

        $mtn_plans = $this->functions->getAllDataPlansDefaultByNetwork('9mobile');



        return $mtn_plans;
        // return $club_mtn_plans;
    }
}
