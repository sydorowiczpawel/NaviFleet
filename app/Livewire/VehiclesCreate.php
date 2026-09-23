<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Vehicle;

class VehiclesCreate extends Component
{
    public string $make = '';
    public string $model = '';
    public string $registration_number = '';
    public string $vin = '';
    public ?string $manufactured_year = null;
    public ?string $inspection_date = null;
    public ?string $insurance_date = null;
    public ?string $oil_change_date = null;
    public ?int $mileage = null;
    public ?int $employee_id = null;
    public ?string $fuel_type = null;
    public ?int $is_active = 1;

    public function updatedRegistrationNumber($value) {
        $this->registration_number = strtoupper($value);
    }

    public function updatedVin($value) {
        $this->vin = strtoupper($value);
    }

    public function save() {

        $data = $this->validate([
            
            'make' => 'required|string|max:20',
            'model' => 'required|string|max:40',        
            'registration_number' => 'required|string|max:10',
            'vin' => 'required|string|size:17',
            'manufactured_year' => 'nullable|date',
            'inspection_date' => 'nullable|date',
            'insurance_date' => 'nullable|date',
            'oil_change_date' => 'nullable|date',
            'mileage' => 'nullable|integer|min:0',
            'employee_id' => 'nullable|exists:employees,id',
            'fuel_type' => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
        ],
        [
            'vin.size' => 'VIN musi mieć dokładnie 17 znaków.',
        ]);

        $data['registration_number'] = strtoupper($data['registration_number']);
        $data['vin'] = strtoupper($data['vin']);

        Vehicle::create($data);

        session()->flash('success', 'pojazd dodany');
    }

    public function render()
    {
        $employees = Employee::with('user')->get();

        return view('livewire.vehicles.create', [
            'employees' => $employees,
        ]);
    }
}
