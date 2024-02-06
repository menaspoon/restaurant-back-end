<?php

namespace App\Http\Controllers;
use App\Models\Plans;
use App\Models\Banks;
use App\Models\User;
use App\Models\City;
use App\Models\Meals;
use App\Models\Subscription;
use App\Models\OperationStatusSubscriptions;

use Illuminate\Http\Request;

class SubscriptionController extends Controller {

    public function index(Request $request) {
      $plans = Plans::get();
      $banks = Banks::get();
      $clints = User::get();
      $city = City::get();
      $meals = Meals::get();
      $operation_status = OperationStatusSubscriptions::get();

      $test = "";
      // subscriptions Query
      $data = Subscription::query();
      // Join Table => banks, subscriptions, users, plans, operation_status_subscriptions
      $data->join("plans", "plans.id", "=", "subscriptions.plan")
            ->join("meals", "meals.id", "=", "subscriptions.meals_count")
            ->join("operation_status_subscriptions", "operation_status_subscriptions.id", "=", "subscriptions.operation_status")
            ->select("plans.name as plan_name", 
                     "meals.name as meals_name",  
                     "operation_status_subscriptions.name as operation_status_name", 
                     "subscriptions.*"
            );
      //If thare is Start > Get Data with $request->start
      if($request->start) :
          $data->where("subscriptions.date", ">=", $request->start);
          $test = $request->start;
      endif;
      //If thare is End > Get Data with $request->end
      if($request->end) :
          $data->where("subscriptions.date", "<=", $request->end);
      endif;
      //If thare is isset clint > Get Data with $request->clint
      if($request->clint > 0) :
          $data->where("subscriptions.clint", $request->clint);
      endif;
      //If thare is isset bank > Get Data with $request->bank
      if($request->bank > 0) :
          $data->where("subscriptions.bank", $request->bank);
      endif;
      // If thare is isset plan > Get Data with $request->plan
      if($request->plan > 0) :
          $data->where("subscriptions.plan", $request->plan);
      endif;
      if($request->city > 0) :
          $data->where("users.city", $request->city);
      endif;
      if($request->search) :
        $data->where('users.name', 'like', '%' . request('search') . '%')
             ->orWhere('users.phone', 'like', '%' . request('phone') . '%');
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
        "meals"   => $meals,
        "operation_status" => $operation_status,
        "test" => $test
      ]);

    }


    public function store(Request $request) {
        Subscription::insert([
          "operation_status"  => $request->status,
          "meals_count"  => $request->meals_count,
          "plan"     => $request->plan,
          "days"     => $request->days,
          "counter_day" => $request->days,
          //"gram"     => $request->gram,
          "note"     => $request->note,

          "username"  => $request->username,
          "phone"     => $request->phone,
          "age"       => $request->age,
          "weight"    => $request->weight,
          "height"    => $request->height,
          "practiced_activity"  => $request->practiced_activity,
          "delivery_days"       => $request->delivery_days,
          "meals"     => implode(',', $request->meals),

          "delivery_data"       => $request->delivery_data,
          "receiving_method"     => $request->receiving_method,

          'address'  => $request->address,

          "date"     => request("date"),
          'time'     => date("F j, Y, g:i a"),
        ]);

        $subscription = Subscription::orderBy("id", "DESC")->first();
        if($subscription->delivery_days == 'من السبت - الخميس') :
          Subscription::where("id", $subscription->id)->update([
            "sunday"   => 1,
            "monday"   => 1,
            "tuesday"  => 1,
            "wednesday" => 1,
            "thursday" => 1,
            "friday"   => 0,
            "saturday" => 1,
          ]);
        endif;
        if($subscription->delivery_days == 'من الاحد - الخميس') :
          Subscription::where("id", $subscription->id)->update([
            "sunday"   => 1,
            "monday"   => 1,
            "tuesday"  => 1,
            "wednesday" => 1,
            "thursday" => 1,
            "friday"   => 0,
            "saturday" => 0,
          ]);
        endif;
        if($subscription->delivery_days == 'من السبت - الاربع') :
          Subscription::where("id", $subscription->id)->update([
            "sunday"   => 1,
            "monday"   => 1,
            "tuesday"  => 1,
            "wednesday" => 1,
            "thursday" => 0,
            "friday"   => 0,
            "saturday" => 1,
          ]);
        endif;

        return response()->json([
          "statusCode" => 1,
          "status" => 'success'
        ]);
    }


    public function update(Request $request) {
      Subscription::where("id", $request->id)->update([
        "operation_status"  => $request->status,
        "meals_count"  => $request->meals_count,
        "plan"     => $request->plan,
        "days"     => $request->days,
        "counter_day" => $request->days,
        "note"     => $request->note,

        "username"  => $request->username,
        "phone"     => $request->phone,
        "age"       => $request->age,
        "weight"    => $request->weight,
        "height"    => $request->height,
        "practiced_activity"  => $request->practiced_activity,
        "delivery_days"       => $request->delivery_days,
        //"meals"     => implode(',', $request->meals),
        'address'  => $request->address,

        "delivery_data"       => $request->delivery_data,
        "receiving_method"     => $request->receiving_method,

        "date"     => request("date"),
        'time'     => date("F j, Y, g:i a"),
      ]);

      $subscription = Subscription::orderBy("id", "DESC")->first();
      if($subscription->delivery_days == 'من السبت - الخميس') :
        Subscription::where("id", $subscription->id)->update([
          "sunday"   => 1,
          "monday"   => 1,
          "tuesday"  => 1,
          "wednesday" => 1,
          "thursday" => 1,
          "friday"   => 0,
          "saturday" => 1,
        ]);
      endif;
      if($subscription->delivery_days == 'من الاحد - الخميس') :
        Subscription::where("id", $subscription->id)->update([
          "sunday"   => 1,
          "monday"   => 1,
          "tuesday"  => 1,
          "wednesday" => 1,
          "thursday" => 1,
          "friday"   => 0,
          "saturday" => 0,
        ]);
      endif;
      if($subscription->delivery_days == 'من السبت - الاربع') :
        Subscription::where("id", $subscription->id)->update([
          "sunday"   => 1,
          "monday"   => 1,
          "tuesday"  => 1,
          "wednesday" => 1,
          "thursday" => 0,
          "friday"   => 0,
          "saturday" => 1,
        ]);
      endif;

      return response()->json([
        "statusCode" => 1,
        "status" => 'success'
      ]);

    }

}
