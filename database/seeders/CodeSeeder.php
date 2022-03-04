<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Code;

class CodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'code' => 1000429445,
                'status' => 1,
                'phone_number' => null,
                'type' => 1,
                'register_channel' => null,
                'created_at' => '2022-01-14 15:20:32',
                'updated_at' => null,
            ],
            [
                'code' => 1000429685,
                'status' => 1,
                'phone_number' => null,
                'type' => 2,
                'register_channel' => null,
                'created_at' => '2022-01-14 15:20:32',
                'updated_at' => null,
            ],
            [
                'code' => 1000430340,
                'status' => 1,
                'phone_number' => null,
                'type' => 3,
                'register_channel' => null,
                'created_at' => '2022-01-14 15:20:32',
                'updated_at' => null,
            ],
            [
                'code' => 1000431358,
                'status' => 1,
                'phone_number' => null,
                'type' => 1,
                'register_channel' => null,
                'created_at' => '2022-01-14 15:20:32',
                'updated_at' => null,
            ],
            [
                'code' => 1000430759,
                'status' => 1,
                'phone_number' => null,
                'type' => 2,
                'register_channel' => null,
                'created_at' => '2022-01-14 15:20:32',
                'updated_at' => null,
            ],
            [
                'code' => 1000431358,
                'status' => 1,
                'phone_number' => null,
                'type' => 3,
                'register_channel' => null,
                'created_at' => '2022-01-14 15:20:32',
                'updated_at' => null,
            ],
        ];

        Code::insert($users);
    }
}
