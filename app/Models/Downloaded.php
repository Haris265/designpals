<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Downloaded extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_id', 'client_id', 'downloaded_at','start_date','end_date'];


    public function invoice()
    {
        return $this->belongsTo(DownloadInvoice::class);
    }

    public function client(){
        return $this->belongsTo(Client:: class, 'client_id','id');
    }

    public function downloadedOrder(){
        return $this->hasMany(DownloadedOrder:: class, 'downloaded_id','id');
    }

}
