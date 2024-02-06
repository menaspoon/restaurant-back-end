<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use DateTime;
use Illuminate\Http\Request;

class ContactController extends Controller {


    public function index(Request $request) {
      // Get Data
      $data = Contact::get();
      // Return Data
      return response()->json($data);
    }


    public function store(Request $request) {
         Contact::insert([
          "name"      => $request->name,
          "email"     => $request->email,
          "phone"     => $request->phone,
          "message"   => $request->message,
          'time'     => date("F j, Y, g:i a"),
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
