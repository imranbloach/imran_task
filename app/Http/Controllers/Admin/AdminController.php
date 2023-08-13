<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use Hash;
use Session;
use Image;
use File;
class AdminController extends Controller
{
    public function dashboard(){
        Session::put('page', 'dashboard');
        return view('admin.dashboard');
    }

    public function login(Request $request){
        if($request->isMethod('post')){
            $rules = [
                'email'=>'required|email',
                'password'=>'required|max:30'
            ];
            $customMessages = [
                'email.required'=>"Email is required",
                'email.email'=>"Please enter valid email",
                'password.required'=>"Password can't be empty"

            ];
            $this->validate($request, $rules, $customMessages);
            if(Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=>$request->password])){
                if(!empty($request->remember_me)){
                    setcookie('email', $request->email, time()+4500);
                    setcookie('password', $request->password, time()+4500);
                }else {
                    setcookie('email', "");
                    setcookie('password', "");
                }
                return redirect('admin/dashboard');
            }else {
                return redirect()->back()->with("error_message", "Invalid email or Password");
            }
        }
        return view('admin.login');
    }
    public function changePassword(Request $request){
        Session::put('page', 'change-password');
        $data = $request->all();
        if($request->isMethod('post')){
            if(Hash::check($request->current_pwd, Auth::guard('admin')->user()->password)){

                if($request->new_pwd !==  $request->confirm_pwd){
                    return redirect()->back()->with("error_message", "Password does'nt match");
                }else{
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($request->new_pwd)]);
                    return redirect()->back()->with("success_message", "Password updated");
                }
            }else{
                return redirect()->back()->with("error_message", "Invalid current password");
            }
        }
        return view('admin.change_password');
    }
    public function checkPassword(Request $request){
        if(Hash::check($request->current_pwd, Auth::guard('admin')->user()->password)){
            return "true";
        }else{
            return "false";
        }
    }
    public function updateDetail(Request $request){
        Session::put('page', 'update-detail');
        if($request->isMethod('post')){
            $rules = [
                'admin_name'=>'required|max:50',
                'admin_mobile'=>'required|numeric',
                'admin_image'=>'image',
            ];
            $customMessages = [
                'admin_name.required'=>"Name field is required",
                'admin_name.max'=>'Your name should have maximum 50 characters',
                'admin_mobile.required'=>'Mobile field is required',
                'admin_mobile.numeric'=>'Your mobile must be in numeric',
                'admin_image.image'=>'Valid image is required'
            ];

            $this->validate($request, $rules, $customMessages);
            if($request->hasFile('admin_image')){
                $image_tmp = $request->file('admin_image');
                if($image_tmp->isValid()){
                    $image_ext = $image_tmp->getClientOriginalExtension();
                    $imageNewName = rand(111, 9999).".".$image_ext;
                    $imagePath = 'admin/img/photos/'.$imageNewName;
                    if(!File::exists('admin/img/photos')){
                        File::makeDirectory('admin/img/photos', 0777, true);
                    }
                    Image::make($image_tmp)->save($imagePath);
                }
            }else if(!empty($request->current_img)){
                $imageNewName = $request->current_img;
            }else {
                $imageNewName = '';
            }
            Admin::where('email', Auth::guard('admin')->user()->email)->update(['name'=>$request->admin_name, 'mobile'=>$request->admin_mobile, 'image'=>$imageNewName]);
            return redirect()->back()->with('success_message', 'Your detail is udated');
        }
        return view('admin/update-detail');
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }

    public function subAdmins(){
        Session::put('page', 'subadmins');
        $subAdmins = Admin::where('type', 'subadmin')->get();

        return view('admin.subadmins.index')->with(compact('subAdmins'));
    }

    public function addEditSubAdmin(Request $request, $id = null){
        if($id == ''){
            $title = "Add Sub Admin";
            $subAdmin = new Admin;
            $message = "Sub Admin addedd successfully";
        }else {
            $title = "Edit Sub Admin";
            $subAdmin = Admin::find($id);
            $message = "Sub Admin updated successfully";
        }
        if($request->isMethod('post')){
            $rules = [
                'name'=>'required',
                'mobile'=>'required',
                'email'=>'required|email'
            ];
            $customMessages = [
                'name.required'=>'Sub Admin name is required.',
                'mobile.required'=>'Mobile number is required.',
                'email.required'=>'Email is required.',
                'email.email'=>'Valid email is required.',
            ];

            $this->validate($request, $rules, $customMessages);

            $subAdmin->name = $request->name;
            $subAdmin->mobile = $request->mobile;
            $subAdmin->email = $request->email;
            $subAdmin->type = $request->meta_title;
            $subAdmin->meta_description = $request->meta_description;
            $subAdmin->meta_keywords = $request->meta_keywords;
            $subAdmin->status = 1;
            $subAdmin->save();
        }
    }

    public function updateSubAdminStatus(Request $request, Admin $subAdmin){
        if($request->ajax()){
            $status = ($request->status == 'active')? 0:1;
            Admin::where('id', $request->sub_admin_id)->update(['status'=>$status]);

            return response()->json(
                [
                    'status'=>$status,
                    'sub_admin_id'=>$request->sub_admin_id
                ]
            );
        }
    }
}
