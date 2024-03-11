<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'status',
        'startDate',
        'endDate',
        'mechanicNotes',
        'clientNotes',
        'mechanic_id',
        'vehicle_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
