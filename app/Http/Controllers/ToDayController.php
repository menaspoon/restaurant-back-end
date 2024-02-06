<?php

namespace App\Http\Controllers;
use App\Models\Plans;
use App\Models\Banks;
use App\Models\User;
use App\Models\City;
use App\Models\Subscription;
use DateTime;
use Illuminate\Http\Request;

class ToDayController extends Controller {


    public function index(Request $request) {
      $plans = Plans::get();
      $banks = Banks::get();
      $clints = User::get();
      $city = City::get();      
      $delivery  = User::where("acount", "delivery ")->get();
      $dateToDay = (date("j") < 10)  ? date("Y-n-0j") : date("Y-n-j");



      // Get Name ToDAt
      $currentDateTime = new DateTime('now');
      $toDay = strtolower($currentDateTime->format('l'));
      $test = $toDay;

      // subscriptions Query
      $data = Subscription::query();
      // Join Table => banks, subscriptions, users, plans
      $data->join("plans", "plans.id", "=", "subscriptions.plan")
                        //->join("users", "users.id", "=", "subscriptions.clint")
                        ->join("meals", "meals.id", "=", "subscriptions.meals_count")
                        ->select(
                                "meals.name as meals_name",  
                                 "plans.name as plan_name",
                                 "subscriptions.*")
                                 ->where($toDay, "1")
                                 //->where("date", ">=", $dateToDay)
                                 ->where("operation_status", "1");
                                 

      //If thare is Start > Get Data with $request->start
      if($request->status) :
          $data->where("subscriptions.status", $request->status);
      endif;
      // If thare is isset plan > Get Data with $request->plan
      if($request->plan > 0) :
          $data->where("subscriptions.plan", $request->plan);
      endif;
      if($request->city > 0) :
          $data->where("users.city", $request->city);
      endif;
      if($request->search) :
        $data->where('users.name', 'like', '%' . request('search') . '%');
        $data->where('users.phone', 'like', '%' . request('phone') . '%');
      endif;


      // Get Data
      $subscription = $data->get();
      // Return Data
      return response()->json([
        "plans"   => $plans,
        "banks"   => $banks,
        "clints"  => $clints,
        "subscription"  => $subscription,
        "city"    => $city,
        "delivery" => $delivery,

        "test" => $test,
        "date" => $dateToDay,
      ]);

    }


    public function store(Request $request) {
        Subscription::insert([
          "clint"    => $request->clint,
          //"muazaf"   => $request->muazaf,
          "plan"     => $request->plan,
          "gram"     => $request->gram,
          "note"     => $request->note,

          "sunday"   => $request->sunday,
          "monday"   => $request->monday,
          "tuesday"  => $request->tuesday,
          "wednesday" => $request->wednesday,
          "thursday" => $request->thursday,
          "friday"   => $request->friday,
          "saturday" => $request->saturday,

          "breakfast" => request("breakfast"),
          "lunch"     => request("lunch"),
          "dinner"    => request("dinner"),

          'date'     => date("Y-n-j"),
          'time'     => date("F j, Y, g:i a"),
        ]);
        return response()->json([
          "statusCode" => 1,
          "status" => 'success'
        ]);
    }

    public function update_status(Request $request) {
      Subscription::where("id", $request->id)->update([
        "status"    => $request->status,
        //"muazaf"   => $request->muazaf,

        //"note"     => $request->note,
        //'time'     => date("F-j-Y"),
        //'date'     => date("F j, Y, g:i a"),
      ]);
      return response()->json([
        "statusCode" => 1,
        "status" => 'success'
      ]);

    }

}
