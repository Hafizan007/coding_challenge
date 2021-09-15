<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ["payment_total"];

    public function payment_detail(){
        return $this->hasMany(PaymentDetail::class);
        
    }
}
