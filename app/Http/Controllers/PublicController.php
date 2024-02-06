<?php

namespace App\Http\Controllers;
use App\Models\CategoryPlans;
use App\Models\Team;
use App\Models\City;
use App\Models\User;
use App\Models\Service;
use App\Models\Plans;
use App\Models\Meals;
use App\Models\Subscription;
use Illuminate\Http\Request;
use DB;
use DateTime;
class PublicController extends Controller {

    public function index() {
      $plan  = CategoryPlans::orderBy("id", "DESC")->get();
      $team  = Team::get();
      $city = City::get();
      $service  = Service::get();



      // Get Name ToDAt
      $currentDateTime = new DateTime('now');
      $toDay = strtolower($currentDateTime->format('l'));

      $_1_all = Subscription::where([[$toDay, "1"], ['plan', "1"]])->count();
      $_1_bfast = Subscription::where([[$toDay, "1"], ['plan', "1"], ['breakfast', '1']])->count();
      $_1_lunch = Subscription::where([[$toDay, "1"], ['plan', "1"], ['lunch', '1']])->count();
      $_1_dinner = Subscription::where([[$toDay, "1"], ['plan', "1"], ['dinner', '1']])->count();

      return response()->json([
        "plan"  => $plan,
        "team"  => $team,
        "city"  => $city,
        "service"  => $service,
        //'data' => $data
      ]);
    }
    

    public function category($category) {
      $meals = Meals::get();
      $data = Plans::where('category', $category)->get();
      return response()->json([
        'data'  => $data,
        'meals' => $meals
      ]);
    }


    public function update_status(Request $request) {
      $id          = $request->id;
      $status      = $request->status;
      $table       = $request->table;
      $column      = $request->column;

      DB::table($table)->where("id", $id)->update([
        $column => $status,
        "time_last_update" => date("F j, Y, g:i a"),
      ]);

      if($table == "order" && $column == "delivery") :
        $user = User::where("id", $status)->first();
        DB::table($table)->where("id", $id)->update([
          "deliverey_name" => $user->name,
          "delivery" => $user->id
        ]);
      endif;

      return response()->json([
        "table" => $table,
      ]);
    }

    public function destroy(Request $request) {
      $id      = $request->id;
      echo $table   = $request->table;
      DB::table($table)->where("id", $id)->delete();
    }
}
