<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function sale_persons(){
        return $this->belongsTo(Sale:: class, 'sale_person_id','id');
    }

    public function account(){
        return $this->belongsTo(Account:: class, 'account_id','id');
    }

    public function order(){
        return $this->hasMany(Order:: class, 'client_id','id');
    }

    public function invoices(){
        return $this->hasMany(Invoice:: class, 'client_id','id');
    }

    public function download_invoices(){
        return $this->hasMany(DownloadInvoice:: class, 'client_id','id');
    }
}
