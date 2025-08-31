<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Sale;
use App\Models\Account;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ClientImport;
use Validator;

class ClientController extends Controller
{
    //
    public function fileImport_client(Request $request)
    {
        try {
            Excel::import(new ClientImport, request()->file('file'));
            return back();
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back();
        }
    }

    public function view_client()
    {
        $clients = Sale::with('sale_persons_clients')->get();
        // dd($clients);
        return view('admin.pages.clients.table', compact('clients'));
    }

    public function add_client()
    {
        $sale_persons = Sale::all();
        $accounts = Account::all();
        return view('admin.pages.clients.add',compact('sale_persons','accounts'));
    }

    public function edit_client($id)
    {
        $sale_persons = Sale::all();
        $accounts = Account::all();
        $client = Client::find($id);
        return view('admin.pages.clients.edit', compact('client','sale_persons','accounts'));
    }

    public function delete_client($id)
    {
        $client = Client::find($id);
        $client->delete();
        return redirect()->back()->with(['success' => "Sale Person Successfully Deleted"]);
    }

    public function store_client(Request $req)
    {
        $controlls = $req->all();
        $rules = array(
            "sale_person" => "required",
            "account" => "required",
            "name" => "required",
            "email" => "required|email",
            "phone_no" => "required",
            "address" => "required",
            "company" => "required",
            "website" => "required",
            "location" => "required"
        );

        $validator = Validator::make($controlls, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($controlls);
        } else {
            $client = new Client;
            $client->sale_person_id = $req->sale_person;
            $client->account_id = $req->account;
            $client->name = $req->name;
            $client->email = $req->email;
            $client->phone_no = $req->phone_no;
            $client->address = $req->address;
            $client->company = $req->company;
            $client->website = $req->website;
            $client->location = $req->location;
            $client->save();

            return redirect()->route('admin.client')->with(['success' => "Client Successfully Created"]);
        }
    }

    public function update_client(Request $req)
    {
        $controlls = $req->all();
        $rules = array(
            //"sale_person_id" => "required",
            "name" => "required",
            "account" => "required",
            "email" => "required|email",
            "phone_no" => "required",
            "address" => "required",
            "company" => "required",
            "website" => "required",
        );

        $validator = Validator::make($controlls, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($controlls);
        } else {
            $client = Client::find($req->id);
            //$client->sale_person_id = $req->sale_person_id;
            $client->sale_person_id = $req->sale_person;

            $client->account_id = $req->account;
            $client->name = $req->name;
            $client->email = $req->email;
            $client->phone_no = $req->phone_no;
            $client->address = $req->address;
            $client->company = $req->company;
            $client->website = $req->website;
            $client->location = $req->location;
            $client->save();

            return redirect()->route('admin.client')->with(['success' => "Client Successfully Updated"]);
        }
    }
}
