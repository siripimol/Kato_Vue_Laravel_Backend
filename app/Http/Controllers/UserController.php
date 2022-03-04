<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Code;
use App\Models\User;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function checkPhoneNumer(Request $request)
    {
      $checkPhone =   DB::table('users')
        ->where('phone',request('phone'))
        ->where('register_channel',2)
       ->first();

       if($checkPhone == null){
           return response()->json([
            'status' => "fail",
            'detail' => "เบอร์มือถือนี้ยังไม่ได้ลงทะเบียน"
        ]);
       }
       else {
            $users = User::find($checkPhone->id);
            Auth::login($users);
            return response()->json([
                'status' => "success",
                'phone' => request('phone'),
            ]);
       }
    }

    public function saveRegister(Request $request)
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
           //age
            $date_of_birth = (($request->year) - 543) . '-' . $request->month . '-' . $request->day;
            $user->age = \Carbon\Carbon::parse($date_of_birth)->age;
            $user->register_channel = 2; //microsite
            $user->save();
            Auth::login(User::find($user->id));
            return response()->json([
                'status' => "success",
                'phone' => request('phone'),
            ]);
    }
    public function inputCheck(Request $request)
    {
       $code_check =  DB::table('codes')
        ->where('code',request('input_1'))
        ->first();

       if($code_check != null){
           if($code_check->status == 1){
            DB::table('codes')->where('code', request('input_1'))
            ->update(['status' => 2, 'phone_number'=> request('phone') ,
                        'register_channel'=> 2,'updated_at' => Carbon::now()]);

            $point_user = DB::table('codes')
                        ->where('phone_number',request('phone'))
                        ->where('register_channel',2)
                        ->count();

            DB::table('users')->where('phone', request('phone'))
                ->update(['total_point' =>  $point_user]);

            return response()->json([
                'status' => "success",
                'type' => Code::TYPE[$code_check->type] ? Code::TYPE[$code_check->type] : 'ไม่ระบุ'
            ]);
           }
            else{
                return response()->json([
                    'status' => "fail",
                    'type' => 'ถูกใช้แล้ว'
                ]);
            }
       }
       else{
        return response()->json([
            'status' => "fail",
            'type' => 'รหัสไม่ถูกต้อง'
        ]);
       }
    }
    public function getHistory(Request $request)
    {
        $history =  Code::where('phone_number', request('phone'))->orderBy('updated_at', 'desc')->get();
        if (count($history) >= 1){
            foreach ($history as $value) {
                $data[] = [
                    'type' => Code::TASTE[$value->type] ? Code::TASTE[$value->type] : 'ไม่ระบุ',
                    'day' => date('d-m-Y', \strtotime($value->updated_at)),
                    'time' => date('H:i:s', \strtotime($value->updated_at))
                ];
            }
        }
        else {
            $data = null;
        }
        return response()->json([
            'data_history' => $data,
        ]);
    }

    public function checkType(Request $request)
    {
         $code_check =  DB::table('codes')
        ->where('code',request('input_1'))
        ->first();

        if($code_check != null){
            return response()->json([
                'status' => "success",
                'type' => Code::TYPE[$code_check->type] ? Code::TYPE[$code_check->type] : 'ไม่ระบุ'
            ]);
        }else
        return response()->json([
            'status' => "fail",
            'type' =>  'รหัสไม่ถูกต้อง'
        ]);
    }
}
