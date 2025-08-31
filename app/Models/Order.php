<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function designer_order(){
        return $this->belongsTo(Designer:: class, 'designer_id','id');
    }

    public function client_order(){
        return $this->belongsTo(Client:: class, 'client_id','id');
    }
}
