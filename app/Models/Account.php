<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    public function clients(){
        return $this->hasMany(Client:: class, 'account_id','id');
    }
}
