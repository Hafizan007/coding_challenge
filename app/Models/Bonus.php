<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    protected $table = 'bonus';
    protected $primaryKey = 'bonus_id';

    protected $fillable = [
        'total_pembayaran',
        
    ];
    public function bonusdetail()
    {
        return $this->hasMany(BonusDetail::class);
    }
}
