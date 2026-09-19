<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
    'make',
    'model',
    'registration_number',
    'vin',
    'manufactured_year'=> 'date',
    'inspection_date'=> 'date',
    'insurance_date'=> 'date',
    'is_active',
    'employee_id',
    'mileage',
    'fuel_type',
    'oil_change_date'=> 'date',
];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
