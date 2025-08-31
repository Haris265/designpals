<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadedOrder extends Model
{
    use HasFactory;

    protected $fillable = ['downloaded_id', 'order_id'];

    public function order(){
        return $this->belongsTo(Order:: class, 'order_id','id');
    }
}
