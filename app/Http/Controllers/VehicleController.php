<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\Employee;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::with('employee.user')->get();
        $uniqueMakes = Vehicle::select('make')->distinct()->pluck('make');

        return view('vehicles.index', compact('vehicles', 'uniqueMakes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::with('user')->get();

        return view('vehicles.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'registration_number' => 'nullable|string|max:255|unique:vehicles,registration_number',
            'vin' => 'required|string|max:255|unique:vehicles,vin',
            'manufactured_year' => 'required|date',
            'inspection_date' => 'nullable|date',
            'insurance_date' => 'nullable|date',
            'is_active' => 'boolean',
            'employee_id' => 'nullable|exists:employees,id',
            'mileage' => 'nullable|numeric|min:0',
            'fuel_type' => 'nullable|string|max:255',
            'oil_change_date' => 'nullable|date',
        ]);


        return redirect()->route('vehicles.index')->with('success', 'Pojazd został dodany.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        return redirect()->route('vehicles.index')->with('success', 'Pojazd został zaktualizowany.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }

        public function deactivate(Vehicle $vehicle)
    {
        $vehicle->update(['is_active' => false]);
        return redirect()->route('vehicles.index')->with('success', 'Pojazd został dezaktywowany.');
    }

        public function activate(Vehicle $vehicle)
    {
        $vehicle->update(['is_active' => true]);

        return redirect()->route('vehicles.index')->with('success', 'Pojazd został aktywowany.');
    }
}
