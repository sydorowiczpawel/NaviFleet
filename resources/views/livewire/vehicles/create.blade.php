    <div class="flex flex-col gap-6 max-w-3xl">
        <flux:card class="p-6">
            <form wire:submit.prevent="save" class="flex flex-col gap-6">
                <!-- Marka -->
                <flux:input 
                    label="Marka" 
                    placeholder="np. BMW, Audi, Ford"
                    name="make"
                    wire:model.live="make"
                    required
                />

                <!-- Model -->
                <flux:input 
                    label="Model" 
                    placeholder="np. X5, A4, Transit"
                    name="model"
                    wire:model.live="model"
                    required
                />

                <!-- Numer rejestracyjny -->
                <flux:input 
                    label="Numer rejestracyjny" 
                    placeholder="np. WY12345"
                    name="registration_number"
                    wire:model.live="registration_number"
                />

                <!-- VIN -->
                <flux:input 
                    label="VIN (17 znaków)" 
                    placeholder="np. WBABA311A83629873"
                    name="vin"
                    wire:model.live="vin"
                    required
                />

                <!-- Rok produkcji -->
                <flux:input 
                    type="date"
                    label="Rok produkcji"
                    name="manufactured_year"
                    wire:model.live="manufactured_year"
                    required
                />

                <!-- Data przeglądu -->
                <flux:input 
                    type="date"
                    label="Data przeglądu"
                    name="inspection_date"
                    wire:model.live="inspection_date"
                />

                <!-- Data ubezpieczenia -->
                <flux:input 
                    type="date"
                    label="Data ubezpieczenia"
                    name="insurance_date"
                    wire:model.live="insurance_date"
                />

                <!-- Przypisany pracownik -->
                <flux:select 
                    label="Przypisz do pracownika"
                    name="employee_id"
                    wire:.model.live="employee_id"
                >
                    <option value="">— Nieprzypisany —</option>

                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">
                            {{ $employee->fullName() }}
                        </option>
                    @endforeach
                </flux:select>

                <!-- Przebieg -->
                <flux:input 
                    type="number"
                    step="0.01"
                    label="Przebieg (km)"
                    name="mileage"
                    placeholder="np. 152000"
                    wire:model.live="mileage"
                />

                <!-- Rodzaj paliwa -->
                <flux:select 
                    label="Rodzaj paliwa"
                    name="fuel_type"
                    wire:.model.live="fuel_type"
                >
                    <option value="">— wybierz —</option>
                    <option value="benzyna">Benzyna</option>
                    <option value="diesel">Diesel</option>
                    <option value="hybryda">Hybryda</option>
                    <option value="elektryczny">Elektryczny</option>
                </flux:select>

                <!-- Data wymiany oleju -->
                <flux:input 
                    type="date"
                    label="Data ostatniej wymiany oleju"
                    name="oil_change_date"
                    wire:model.live="oil_change_date"
                />

                <!-- Status -->
                <flux:select 
                    label="Status pojazdu"
                    name="is_active"
                    wire:.model.live="is_active"
                    required
                >
                    <option value="1">Aktywny</option>
                    <option value="0">Nieaktywny</option>
                </flux:select>

                <!-- Submit -->
                <flux:button 
                    type="submit" 
                    variant="primary" 
                    class="w-full"
                >
                    Dodaj pojazd
                </flux:button>
            </form>
        </flux:card>
    </div>