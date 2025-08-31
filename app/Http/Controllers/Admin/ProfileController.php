<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use Validator;
use Hash;

class ProfileController extends Controller
{
    //
    public function profile(){
        return view('admin.auth.profile');
    }

    public function updateAdminProfile(Request $req)
    {
        $controlls=$req->all();
        $rules=array(
            "name"=>"required",
            "email"=>"required",
            "image"=>"nullable|image"
        );

        $validator=Validator::make($controlls,$rules);
        if ($validator->fails()) {
            // dd($validator);
            return redirect()->back()->withErrors($validator)->withInput($controlls);
        }
        else{
        $updateadmin=Admin::find(Auth::guard('admin')->user()->id);
        $updateadmin->name = $req->input('name');
        $updateadmin->email =$req->input('email');

        if ($req->hasFile('image')) {
            $file=$req->file('image');
            $filename=$file->getClientOriginalName();
            $path=public_path("/uploads/admins/profile/");
            $file->move($path,$filename);
            $updateadmin->image =$filename;
            }
        $updateadmin->save();

        return redirect()->back()->withSuccess('Admin Profile Successfully Updated');
        }
    }
    
    public function change_password()
    {
        return view('admin.auth.change_password');
    }

    public function changepassword_process(Request $request)
    {
        $controlls = $request->all();
        $rules = array(
            "new_password" => "required|min:8",
            "confirm_password" => "required|same:new_password",
            "current_password" => "required"
        );
        //dd($controlls);
        $validator = Validator::make($controlls, $rules);
        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput($controlls);
        } else {
            $current_password = Auth::guard('admin')->user()->password;
            if (Hash::check($request->current_password, $current_password)) {
                $user_id = Auth::guard('admin')->user()->id;
                $obj_user = Admin::find($user_id);
                $obj_user->password = bcrypt($request->new_password);
                $obj_user->save();
            } else {
                return redirect()->back()->withErrors(["current_password" => 'Current Password Not Matched...!']);
            }

            return redirect()->back()->withSuccess('Password Successfully Updated');
        }
    }
}
