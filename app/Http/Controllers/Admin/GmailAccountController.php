<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Client;
use Validator;


class GmailAccountController extends Controller
{
    //
    public function view_account()
    {
        $accounts = Account::with('clients')->get();
        // dd($accounts);
        return view('admin.pages.gmail.table', compact('accounts'));
    }

    public function view_account_location($id)
    {
        $account = Account::with('clients')->find($id);
        // dd($account);
        return view('admin.pages.gmail.account_location', compact('account'));
    }

    public function view_client_us(Request $request,$id)
    {
        $account = Client::
        where('account_id',$request->id)
        ->where('location','us')->get();
        // dd($account);
        $account_id = Account::with('clients')->find($id);

        return view('admin.pages.gmail.us_clients', compact('account','account_id'));
    }

    public function view_client_uk(Request $request,$id)
    {
        $account = Client::
        where('account_id',$request->id)
        ->where('location','uk')->get();
        // dd($account);
        $account_id = Account::with('clients')->find($id);

        return view('admin.pages.gmail.uk_clients', compact('account','account_id'));
    }

    public function add_account()
    {
        return view('admin.pages.gmail.add');
    }

    public function edit_account($id)
    {
        $account = Account::find($id);
        return view('admin.pages.gmail.edit', compact('account'));
    }

    public function delete_account($id)
    {
        $account = Account::find($id);
        $account->delete();
        return redirect()->back()->with(['success' => "Account Successfully Deleted"]);
    }

    public function store_account(Request $req)
    {
        $controlls = $req->all();
        $rules = array(
            "account_email" => "required|email|unique:accounts,account_email"
        );

        $validator = Validator::make($controlls, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($controlls);
        } else {
            $account = new Account;
            $account->account_email = $req->account_email;
            $account->us = 'US';
            $account->uk = 'UK';
            $account->save();

            return redirect()->route('admin.account')->with(['success' => "Account Successfully Created"]);
        }
    }

    public function update_account(Request $req)
    {
        $controlls = $req->all();
        $rules = array(
            "account_email" => "required|email"
        );

        $validator = Validator::make($controlls, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($controlls);
        } else {
            $account = Account::find($req->id);
            $account->account_email = $req->account_email;
            $account->save();

            return redirect()->route('admin.account')->with(['success' => "Account Successfully Updated"]);
        }
    }
}
