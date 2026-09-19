<?php 

namespace App\Livewire;

use Livewire\Component;
use App\Models\Vehicle;

class VehiclesIndex extends Component
{
    public $search = '';
    public $filterMake = '';
    public $filterFuel = '';

    public function render()
    {
        return view('livewire.vehicles-index', [
            'vehicles' => Vehicle::query()
                ->when($this->search, fn($q) => $q->where('make', 'like', "%{$this->search}%"))
                ->when($this->filterMake, fn($q) => $q->where('make', $this->filterMake))
                ->when($this->filterFuel, fn($q) => $q->where('fuel_type', $this->filterFuel))
                ->get(),
        ]);
    }
}