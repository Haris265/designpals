<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Order;
use App\Models\Client;
use Validator;

class SalePersonController extends Controller
{
    //
    public function view_sale_person_amount($id)
    {
        $sale_amount = Sale::with('sale_persons_clients')->find($id);
        // dd($sale_amount);
        return view('admin.pages.sale_persons.sale_person_amount', compact('sale_amount'));
    }

    public function view_sale_person_amount_process(Request $request)
    {
        $orders = Order::where('saler_id',$request->saler_id)
        ->whereBetween('date', [$request->get('from'), $request->get('till')])
        ->get();

        $total_us = Order::where('saler_id',$request->saler_id)
        ->where('currency_symbol','$')->whereBetween('date', [$request->get('from'), $request->get('till')])->sum('price');

        $total_euro = Order::where('saler_id',$request->saler_id)
        ->where('currency_symbol','€')->whereBetween('date', [$request->get('from'), $request->get('till')])->sum('price');

        $total_pound = Order::where('saler_id',$request->saler_id)
        ->where('currency_symbol','£')->whereBetween('date', [$request->get('from'), $request->get('till')])->sum('price');

        $sale_amount = Sale::find($request->saler_id);

        return view('admin.pages.sale_persons.sale_person_amount', compact('orders','sale_amount','total_us','total_euro','total_pound'));
    }

    public function view_sale_person()
    {
        $sale_persons = Sale::all();
        // dd($sale_persons);
        return view('admin.pages.sale_persons.table', compact('sale_persons'));
    }

    public function add_sale_person()
    {
        return view('admin.pages.sale_persons.add');
    }

    public function edit_sale_person($id)
    {
        $sale_person = Sale::find($id);
        return view('admin.pages.sale_persons.edit', compact('sale_person'));
    }

    public function delete_sale_person($id)
    {
        $sale = Sale::find($id);
        $sale->delete();
        // return response()->json(['success' => 'Record has been deleted']);
        return redirect()->back()->with(['success' => "Sale Person Successfully Deleted"]);

    }

    public function store_sale_person(Request $req)
    {
        $controlls = $req->all();
        // dd($controlls);
        $rules = array(
            "name" => "required",
            "email" => "required|email",
            "phone_no" => "required"
        );

        $validator = Validator::make($controlls, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($controlls);
        } else {
            $sale = new Sale;
            $sale->name = $req->name;
            $sale->email = $req->email;
            $sale->phone_no = $req->phone_no;
            $sale->save();

            return redirect()->route('admin.sale')->with(['success' => "Sale Person Successfully Created"]);
        }
    }

    public function update_sale_person(Request $req)
    {
        $controlls = $req->all();
        $rules = array(
            "name" => "required",
            "email" => "required|email",
            "phone_no" => "required"
        );

        $validator = Validator::make($controlls, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($controlls);
        } else {
            $sale = Sale::find($req->id);
            $sale->name = $req->name;
            $sale->email = $req->email;
            $sale->phone_no = $req->phone_no;
            $sale->save();

            return redirect()->route('admin.sale')->with(['success' => "Sale Person Successfully Updated"]);
        }
    }
}
