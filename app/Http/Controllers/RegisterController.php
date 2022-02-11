<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\User;

class RegisterController extends Controller
{
    //
    public function register(Request $request)
    {
        $user = new User();
        $user->fname = request('fname');
        $user->lname = request('lname');
        $user->phone = request('phone');
        $user->email = request('email');
        // $user->gender = request('gender');
        // $user->dbirth = request('day');
        // $user->mbirth = request('month');
        // $user->ybirth = request('year');
        // $date_of_birth = (($request->year) - 543) . '-' . $request->month . '-' . $request->day;
        // $user->age = \Carbon\Carbon::parse($date_of_birth)->age;
        $user->register_channel = 2; //microsite
        $user->save();
        // Auth::login(User::find($user->id));
        return response()->json([
            'success' => "success",
        ]);

    }
}
