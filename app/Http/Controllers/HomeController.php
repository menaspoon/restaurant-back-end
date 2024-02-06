<?php

namespace App\Http\Controllers;
use App\Models\Subscription;
use App\Models\Plans;

use App\Models\Meals;
use DateTime;
use Illuminate\Http\Request;
use DB;
class HomeController extends Controller {



    function test() {
        $data = Plans::withCount(['subscriptions' => function($query) {
            //$query->select('subscriptions_count');
        }])->get();
        return response()->json($data);
    }


    public function index() {

        //$total = Subscription::where($toDay, "1")->count();
        $test = Plans::withCount('subscriptions')->get();
        $subscriptions = Subscription::withCount('plans', 'meals')->get();
        $subscriptions = DB::table('subscriptions.id')->groupBy('plan', 'meals_count')->get();
        return response()->json([

            'subscriptions' => $subscriptions,

            'test' => $test

            

        ]);


    }


}












/*

public function indexxxx() {

    // Get Name ToDAt
    $currentDateTime = new DateTime('now');
    $toDay = strtolower($currentDateTime->format('l'));

    $today = Subscription::where($toDay, "1")->count();
    $today_breakfast =  $today = Subscription::where([[$toDay, "1"], ["breakfast", "1"]])->count();
    $today_lunch =  $today = Subscription::where([[$toDay, "1"], ["lunch", "1"]])->count();
    $today_dinner =  $today = Subscription::where([[$toDay, "1"], ["dinner", "1"]])->count();



    $meal_3 = array(
        Subscription::where([[$toDay, "1"], ['plan', "1"], ['meals_count', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "2"], ['meals_count', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "3"], ['meals_count', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "4"], ['meals_count', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "5"], ['meals_count', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "6"], ['meals_count', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "7"], ['meals_count', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "8"], ['meals_count', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "9"], ['meals_count', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "10"], ['meals_count', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "11"], ['meals_count', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "12"], ['meals_count', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "13"], ['meals_count', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "14"], ['meals_count', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "15"], ['meals_count', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "16"], ['meals_count', '1']])->count(),
    );





    $lunch_dinner= array(
        Subscription::where([[$toDay, "1"], ['plan', "1"], ['lunch', '1'], ['dinner', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "2"], ['lunch', '1'], ['dinner', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "3"], ['lunch', '1'], ['dinner', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "4"], ['lunch', '1'], ['dinner', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "5"], ['lunch', '1'], ['dinner', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "6"], ['lunch', '1'], ['dinner', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "7"], ['lunch', '1'], ['dinner', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "8"], ['lunch', '1'], ['dinner', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "9"], ['lunch', '1'], ['dinner', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "10"], ['lunch', '1'], ['dinner', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "11"], ['lunch', '1'], ['dinner', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "12"], ['lunch', '1'], ['dinner', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "13"], ['lunch', '1'], ['dinner', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "14"], ['lunch', '1'], ['dinner', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "15"], ['lunch', '1'], ['dinner', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "16"], ['lunch', '1'], ['dinner', '1']])->count(),
    );

    $breakfast_lunch = array(
        Subscription::where([[$toDay, "1"], ['plan', "1"], ['lunch', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "2"], ['lunch', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "3"], ['lunch', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "4"], ['lunch', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "5"], ['lunch', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "6"], ['lunch', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "7"], ['lunch', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "8"], ['lunch', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "9"], ['lunch', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "10"], ['lunch', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "11"], ['lunch', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "12"], ['lunch', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "13"], ['lunch', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "14"], ['lunch', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "15"], ['lunch', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "16"], ['lunch', '1'], ['breakfast', '1']])->count(),
    );

    $breakfast_dinner = array(
        Subscription::where([[$toDay, "1"], ['plan', "1"], ['dinner', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "2"], ['dinner', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "3"], ['dinner', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "4"], ['dinner', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "5"], ['dinner', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "6"], ['dinner', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "7"], ['dinner', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "8"], ['dinner', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "9"], ['dinner', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "10"], ['dinner', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "11"], ['dinner', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "12"], ['dinner', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "13"], ['dinner', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "14"], ['dinner', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "15"], ['dinner', '1'], ['breakfast', '1']])->count(),
        Subscription::where([[$toDay, "1"], ['plan', "16"], ['dinner', '1'], ['breakfast', '1']])->count(),
    );

   $dinner= array(
    Subscription::where([[$toDay, "1"], ['plan', "1"], ['dinner', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "2"], ['dinner', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "3"], ['dinner', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "4"], ['dinner', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "5"], ['dinner', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "6"], ['dinner', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "7"], ['dinner', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "8"], ['dinner', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "9"], ['dinner', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "10"], ['dinner', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "11"], ['dinner', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "12"], ['dinner', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "13"], ['dinner', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "14"], ['dinner', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "15"], ['dinner', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "16"], ['dinner', '1']])->count(),
);

   $lunch = array(
    Subscription::where([[$toDay, "1"], ['plan', "1"], ['lunch', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "2"], ['lunch', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "3"], ['lunch', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "4"], ['lunch', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "5"], ['lunch', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "6"], ['lunch', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "7"], ['lunch', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "8"], ['lunch', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "9"], ['lunch', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "10"], ['lunch', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "11"], ['lunch', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "12"], ['lunch', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "13"], ['lunch', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "14"], ['lunch', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "15"], ['lunch', '1']])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "16"], ['lunch', '1']])->count(),
);

   $total_all = array(
    Subscription::where([[$toDay, "1"], ['plan', "1"]])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "2"]])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "3"]])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "4"]])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "5"]])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "6"]])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "8"]])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "9"]])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "10"]])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "11"]])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "12"]])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "13"]])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "14"]])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "15"]])->count(),
    Subscription::where([[$toDay, "1"], ['plan', "16"]])->count(),
);


    $total = Subscription::where($toDay, "1")->count();
    $test = Plans::withCount('subscriptions')->get();
    $subscriptions = Subscription::withCount('plans', 'meals')->get();

    return response()->json([
        "today" => $today,
        "today_breakfast" => $today_breakfast,
        "today_lunch" => $today_lunch,
        "today_dinner" => $today_dinner,
        
        'meal_3'=> $meal_3,
        'total_meal_3' => array_sum($meal_3),

        'lunch_dinner'=> $lunch_dinner,
        'total_lunch_dinner' => array_sum($lunch_dinner),

        'lunch'=> $lunch,
        'total_lunch' => array_sum($lunch),

        'breakfast_dinner'=> $breakfast_dinner,
        'total_breakfast_dinner' => array_sum($breakfast_dinner),

        'breakfast_lunch'=> $breakfast_lunch,
        'total_breakfast_lunch' => array_sum($breakfast_lunch),

        'dinner'=> $dinner,
        'total_dinner' => array_sum($dinner),

        'total_all' => $total_all,
        'subscriptions' => $subscriptions,

        'test' => $test

        

    ]);

*/