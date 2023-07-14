<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CmsPage;
class cmsPageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cmsPageRecords = [
            [
                'id'=>1,
                'title'=>'About Us',
                'description'=>'This is about us page',
                'url'=>'admin/about-us',
                'meta_title'=>'about us',
                'meta_description'=>'this is simple about us page',
                'meta_keywords'=>'about us, about',
                'status'=>1,
            ],
            [
                'id'=>2,
                'title'=>'Contact Us',
                'description'=>'This is contact us page',
                'url'=>'admin/contact-us',
                'meta_title'=>'contact us',
                'meta_description'=>'this is simple contact us page',
                'meta_keywords'=>'contact us, contact',
                'status'=>1,
            ],
            [
                'id'=>3,
                'title'=>'Terms & Conditions',
                'description'=>'This is Terms & Conditions page',
                'url'=>'admin/terms-and-conditions',
                'meta_title'=>'Terms & Conditions',
                'meta_description'=>'this is simple Terms & Conditions page',
                'meta_keywords'=>'Terms & Conditions, Terms, Conditions',
                'status'=>1,
            ],
            [
                'id'=>4,
                'title'=>'Privacy Policy',
                'description'=>'This is Privacy Policy page',
                'url'=>'admin/privacy-policy',
                'meta_title'=>'Privacy Policy',
                'meta_description'=>'this is simple Privacy Policy page',
                'meta_keywords'=>'Privacy Policy, Privacy, Policy',
                'status'=>1,
            ],
        ];

        CmsPage::insert($cmsPageRecords);
    }
}
