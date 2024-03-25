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



    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function mechanic()
    {
        return $this->belongsTo(User::class);
    }

    public function spareParts()
    {
        return $this->belongsToMany(SparePart::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
