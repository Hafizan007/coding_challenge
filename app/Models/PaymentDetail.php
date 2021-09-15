<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;
    protected $fillable = ["laborer_name"];

    public function payments(){
        return $this->belongsTo(Payment::class);
    }
}
