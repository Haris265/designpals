<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skype;
use Validator;

class SkypeController extends Controller
{
    //
    public function view_skype()
    {
        $skypes = Skype::all();
        return view('admin.pages.skype.table', compact('skypes'));
    }

    public function add_skype()
    {
        return view('admin.pages.skype.add');
    }

    public function edit_skype($id)
    {
        $skype = Skype::find($id);
        return view('admin.pages.skype.edit', compact('skype'));
    }

    public function delete_skype($id)
    {
        $skype = Skype::find($id);
        $skype->delete();
        return redirect()->back()->with(['success' => "Skype Detail Successfully Deleted"]);
    }

    public function store_skype(Request $req)
    {
        $controlls = $req->all();
        $rules = array(
            "name" => "required",
            "email" => "required|email",
            "password" => "required"
        );

        $validator = Validator::make($controlls, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($controlls);
        } else {
            $skype = new Skype;
            $skype->name = $req->name;
            $skype->email = $req->email;
            $skype->password = $req->password;
            $skype->save();

            return redirect()->route('admin.skype')->with(['success' => "Skype Detail Successfully Created"]);
        }
    }

    public function update_skype(Request $req)
    {
        $controlls = $req->all();
        $rules = array(
            "name" => "required",
            "email" => "required|email",
            "password" => "required"
        );

        $validator = Validator::make($controlls, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($controlls);
        } else {
            $skype = Skype::find($req->id);
            $skype->name = $req->name;
            $skype->email = $req->email;
            $skype->password = $req->password;
            $skype->save();

            return redirect()->route('admin.skype')->with(['success' => "Skype Detail Successfully Updated"]);
        }
    }
}
