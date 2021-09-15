<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonusDetail extends Model
{
    protected $table = 'bonus_details';
    protected $primaryKey = 'bonus_detail_id';

    protected $fillable = [
        'laborer_name',
        
    ];
    public function bonus()
    {
        return $this->belongsTo(Bonus::class);
    }
}
