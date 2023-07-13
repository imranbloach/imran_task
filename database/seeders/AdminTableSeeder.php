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
            "id"=>1,
            "name"=>"Muhammad Imran",
            "type"=>"admin",
            "email"=>"admin@admin.com",
            "mobile"=>"0234888773",
            "password"=>$password,
            "image"=>"",
            "status"=>1
        ];
        Admin::insert($adminRecords);
    }
}
