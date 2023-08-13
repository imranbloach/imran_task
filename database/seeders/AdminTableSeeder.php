<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Hash;
class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('Test@123');
        $adminRecords = [
            [
                "id"=>2,
                "name"=>"ali",
                "type"=>"subadmin",
                "email"=>"ali@admin.com",
                "mobile"=>"023488983",
                "password"=>$password,
                "image"=>"",
                "status"=>1
            ],
            [
                "id"=>3,
                "name"=>"John",
                "type"=>"subadmin",
                "email"=>"john@admin.com",
                "mobile"=>"8495430580",
                "password"=>$password,
                "image"=>"",
                "status"=>1
            ]
        ];
        Admin::insert($adminRecords);
    }
}
