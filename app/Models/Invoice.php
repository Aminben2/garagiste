<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'repair_id',
        'additionalCharges',
        'totalAmount',
    ];

    public function client()
    {
        return $this->belongsTo(User::class);
    }

    public function repair()
    {
        return $this->belongsTo(Repair::class);
    }
}
