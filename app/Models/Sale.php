<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    public function sale_persons_clients(){
        return $this->hasMany(Client:: class, 'sale_person_id','id');
    }
}
