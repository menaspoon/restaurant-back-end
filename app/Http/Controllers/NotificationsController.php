<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notifications;

class NotificationsController extends Controller {

    public function index($user) {
      $data = Notifications::where("user", $user)
                            ->join("users", "users.id", "=", "notifications.sender", )
                            ->select("users.name as username", "notifications.*")
                            ->orderBy("id", "DESC")
                            ->get();
      return response()->json([
        "data" => $data,
      ]);
    }

    public function user(Request $request) {
      $data = User::where("id", Auth::id())->first();
    }

    public function login(Request $request) {

      $status     = "";
      $statusCode = 0;
      $email      = $request->email;
      $password   = $request->password;
      // Query Statment Login By Email || Password
      $login = User::where([
                            ["email", $email],
                            ["password", $password]
                          ])->first();
      // Condation Status User is Login
      if($login) :
        $status     = "success";
        $statusCode = 1;
        $token = bin2hex(random_bytes(32));
        $user_id = $login->id;
      else :
        $status     = "faild";
        $statusCode = 0;
        $token = null;
        $user_id = null;
      endif;
      // Return Data
      return response()->json([
        "status"      => $status,
        "statusCode"  => $statusCode,
        "token"       => $token,
        "user_id"     => $user_id,
      ]);

    }



    public function profile($id) {
      $data = User::where("id", $id)->first();
      $city = City::get();
      if ($data) {
        $statusCode = 1;
      } else {
        $statusCode = 0;
      }
      return response()->json([
        "data" => $data,
        "city" => $city,
        "statusCode" => $statusCode,
      ]);

    }


    public function store(Request $request) {
      User::insert([
          "name"      => $request->name,
          "email"     => $request->email,
          "phone"     => $request->phone,
          "city"      => $request->city,
          "address"   => $request->address,
          "password"  => $request->password,
          "acount"    => $request->acount,
      ]);
    }

    public function signup(Request $request) {
        User::insert([
            "name"      => $request->name,
            "email"     => $request->email,
            "phone"     => $request->phone,
            "city"      => $request->city,
            "password"  => $request->password,
            "acount"    => "clint",
        ]);
    }

    public function update(Request $request) {
      User::where("id", $request->id)->update([
        "name"       => $request->name,
        "email"      => $request->email,
        "phone"      => $request->phone,
        "city"       => $request->city,
        "address"    => $request->address,
        "password"   => $request->password,
      ]);
    }
    public function update_my_acount(Request $request) {
      $user = User::where("id", $request->id)->first();
      if($request->picture) :
        $fileExtintion = $request->picture->getclientoriginalextension();
        $fileName = time() . "." . $fileExtintion;
        $path = "G:\Vue Js\\restaurant\public\img";
        $request->picture->move($path, $fileName);
        //$picture_name = 
        $name = "fff";
      else :
        $fileName = $user->picture;
      endif;
      $name = $fileName;

      User::where("id", $request->id)->update([
        "name"       => $request->name,
        "email"      => $request->email,
        "phone"      => $request->phone,
        "city"       => $request->city,
        "address"    => $request->address,
        "picture"    => $name,
        "password"   => $request->password,
      ]);

      return response()->json([
        "name" => $name,
      ]);

    }


}
