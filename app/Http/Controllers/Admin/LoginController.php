<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Sale;
use App\Models\Designer;
use App\Models\Order;
use App\Models\Invoice;
use Validator;
use Auth;
use DB;

class LoginController extends Controller
{
    //
    public function login()
    {
        return view('admin.auth.login');
    }
    
    public function monthly()
    {
        return view('admin.pages.monthly.monthly_sale');
    }
    
    public function monthly_sale(Request $request)
    {
        $orders = Order::whereBetween('date', [$request->get('from'), $request->get('till')])
            ->get();

        $total_us = Order::where('currency_symbol','$')->whereBetween('date', [$request->get('from'), $request->get('till')])->sum('price');

        $total_euro = Order::where('currency_symbol','€')->whereBetween('date', [$request->get('from'), $request->get('till')])->sum('price');

        $total_pound = Order::where('currency_symbol','£')->whereBetween('date', [$request->get('from'), $request->get('till')])->sum('price');

        $sale_amount = Sale::find($request->saler_id);
        
        $order_counts = Order::whereBetween('date', [$request->get('from'), $request->get('till')])
            ->count();

        return view('admin.pages.monthly.monthly_sale', compact('orders','sale_amount','total_us','total_euro','total_pound','order_counts'));
    }

    public function dashboard(Request $request)
    {
        $client_counts = Client::count();
        $sale_counts = Sale::count();
        $designer_counts = Designer::count();
        $order_counts = Order::count();
        $invoice_counts = Invoice::count();

        $chart = Order::select(DB::Raw("SUM(price) as totalPrice,DATE_FORMAT(date,'%M') as month"))
        ->groupBy('month')
        ->whereBetween('date', [$request->get('from'), $request->get('till')])
        ->get();
        // dd($chart);
        // return $chart;

        return view('admin.pages.dashboard',compact('chart','client_counts','sale_counts','designer_counts','order_counts','invoice_counts'));
    }

    public function find_sales(Request $request){
        $client_counts = Client::count();
        $sale_counts = Sale::count();
        $designer_counts = Designer::count();
        $order_counts = Order::count();
        $invoice_counts = Invoice::count();

        $chart = Order::select(DB::Raw("SUM(price) as totalSale, MONTH(`date`) as month, YEAR(`date`) as year"))
        ->groupBy(DB::raw('CONCAT(month, "-", year)'))
        ->whereBetween('date', [$request->get('from'), $request->get('till')])
        ->get();
        
        $us_total = Order::select(DB::Raw("SUM(price) as totalSaleUS, MONTH(`date`) as month, YEAR(`date`) as year"))
        ->groupBy(DB::raw('CONCAT(month, "-", year)'))
        ->where('currency_symbol','$')
        ->whereBetween('date', [$request->get('from'), $request->get('till')])
        ->get();
        
        $euro_total = Order::select(DB::Raw("SUM(price) as totalSaleEuro, MONTH(`date`) as month, YEAR(`date`) as year"))
        ->groupBy(DB::raw('CONCAT(month, "-", year)'))
        ->where('currency_symbol','€')
        ->whereBetween('date', [$request->get('from'), $request->get('till')])
        ->get();
        
        $pound_total = Order::select(DB::Raw("SUM(price) as totalSalePound, MONTH(`date`) as month, YEAR(`date`) as year"))
        ->groupBy(DB::raw('CONCAT(month, "-", year)'))
        ->where('currency_symbol','£')
        ->whereBetween('date', [$request->get('from'), $request->get('till')])
        ->get();
        
        // dd($euro_total);

        // dd($chart->toSql(), $chart->getBindings());
        return view('admin.pages.dashboard',compact('chart','client_counts','sale_counts','designer_counts','order_counts','invoice_counts',
        'us_total','euro_total','pound_total'));

    }

    public function attempt(Request $request)
    {
        $controlls = $request->all();
        $rules = array(
            "email" => "required|exists:admins,email",
            "password" => "required"
        );
        $messages = array(
            "email.exists" => "Email Does Not Exists",
        );
        $validator = Validator::make($controlls, $rules, $messages);
        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput($controlls);
        } else {
            $credientials = ['email' => $request->email, 'password' => $request->password];
            if (!Auth::guard('admin')->attempt($credientials)) {
                return redirect()->route('admin.login')->withErrors(['error' => "Invalid Credientials"]);
            } else {
                return redirect()->route('admin.dashboard');
            }
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
