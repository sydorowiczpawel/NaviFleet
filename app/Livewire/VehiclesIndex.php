<?php 

namespace App\Livewire;

use Livewire\Component;
use App\Models\Vehicle;

class VehiclesIndex extends Component
{
    public string $search = '';
    public string $filterMake = '';
    public string $filterFuel = ''; 
    public string $filterStatus = '';
    public string $sortColumn = 'make';
    public string $sortDirection = 'asc';

    public function render()
{
    $query = Vehicle::query();

    // wyszukiwanie
    if ($this->search !== '') {
        $query->where(function ($q) {
            $q->where('make', 'like', "%{$this->search}%")
              ->orWhere('model', 'like', "%{$this->search}%")
              ->orWhere('vin', 'like', "%{$this->search}%")
              ->orWhere('registration_number', 'like', "%{$this->search}%");
        });
    }

    // filtry
    if ($this->filterMake !== '') {
        $query->where('make', $this->filterMake);
    }

    if ($this->filterFuel !== '') {
        $query->where('fuel_type', $this->filterFuel);
    }

    if ($this->filterStatus !== '') {
        $query->where('is_active', $this->filterStatus === 'active');
    }

    // sortowanie
    $query->orderBy($this->sortColumn, $this->sortDirection);

    // pobranie pojazdów
    $vehicles = $query->get();

    // 🔥 TU DODAJEMY uniqueMakes
    $uniqueMakes = Vehicle::select('make')->distinct()->pluck('make');

    return view('livewire.vehicles.index', [
        'vehicles' => $vehicles,
        'uniqueMakes' => $uniqueMakes,
    ]);
}

    public function sortBy($column)
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function addRandomVehicle()
{
    $manufacturedYear = fake()->dateTimeBetween('-20 years', '-1 years')->format('Y');
    $inspectionDate = fake()->dateTimeBetween('-1 years', '+1 years')->format('Y-m-d');
    $insuranceDate = fake()->dateTimeBetween('-1 years', '+1 years')->format('Y-m-d');
    $oilChangeDate = fake()->dateTimeBetween('-6 months', '+6 months')->format('Y-m-d');
    $mileage = fake()->numberBetween(50000, 350000);

    Vehicle::create([
        'make' => fake()->randomElement(['BMW', 'Audi', 'Opel', 'Toyota', 'Honda']),
        'model' => fake()->word(),
        'vin' => fake()->regexify('[A-Z0-9]{17}'),
        'registration_number' => strtoupper(fake()->bothify('??#####')),
        'manufactured_year' => $manufacturedYear,
        'inspection_date' => $inspectionDate,
        'insurance_date' => $insuranceDate,
        'oil_change_date' => $oilChangeDate,
        'mileage' => $mileage,
        'fuel_type' => fake()->randomElement(['benzyna', 'diesel', 'hybryda', 'elektryczny']),
        'is_active' => true,
    ]);

    $this->dispatch('refresh');
}

    public function dateStatus($date)
{
    if (!$date) {
        return ['color' => 'red', 'label' => 'Brak'];
    }

    $days = now()->diffInDays($date, false);

    if ($days < 0) {
        return ['color' => 'red', 'label' => 'Przekroczono'];
    }

    if ($days <= 7) {
        return ['color' => 'orange', 'label' => 'Kończy się za tydzień'];
    }

    if ($days <= 30) {
        return ['color' => 'yellow', 'label' => 'Kończy się za miesiąc'];
    }

    return ['color' => 'green', 'label' => 'OK'];
}
}
