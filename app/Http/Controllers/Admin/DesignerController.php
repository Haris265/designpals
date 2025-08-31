<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designer;
use App\Models\Order;
use Validator;

class DesignerController extends Controller
{
    //
    public function view_designer_amount(Request $request,$id)
    {
        $designer = Designer::find($id);
        // $orders = Order::where('designer_id',$designer_amount->id)
        // ->whereBetween('date', [$request->get('from'), $request->get('till')])
        // ->get();
        // dd($orders);
        return view('admin.pages.designer.monthly_amount', compact('designer'));
    }

    public function view_designer_amount_process(Request $request)
    {
        $orders = Order::where('designer_id',$request->designer_id)
        ->whereBetween('date', [$request->get('from'), $request->get('till')])
        ->get();

        $total = Order::where('designer_id',$request->designer_id)
        ->whereBetween('date', [$request->get('from'), $request->get('till')])->sum('cost');

        // $total_euro = Order::where('designer_id',$request->designer_id)
        // ->where('currency_symbol','€')
        // ->sum('price');

        // $total_pound = Order::where('designer_id',$request->designer_id)
        // ->where('currency_symbol','pound')
        // ->sum('price');
        // dd($total);
        $designer = Designer::find($request->designer_id);

        return view('admin.pages.designer.monthly_amount', compact('orders','designer','total'));
    }

    public function view_designer()
    {
        $designers = Designer::all();
        // dd($designers);
        return view('admin.pages.designer.table', compact('designers'));
    }

    public function view_designer_orders($id)
    {
        $designer_order = Designer::with('assign_order_to_designer')->find($id);

        $order_pending_count = Order::where('designer_id',$designer_order->id)
        ->where('status','Order Pending')->count();
        $order_completed_count = Order::where('designer_id',$designer_order->id)
        ->where('status','Order Completed')->count();
        //dd($order_completed_count);

        return view('admin.pages.designer.view_own_orders', compact('designer_order','order_pending_count','order_completed_count'));
    }

    public function add_designer()
    {
        return view('admin.pages.designer.add');
    }

    public function edit_designer($id)
    {
        $designer = Designer::find($id);
        return view('admin.pages.designer.edit', compact('designer'));
    }

    public function delete_designer($id)
    {
        $designer = Designer::find($id);
        $designer->delete();
        return redirect()->back()->with(['success' => "Designer Successfully Deleted"]);
    }

    public function store_designer(Request $req)
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
            $designer = new Designer;
            $designer->name = $req->name;
            $designer->email = $req->email;
            $designer->phone_no = $req->phone_no;
            $designer->save();

            return redirect()->route('admin.designer')->with(['success' => "Designer Successfully Created"]);
        }
    }

    public function update_designer(Request $req)
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
            $designer = Designer::find($req->id);
            $designer->name = $req->name;
            $designer->email = $req->email;
            $designer->phone_no = $req->phone_no;
            $designer->save();

            return redirect()->route('admin.designer')->with(['success' => "Designer Successfully Updated"]);
        }
    }
}
