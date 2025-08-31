<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Client;
use App\Models\Designer;
use App\Models\DownloadInvoice;
use App\Models\Invoice;
use App\Models\Sale;
use Carbon\Carbon;
use Validator;
use DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;



class OrderController extends Controller
{
    //
    // public function view_order(Request $request)
    // {
    //     // $orders = Order::with('designer_order','client_order')
    //     // ->get();
    //     if ($request->ajax()) {
    //         $orders = Order::with(['designer_order', 'client_order'])->select('orders.*');
    //         return DataTables::of($orders)
    //             ->filter(function ($query) use ($request) {
    //                 if ($request->has('search') && !empty($request->search['value'])) {
    //                     $searchTerm = $request->search['value'];
    //                     $query->where(function ($q) use ($searchTerm) {
    //                         $q->where('id', 'LIKE', "%{$searchTerm}%")
    //                         ->orWhere('type', 'LIKE', "%{$searchTerm}%")
    //                         ->orWhere('status', 'LIKE', "%{$searchTerm}%")
    //                         ->orWhere('date', 'LIKE', "%{$searchTerm}%")
    //                         ->orWhere('price', 'LIKE', "%{$searchTerm}%")
    //                         ->orWhere('currency_symbol', 'LIKE', "%{$searchTerm}%")
    //                         ->orWhere('order_name', 'LIKE', "%{$searchTerm}%")
    //                         ->orWhereHas('designer_order', function ($q) use($searchTerm) {
    //                             return $q->where('name', 'LIKE', "%{$searchTerm}%");
    //                         })
    //                         ->orWhereHas('client_order', function ($q) use($searchTerm) {
    //                             return $q->where('name', 'LIKE', "%{$searchTerm}%");
    //                         });
    //                     });
    //                 }
    //             })
    //             ->addColumn('action', function ($order) {
    //                 return '
    //                     <a class="fa fa-edit" href="' . route('admin.edit.order', $order->id) . '"></a>
    //                     <a class="fa fa-trash" href="' . route('admin.delete.order', $order->id) . '"></a>
    //                 ';
    //             })
    //             ->editColumn('status', function ($order) {
    //                 return $order->status == 'Order Completed' ? 'Order Completed' : 'Order Pending';
    //             })
    //             ->editColumn('date', function ($order) {
    //                 return \Carbon\Carbon::parse($order->date)->format('Y-m-d');
    //             })
    //             ->editColumn('price', function ($order) {
    //                 return $order->price . $order->currency_symbol;
    //             })
    //             ->rawColumns(['action', 'status'])
    //             ->make(true);
    //     }

    //     return view('admin.pages.order.table');
    //     // return view('admin.pages.order.table', compact('orders'));
    // }

    public function getLatestInvoice(Request $request)
    {
        $clientId = $request->input('client_id');

        // Ensure client_id is provided
        if (!$clientId) {
            return response()->json(['error' => 'Client ID is required'], 400);
        }

        // Fetch latest invoice number for the given client
        $latestInvoice = DownloadInvoice::where('client_id', $clientId)
            ->orderBy('created_at', 'desc') // Sort by latest created_at
            ->value('invoice_no');

        return response()->json(['latest_invoice' => $latestInvoice ?? 'No Invoice Found']);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        // $clients = Client::with('download_invoices')->where('name', 'LIKE', "%{$query}%")->get();
        $clients = Client::where('name', 'LIKE', "%{$query}%")->get();

        $formattedClients = $clients->map(function ($client) {
            $latestInvoice = DownloadInvoice::where('client_id', $client->id)
                ->latest()
                ->value('invoice_no'); // Sirf invoice_no ki value return karega

            return [
                'id' => $client->id,
                'name' => $client->name,
                'latest_invoice' => $latestInvoice ?? 'No Invoice Found', // Agar invoice nahi hai to default message
            ];
        });
        // dd($formattedClients);

        return response()->json($formattedClients);
    }


