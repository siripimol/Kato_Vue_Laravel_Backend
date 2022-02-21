<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Models\User;


class MemberController extends Controller
{
    public function listMemberTable(Request $request)
    {

        $totalData = DB::table('users')->count();

        $totalFiltered = $totalData;

        $limit = request('page');
        $start = request('itemsPerPage');
        $search = request('search');
        $searchStatus = request('searchStatus');

        $order = 'id';
        $dir = 'asc';

        if (empty($search)) {
            $lists = DB::table('users');

            if (!empty($searchStatus)) {
                $lists = $lists->where('register_channel', $searchStatus);
            }

            $lists = $lists->skip($start)
                ->take($limit)
                ->orderBy('created_at', $dir)
                ->get();
                dd($lists);


            $totalFiltered = $lists->count();

        } else {

            $lists = DB::table('users')
                ->where('fname', 'LIKE', "%{$search}%")
                ->orWhere('lname', 'LIKE', "%{$search}%")
                ->orWhere('phone', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orderBy($order, $dir)
                ->skip($start)
                ->take($limit)
                ->get();

            $totalFiltered = DB::table('users')
                ->where('fname', 'LIKE', "%{$search}%")
                ->orWhere('lname', 'LIKE', "%{$search}%")
                ->orWhere('phone', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->count();
        }

        $data = [];


        foreach ($lists as $key => $value) {
            $data[] = [
                "id" => $value->id,
                "fname" => $value->fname,
                "lname" => $value->lname,
                "phone" => $value->phone,
                "age" => $value->age,
                "email" => $value->email,
                'channel' => $value->register_channel == 1 ? "SMS" : "Website",
                "numberOfRight" => intval($value->total_point),
                "registerDate" => date('Y-m-d h-i-s', strtotime($value->created_at)),
            ];
        }

        echo json_encode([
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        ]);
    }
}
