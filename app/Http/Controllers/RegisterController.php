<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user->gender = request('gender');
        $user->dbirth = request('day');
        $user->mbirth = request('month');
        $user->ybirth = request('year');
        $date_of_birth = (($request->year) - 543) . '-' . $request->month . '-' . $request->day;
        $user->age = \Carbon\Carbon::parse($date_of_birth)->age;
        $user->register_channel = 2; //microsite
        $user->save();
        Auth::login(User::find($user->id));
        return response()->json([
            'success' => "success",
        ]);

    }

    public function checkPhoneNumber(Request $request)
    {
        $checkPhone = DB::table('users')
            ->where('phone', request('phone'))
            ->where('register_channel', 2)
            ->first();

        if ($checkPhone == null) {
            return response()->json([
                'status' => "fail",
                'detail' => "เบอร์มือถือนี้ยังไม่ได้ลงทะเบียน",
            ]);
        } else {
            $users = User::find($checkPhone->id);
            Auth::login($users);
            return response()->json([
                'status' => "success",
            ]);
        }
    }

    public function inputCheck(Request $request)
    {
        $code_check = DB::table('codes')
            ->where('code', request('input_1'))
            ->first();


        if ($code_check != null) {
            if ($code_check->status == 1) {
                DB::table('codes')->where('code', request('input_1'))
                    ->update(['status' => 2, 'phone_number' => Auth::user()->phone,
                        'register_channel' => 2, 'updated_at' => Carbon::now()]);

                $point_user = DB::table('codes')
                    ->where('phone_number', Auth::user()->phone)
                    ->where('register_channel', 2)
                    ->count();

                DB::table('users')->where('phone', Auth::user()->phone)
                    ->update(['total_point' => $point_user]);

                return response()->json([
                    'status' => "success",
                    'type' => Code::TYPE[$code_check->type] ? Code::TYPE[$code_check->type] : 'ไม่ระบุ',
                ]);
            } else {
                return response()->json([
                    'status' => "fail",
                    'type' => 'ถูกใช้แล้ว',
                ]);
            }
        } else {
            return response()->json([
                'status' => "fail",
                'type' => 'รหัสไม่ถูกต้อง',
            ]);
        }
    }
}