    public function view_order(Request $request)
    {
        if ($request->ajax()) {
            $orders = Order::with(['designer_order', 'client_order'])->select('orders.*');

            return DataTables::of($orders)
                ->filter(function ($query) use ($request) {
                    // Global search filter
                    if ($request->has('search') && !empty($request->search['value'])) {
                        $searchTerm = explode(' ', $request->search['value']);
                        foreach ($searchTerm as $term) {

                            $query->where(function ($q) use ($term) {
                                $q->where('id', 'LIKE', "%{$term}%")
                                    ->orWhere('type', 'LIKE', "%{$term}%")
                                    ->orWhere('status', 'LIKE', "%{$term}%")
                                    ->orWhere('date', 'LIKE', "%{$term}%")
                                    ->orWhere('price', 'LIKE', "%{$term}%")
                                    ->orWhere('currency_symbol', 'LIKE', "%{$term}%")
                                    ->orWhere('order_name', 'LIKE', "%{$term}%")
                                    ->orWhereHas('designer_order', function ($q) use ($term) {
                                        $q->where('name', 'LIKE', "%{$term}%");
                                    })
                                    ->orWhereHas('client_order', function ($q) use ($term) {
                                        $q->where('name', 'LIKE', "%{$term}%");
                                    });
                            });
                        }
                    }

                    // Filter by status
                    if ($request->has('status') && !empty($request->status['value'])) {
                        $query->where('status', $request->status['value']);
                    }

                    // Filter by date
                    if ($request->has('date') && !empty($request->date['value'])) {
                        $query->whereDate('date', $request->date['value']);
                    }
                })
                ->addColumn('action', function ($order) {
                    return '
                        <a class="fa fa-edit" href="' . route('admin.edit.order', $order->id) . '"></a>
                        <a class="fa fa-trash delete-btn" href="' . route('admin.delete.order', $order->id) . '"></a>
                    ';
                })
                ->editColumn('status', function ($order) {
                    return $order->status == 'Order Completed' ? 'Order Completed' : 'Order Pending';
                })
                ->editColumn('date', function ($order) {
                    return \Carbon\Carbon::parse($order->date)->format('Y-m-d');
                })
                ->editColumn('price', function ($order) {
                    return $order->price . $order->currency_symbol;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('admin.pages.order.table');
    }



    public function view_order_filter(Request $request)
    {
        $clients = Client::all();
        $orders = Order::with('designer_order', 'client_order')
            ->whereBetween('date', [$request->get('from'), $request->get('till')])
            ->get();
        return view('admin.pages.order.filter', compact('orders', 'clients'));
    }

    public function view_order_filter_process(Request $request)
    {
        $clients = Client::all();
        $orders = Order::with('designer_order', 'client_order')
            ->whereBetween('date', [$request->get('from'), $request->get('till')])
            ->groupBy('client_id')->get();
        $query = DB::table('clients')->distinct()->get(['name']);

        // dd($orders);
        return view('admin.pages.order.filter', compact('orders', 'clients', 'query'));
    }

    public function add_order()
    {
        $clients = Client::all();
        $designers = Designer::all();
        $persons = Sale::with('sale_persons_clients')->get();

        return view('admin.pages.order.add', compact('clients', 'designers', 'persons'));
    }

    public function edit_order($id)
    {
        $clients = Client::all();
        $designers = Designer::all();
        $persons = Sale::with('sale_persons_clients')->get();
        $order = Order::find($id);
        return view('admin.pages.order.edit', compact('order', 'clients', 'designers', 'persons'));
    }

    public function delete_order($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect()->back()->with(['success' => "order Successfully Deleted"]);
    }

    // public function store_order(Request $req)
    // {
    //     $controlls = $req->all();
    //     $rules = array(
    //         "order_name" => "required",
    //         "date" => "required",
    //         "price" => "required",
    //         "cost" => "required",
    //         "client_id" => "required",
    //         "designer_id" => "required",
    //         "currency_symbol" => "required",
    //         "type" => "required"
    //     );

    //     $validator = Validator::make($controlls, $rules);
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput($controlls);
    //     } else {
    //         $client = Client::find($req->client_id);

    //         if (!$client) {
    //             return redirect()->back()->withErrors(['client_id' => 'Invalid client selected'])->withInput($controlls);
    //         }

    //         $clientNameParts = explode(' ', $client->name);
    //         $firstName = isset($clientNameParts[0]) ? Str::upper(substr($clientNameParts[0], 0, 1)) : '';
    //         $lastName = isset($clientNameParts[1]) ? Str::upper(substr($clientNameParts[1], 0, 1)) : '';
    //         $namePrefix = $firstName . $lastName;
    //         $latestOrder = Order::where('client_id', $req->client_id)->latest()->first();
    //         $orderNumber = $latestOrder ? intval(substr($latestOrder->invoice_no, -3)) + 1 : 1;
    //         $invoiceNo = $namePrefix . '-' . str_pad($orderNumber, 3, '0', STR_PAD_LEFT);

    //         $order = new Order;
    //         $order->order_name = $req->order_name;
    //         $order->date = $req->date;
    //         $order->price = $req->price;
    //         $order->cost = $req->cost;
    //         $order->currency_symbol = $req->currency_symbol;
    //         $order->client_id = $req->client_id;
    //         $order->designer_id = $req->designer_id;
    //         $order->saler_id = $req->saler_id;
    //         $order->type = $req->type;
    //         $order->status = $req->status;
    //         $order->save();

    //         $invoice = new Invoice;
    //         $invoice->invoice_no = $invoiceNo;
    //         $invoice->invoice_char = $req->invoice_char;
    //         $invoice->invoice_numb = $req->invoice_numb;
    //         $invoice->date = $order->date;
    //         $invoice->end_date = $order->date;
    //         $invoice->client_id = $req->client_id;
    //         $invoice->price = $order->price;
    //         //$invoice->symbol = $order->currency_symbol;
    //         $invoice->invoice_type = $order->type;
    //         $invoice->status = $order->status;
    //         // $invoice->excluding = $req->exludedDate;
    //         $invoice->save();

    //         return redirect()->route('admin.order')->with(['success' => "Order Successfully Created"]);
    //     }
    // }

    // public function store_order(Request $req)
    // {
    //     $controlls = $req->all();
    //     $rules = array(
    //         "order_name" => "required",
    //         "date" => "required",
    //         "price" => "required",
    //         "cost" => "required",
    //         "client_id" => "required",
    //         "designer_id" => "required",
    //         "currency_symbol" => "required",
    //         "type" => "required"
    //     );

    //     $validator = Validator::make($controlls, $rules);
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput($controlls);
    //     } else {
    //         $client = Client::find($req->client_id);

    //         if (!$client) {
    //             return redirect()->back()->withErrors(['client_id' => 'Invalid client selected'])->withInput($controlls);
    //         }

    //         // Generate Invoice Number based on Client Name
    //         $clientNameParts = explode(' ', $client->name);
    //         $firstName = isset($clientNameParts[0]) ? Str::upper(substr($clientNameParts[0], 0, 1)) : '';
    //         $lastName = isset($clientNameParts[1]) ? Str::upper(substr($clientNameParts[1], 0, 1)) : '';
    //         $namePrefix = $firstName . $lastName;
    //         $latestOrder = Order::where('client_id', $req->client_id)->latest()->first();
    //         $orderNumber = $latestOrder ? intval(substr($latestOrder->invoice_no, -3)) + 1 : 1;
    //         $invoiceNo = $namePrefix . '-' . str_pad($orderNumber, 3, '0', STR_PAD_LEFT);

    //         // Create new order
    //         $order = new Order;
    //         $order->order_name = $req->order_name;
    //         $order->date = $req->date;
    //         $order->price = $req->price;
    //         $order->cost = $req->cost;
    //         $order->currency_symbol = $req->currency_symbol;
    //         $order->client_id = $req->client_id;
    //         $order->designer_id = $req->designer_id;
    //         $order->saler_id = $req->saler_id;
    //         $order->type = $req->type;
    //         $order->status = $req->status;
    //         $order->save();

    //         // Check if an invoice already exists for this client
    //         $existingInvoice = Invoice::where('client_id', $req->client_id)->first();

    //         if ($existingInvoice) {
    //             // Update existing invoice dates
    //             $earliestDate = Order::where('client_id', $req->client_id)->min('date');
    //             $latestDate = Order::where('client_id', $req->client_id)->max('date');

    //             $existingInvoice->date = $earliestDate;
    //             $existingInvoice->end_date = $latestDate;
    //             $existingInvoice->price += $order->price; // Add new order price to invoice
    //             $existingInvoice->save();
    //         } else {
    //             // Create a new invoice
    //             $invoice = new Invoice;
    //             $invoice->invoice_no = $invoiceNo;
    //             $invoice->invoice_char = $namePrefix;
    //             $invoice->invoice_numb = $orderNumber;
    //             $invoice->date = $req->date;
    //             $invoice->end_date = $req->date;
    //             $invoice->client_id = $req->client_id;
    //             $invoice->price = $order->price;
    //             $invoice->invoice_type = $order->type;
    //             $invoice->status = $order->status;
    //             $invoice->save();
    //         }

    //         return redirect()->route('admin.order')->with(['success' => "Order Successfully Created"]);
    //     }
    // }


    public function store_order(Request $req)
    {
        $controlls = $req->all();
        $rules = array(
            "order_name" => "required",
            "date" => "required",
            "price" => "required",
            "cost" => "required",
            "client_id" => "required",
            "designer_id" => "required",
            "currency_symbol" => "required",
            "type" => "required"
        );

        $validator = Validator::make($controlls, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($controlls);
        } else {
            $client = Client::find($req->client_id);

            if (!$client) {
                return redirect()->back()->withErrors(['client_id' => 'Invalid client selected'])->withInput($controlls);
            }

            // Generate Invoice Number based on Client Name
            $clientNameParts = explode(' ', $client->name);
            $firstName = isset($clientNameParts[0]) ? Str::upper(substr($clientNameParts[0], 0, 1)) : '';
            $lastName = isset($clientNameParts[1]) ? Str::upper(substr($clientNameParts[1], 0, 1)) : '';
            $namePrefix = $firstName . '-' . $client->id;

            // Extract year and month from order date
            $orderDate = Carbon::parse($req->date);
            $orderYear = $orderDate->year;
            $orderMonth = $orderDate->month;

            // Check if an invoice already exists for this client and month
            $existingInvoice = DownloadInvoice::where('client_id', $req->client_id)
                ->whereYear('date', $orderYear)
                ->whereMonth('date', $orderMonth)
                ->first();

            // Generate Invoice Number with month and year
            $invoiceSuffix = $orderDate->format('Ym');
            $latestInvoice = DownloadInvoice::where('client_id', $req->client_id)
                // ->where('invoice_char', $namePrefix)
                // ->where('invoice_suffix', $invoiceSuffix)
                ->latest()
                ->first();
            $newInvoiceSuffix = explode('-', $latestInvoice->invoice_no);
            $newInvoiceSuffix = (int) $newInvoiceSuffix[ count($newInvoiceSuffix) - 1 ];
            $latestInvoice->invoice_numb = $newInvoiceSuffix;
            $invoiceNumber = $latestInvoice ? intval($latestInvoice->invoice_numb) + 1 : 1;
            // $invoiceNo = $namePrefix . '-' . $invoiceSuffix . '-' . str_pad($invoiceNumber, 3, '0', STR_PAD_LEFT);
            $invoiceNo = $namePrefix . '-' . str_pad($invoiceNumber, 3, '0', STR_PAD_LEFT);
            $price = Order::where('client_id', $req->client_id)
                // ->whereBetween('date', [$req->start_date, $req->end_date])
                ->sum('price');


            // Create new order
            $order = new Order;
            $order->order_name = $req->order_name;
            $order->date = $req->date;
            $order->price = $req->price;
            $order->cost = $req->cost;
            $order->currency_symbol = $req->currency_symbol;
            $order->client_id = $req->client_id;
            $order->designer_id = $req->designer_id;
            $order->saler_id = $req->saler_id;
            $order->type = $req->type;
            $order->status = $req->status;
            $order->save();

            if ($existingInvoice) {
                // Update existing invoice for the month
                $existingInvoice->end_date = $orderDate;
                // $existingInvoice->price += $order->price;
                $existingInvoice->price = $existingInvoice->price + $order->price;

                // $existingInvoice->price = $price;

                $existingInvoice->invoice_type = $order->type;
                $existingInvoice->save();
            } else {
                // Create a new invoice for the month
                $invoice = new DownloadInvoice;
                $invoice->invoice_no = $req->invoice_no;
                $invoice->invoice_char = $namePrefix;
                // $invoice->invoice_suffix = $invoiceSuffix;
                // $invoice->invoice_numb = $invoiceNumber;
                $invoice->date = $req->date;
                $invoice->end_date = $req->date;
                $invoice->client_id = $req->client_id;
                $invoice->price = $order->price;
                $invoice->invoice_type = $order->type;
                $invoice->status = 'UnPaid';
                $invoice->save();
            }

            return redirect()->route('admin.order')->with(['success' => "Order Successfully Created"]);
        }
    }


    public function update_order(Request $req)
    {
        $controlls = $req->all();
        $rules = array(
            "order_name" => "required",
            "date" => "required",
            "price" => "required",
            "cost" => "required",
            "client_id" => "required",
            "designer_id" => "required",
            "currency_symbol" => "required",
            "type" => "required"

        );

        $validator = Validator::make($controlls, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($controlls);
        } else {
            $order = Order::find($req->id);
            $order->order_name = $req->order_name;
            $order->date = $req->date;
            $order->price = $req->price;
            $order->cost = $req->cost;
            $order->currency_symbol = $req->currency_symbol;
            $order->client_id = $req->client_id;
            $order->designer_id = $req->designer_id;
            $order->saler_id = $req->saler_id;

            $order->status = $req->status;
            $order->type = $req->type;
            $order->save();

            return redirect()->route('admin.order')->with(['success' => "Order Successfully Updated"]);
        }
    }
}
