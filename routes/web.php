<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('admin.auth.login');
});

//Admin Routes
Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::group(['middleware' => 'AdminGuest'], function () {
        //login Routes
        Route::get('login', ['as' => 'admin.login', 'uses' => '\App\Http\Controllers\Admin\LoginController@login']);
        Route::post('login/process', ['as' => 'admin.login.process', 'uses' => '\App\Http\Controllers\Admin\LoginController@attempt']);
    });

    Route::group(['middleware' => "AdminAuth"], function () {
        //Profile Routes
        Route::get('profile', ['as' => 'admin.profile', 'uses' => '\App\Http\Controllers\Admin\ProfileController@profile']);
        Route::post('profile/update', ['as' => 'admin.profile.update', 'uses' => '\App\Http\Controllers\Admin\ProfileController@updateAdminProfile']);
        Route::get('change/password', ['as' => 'admin.change.password', 'uses' => '\App\Http\Controllers\Admin\ProfileController@change_password']);
        Route::post('change/password/process', ['as' => 'admin.change.password.process', 'uses' => '\App\Http\Controllers\Admin\ProfileController@changepassword_process']);
        //Dashboard Route
        Route::get('dashboard', ['as' => 'admin.dashboard', 'uses' => '\App\Http\Controllers\Admin\LoginController@dashboard']);
        //Logout Route
        Route::get('logout', ['as' => 'admin.logout', 'uses' => '\App\Http\Controllers\Admin\LoginController@logout']);
        //Sale Person Routes
        Route::get('sale', ['as' => 'admin.sale', 'uses' => '\App\Http\Controllers\Admin\SalePersonController@view_sale_person']);
        Route::get('add/sale', ['as' => 'admin.add.sale', 'uses' => '\App\Http\Controllers\Admin\SalePersonController@add_sale_person']);
        Route::post('store/sale', ['as' => 'admin.store.sale', 'uses' => '\App\Http\Controllers\Admin\SalePersonController@store_sale_person']);
        Route::get('edit/sale/{id}', ['as' => 'admin.edit.sale', 'uses' => '\App\Http\Controllers\Admin\SalePersonController@edit_sale_person']);
        Route::get('delete/sale/{id}', ['as' => 'admin.delete.sale', 'uses' => '\App\Http\Controllers\Admin\SalePersonController@delete_sale_person']);
        Route::post('update/sale', ['as' => 'admin.update.sale', 'uses' => '\App\Http\Controllers\Admin\SalePersonController@update_sale_person']);
        Route::get('sale/amount/{id}', ['as' => 'admin.sale.amount', 'uses' => '\App\Http\Controllers\Admin\SalePersonController@view_sale_person_amount']);
        Route::post('sale/amount/process', ['as' => 'admin.sale.amount.process', 'uses' => '\App\Http\Controllers\Admin\SalePersonController@view_sale_person_amount_process']);
        
        Route::get('monthly', ['as' => 'admin.monthly', 'uses' => '\App\Http\Controllers\Admin\LoginController@monthly']);
        
        Route::post('monthly/sale/process', ['as' => 'admin.monthly.sale.process', 'uses' => '\App\Http\Controllers\Admin\LoginController@monthly_sale']);


        //Client Routes
         Route::get('client', ['as' => 'admin.client', 'uses' => '\App\Http\Controllers\Admin\ClientController@view_client']);
         Route::get('add/client', ['as' => 'admin.add.client', 'uses' => '\App\Http\Controllers\Admin\ClientController@add_client']);
         Route::post('store/client', ['as' => 'admin.store.client', 'uses' => '\App\Http\Controllers\Admin\ClientController@store_client']);
         Route::get('edit/client/{id}', ['as' => 'admin.edit.client', 'uses' => '\App\Http\Controllers\Admin\ClientController@edit_client']);
         Route::get('delete/client/{id}', ['as' => 'admin.delete.client', 'uses' => '\App\Http\Controllers\Admin\ClientController@delete_client']);
         Route::post('update/client', ['as' => 'admin.update.client', 'uses' => '\App\Http\Controllers\Admin\ClientController@update_client']);
         Route::post('client/import', ['as' => 'admin.client.import', 'uses' => '\App\Http\Controllers\Admin\ClientController@fileImport_client']);

        //Designer Routes
         Route::get('designer', ['as' => 'admin.designer', 'uses' => '\App\Http\Controllers\Admin\DesignerController@view_designer']);
         Route::get('add/designer', ['as' => 'admin.add.designer', 'uses' => '\App\Http\Controllers\Admin\DesignerController@add_designer']);
         Route::post('store/designer', ['as' => 'admin.store.designer', 'uses' => '\App\Http\Controllers\Admin\DesignerController@store_designer']);
         Route::get('edit/designer/{id}', ['as' => 'admin.edit.designer', 'uses' => '\App\Http\Controllers\Admin\DesignerController@edit_designer']);
         Route::get('delete/designer/{id}', ['as' => 'admin.delete.designer', 'uses' => '\App\Http\Controllers\Admin\DesignerController@delete_designer']);
         Route::post('update/designer', ['as' => 'admin.update.designer', 'uses' => '\App\Http\Controllers\Admin\DesignerController@update_designer']);
         Route::get('designer/orders/{id}', ['as' => 'admin.designer.orders', 'uses' => '\App\Http\Controllers\Admin\DesignerController@view_designer_orders']);
         Route::get('designer/amount/{id}', ['as' => 'admin.designer.amount', 'uses' => '\App\Http\Controllers\Admin\DesignerController@view_designer_amount']);
         Route::post('designer/amount/process', ['as' => 'admin.designer.amount.process', 'uses' => '\App\Http\Controllers\Admin\DesignerController@view_designer_amount_process']);


         //Skype Routes
         Route::get('skype', ['as' => 'admin.skype', 'uses' => '\App\Http\Controllers\Admin\SkypeController@view_skype']);
         Route::get('add/skype', ['as' => 'admin.add.skype', 'uses' => '\App\Http\Controllers\Admin\SkypeController@add_skype']);
         Route::post('store/skype', ['as' => 'admin.store.skype', 'uses' => '\App\Http\Controllers\Admin\SkypeController@store_skype']);
         Route::get('edit/skype/{id}', ['as' => 'admin.edit.skype', 'uses' => '\App\Http\Controllers\Admin\SkypeController@edit_skype']);
         Route::get('delete/skype/{id}', ['as' => 'admin.delete.skype', 'uses' => '\App\Http\Controllers\Admin\SkypeController@delete_skype']);
         Route::post('update/skype', ['as' => 'admin.update.skype', 'uses' => '\App\Http\Controllers\Admin\SkypeController@update_skype']);

         //Order Routes
         Route::get('order', ['as' => 'admin.order', 'uses' => '\App\Http\Controllers\Admin\OrderController@view_order']);
         Route::get('add/order', ['as' => 'admin.add.order', 'uses' => '\App\Http\Controllers\Admin\OrderController@add_order']);
         Route::post('store/order', ['as' => 'admin.store.order', 'uses' => '\App\Http\Controllers\Admin\OrderController@store_order']);
         Route::get('edit/order/{id}', ['as' => 'admin.edit.order', 'uses' => '\App\Http\Controllers\Admin\OrderController@edit_order']);
         Route::get('delete/order/{id}', ['as' => 'admin.delete.order', 'uses' => '\App\Http\Controllers\Admin\OrderController@delete_order']);
         Route::post('update/order', ['as' => 'admin.update.order', 'uses' => '\App\Http\Controllers\Admin\OrderController@update_order']);
         Route::get('order/filter', ['as' => 'admin.order.filter', 'uses' => '\App\Http\Controllers\Admin\OrderController@view_order_filter']);
         Route::post('order/filter/process', ['as' => 'admin.order.filter.process', 'uses' => '\App\Http\Controllers\Admin\OrderController@view_order_filter_process']);
         Route::get('clients/search', ['as' => 'admin.clients.search', 'uses' => '\App\Http\Controllers\Admin\OrderController@search']);
         Route::get('clients/invoice_no', ['as' => 'admin.clients.invoice_no', 'uses' => '\App\Http\Controllers\Admin\OrderController@getLatestInvoice']);




         //Invoice Routes
         Route::get('invoice', ['as' => 'admin.invoice', 'uses' => '\App\Http\Controllers\Admin\InvoiceController@view_invoice']);
         Route::get('print/invoice/{id}', ['as' => 'admin.print.invoice', 'uses' => '\App\Http\Controllers\Admin\InvoiceController@generate_invoice']);
         Route::get('invoice/number/{id}', ['as' => 'admin.invoice.number', 'uses' => '\App\Http\Controllers\Admin\InvoiceController@invoice_number']);
         Route::get('invoice/generate/{id}', ['as' => 'admin.invoice.generate', 'uses' => '\App\Http\Controllers\Admin\InvoiceController@find_all_orders']);
         Route::get('all/invoice/generate/{id}', ['as' => 'admin.all.invoice.generate', 'uses' => '\App\Http\Controllers\Admin\InvoiceController@find_all_orders_invoice']);

         Route::post('all/invoices', ['as' => 'admin.all.invoices', 'uses' => '\App\Http\Controllers\Admin\InvoiceController@find_all_invoices']);
         Route::get('invoice/no/{id}', ['as' => 'admin.invoice.no', 'uses' => '\App\Http\Controllers\Admin\InvoiceController@add_invoice_no']);
         Route::post('store/invoice/no', ['as' => 'admin.store.invoice.no', 'uses' => '\App\Http\Controllers\Admin\InvoiceController@store_invoice_no']);
         Route::post('find/sale', ['as' => 'admin.find.sale', 'uses' => '\App\Http\Controllers\Admin\LoginController@find_sales']);
         Route::get('add/invoice', ['as' => 'admin.add.invoice', 'uses' => '\App\Http\Controllers\Admin\InvoiceController@add_invoice']);
         Route::post('store/invoice', ['as' => 'admin.store.invoice', 'uses' => '\App\Http\Controllers\Admin\InvoiceController@store_invoice']);
         Route::get('edit/invoice/{id}', ['as' => 'admin.edit.invoice', 'uses' => '\App\Http\Controllers\Admin\InvoiceController@edit_invoice']);
         Route::get('delete/invoice/{id}', ['as' => 'admin.delete.invoice', 'uses' => '\App\Http\Controllers\Admin\InvoiceController@delete_invoice']);
         Route::post('update/invoice', ['as' => 'admin.update.invoice', 'uses' => '\App\Http\Controllers\Admin\InvoiceController@update_invoice']);
         Route::post('client/all/invoices', ['as' => 'admin.client.all.invoices', 'uses' => '\App\Http\Controllers\Admin\InvoiceController@client_all_invoices_view']);
         
         Route::get('paid/invoice', ['as' => 'admin.paid.invoice', 'uses' => '\App\Http\Controllers\Admin\InvoiceController@paid_view_invoice']);
         Route::get('download/invoice', ['as' => 'admin.download.invoice', 'uses' => '\App\Http\Controllers\Admin\InvoiceController@download_invoice']);
         Route::post('download/invoice/process', ['as' => 'admin.download.invoice.process', 'uses' => '\App\Http\Controllers\Admin\InvoiceController@download_invoice_process']);
         Route::post('exclude/process', ['as' => 'admin.exclude.process', 'uses' => '\App\Http\Controllers\Admin\InvoiceController@download_exclude_invoice_process']);
         Route::get('edit/download/invoice/{id}', ['as' => 'admin.edit.download.invoice', 'uses' => '\App\Http\Controllers\Admin\InvoiceController@edit_download_invoice']);
         Route::post('update/download/invoice', ['as' => 'admin.update.download.invoice', 'uses' => '\App\Http\Controllers\Admin\InvoiceController@update_download_invoice']);
         Route::get('downloaded/invoice', ['as' => 'admin.downloaded.invoice', 'uses' => '\App\Http\Controllers\Admin\InvoiceController@downloaded_view_invoice']);
         Route::get('all/downloaded/invoice/generate/{id}', ['as' => 'admin.all.downloaded.invoice.generate', 'uses' => '\App\Http\Controllers\Admin\InvoiceController@find_all_downloaded_orders_invoice']);
         Route::post('all_pdfs_invoices_download', ['as' => 'admin.all_pdfs_invoices_download', 'uses' => '\App\Http\Controllers\Admin\InvoiceController@all_pdfs_invoices_download']);


         
         //Account Routes
         Route::get('account', ['as' => 'admin.account', 'uses' => '\App\Http\Controllers\Admin\GmailAccountController@view_account']);
         Route::get('add/account', ['as' => 'admin.add.account', 'uses' => '\App\Http\Controllers\Admin\GmailAccountController@add_account']);
         Route::post('store/account', ['as' => 'admin.store.account', 'uses' => '\App\Http\Controllers\Admin\GmailAccountController@store_account']);
         Route::get('edit/account/{id}', ['as' => 'admin.edit.account', 'uses' => '\App\Http\Controllers\Admin\GmailAccountController@edit_account']);
         Route::get('delete/account/{id}', ['as' => 'admin.delete.account', 'uses' => '\App\Http\Controllers\Admin\GmailAccountController@delete_account']);
         Route::post('update/account', ['as' => 'admin.update.account', 'uses' => '\App\Http\Controllers\Admin\GmailAccountController@update_account']);
         Route::get('account/location/{id}', ['as' => 'admin.account.location', 'uses' => '\App\Http\Controllers\Admin\GmailAccountController@view_account_location']);
         Route::get('location/us/{id}', ['as' => 'admin.location.us', 'uses' => '\App\Http\Controllers\Admin\GmailAccountController@view_client_us']);
         Route::get('location/uk/{id}', ['as' => 'admin.location.uk', 'uses' => '\App\Http\Controllers\Admin\GmailAccountController@view_client_uk']);




        });
});
