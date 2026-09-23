
    <div class="flex flex-col gap-10">

        {{-- 🔥 ULTRA-PREMIUM TOP BAR --}}
        <div class="flex flex-wrap items-center justify-between gap-6">

            <div class="flex items-center gap-3">
                <flux:button variant="primary" :href="route('vehicles.add')" wire:navigate>
                    Dodaj pojazd do floty
                </flux:button>

                <flux:button variant="ghost" color="green" wire:click="addRandomVehicle">
                    Dodaj losowy pojazd
                </flux:button>
            </div>

            {{-- Wyszukiwarka --}}
            <flux:input 
                placeholder="Szukaj po marce, modelu, VIN lub rejestracji..."
                wire:model.live="search"
                class="w-96"
            />
        </div>

        {{-- 🔍 ULTRA-PREMIUM FILTRY --}}
        <div class="flex flex-wrap items-center gap-4">

            <flux:select wire:model.live="filterMake" class="w-48">
                <option value="">Marka</option>
                @foreach($uniqueMakes as $make)
                    <option value="{{ $make }}">{{ ucfirst($make) }}</option>
                @endforeach
            </flux:select>

            <flux:select wire:model.live="filterFuel" class="w-48">
                <option value="">Paliwo</option>
                <option value="benzyna">Benzyna</option>
                <option value="diesel">Diesel</option>
                <option value="hybryda">Hybryda</option>
                <option value="elektryczny">Elektryczny</option>
            </flux:select>

            <flux:select wire:model.live="filterStatus" class="w-48">
                <option value="">Status</option>
                <option value="active">Aktywny</option>
                <option value="inactive">Nieaktywny</option>
            </flux:select>

        </div>

        {{-- 📋 ULTRA-PREMIUM TABELA --}}
        <div class="w-full overflow-x-auto rounded-3xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 shadow-xl">

            <table class="w-full border-collapse">
                <thead class="bg-neutral-50 dark:bg-neutral-800">
                    <tr class="border-b text-left text-neutral-700 dark:text-neutral-200">

                        <th class="p-4 font-semibold">
                            <flux:button variant="ghost" size="sm" wire:click="sortBy('make')">
                                Marka / Model
                            </flux:button>
                        </th>

                        <th class="p-4 font-semibold">Rejestracja</th>
                        <th class="p-4 font-semibold">Stan licznika</th>
                        <th class="p-4 font-semibold">VIN</th>
                        <th class="p-4 font-semibold">Rok prod.</th>
                        <th class="p-4 font-semibold">Przegląd</th>
                        <th class="p-4 font-semibold">Ubezpieczenie</th>
                        <th class="p-4 font-semibold">Wymiana oleju</th>
                        <th class="p-4 font-semibold">Przypisany</th>
                        <th class="p-4 font-semibold">Status</th>

                        <th class="p-4 font-semibold text-right">Akcje</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">

                    @foreach($vehicles as $vehicle)
                    @php $status = $this->dateStatus($vehicle->inspection_date); @endphp

                        <tr class="hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors">

                            {{-- Marka / Model --}}
                            <td class="p-4 font-medium text-neutral-900 dark:text-neutral-100">
                                {{ $vehicle->make }} {{ $vehicle->model }}
                            </td>

                            <td class="p-4">
                                {{ $vehicle->registration_number ?? '—' }}
                            </td>

                            <td class="p-4">
                                <flux:badge color="blue">
                                    {{ number_format($vehicle->mileage) }} km
                                </flux:badge>
                            </td>

                            <td class="p-4 font-mono">
                                {{ $vehicle->vin }}
                            </td>

                            <td class="p-4">
                                {{ $vehicle->manufactured_year }}
                            </td>

                            <td class="p-4">
                                @php $status = $this->dateStatus($vehicle->inspection_date); @endphp
                                <flux:badge color="{{ $status['color'] }}">
                                    {{ $vehicle->inspection_date }} — {{ $status['label'] }}
                                </flux:badge>
                            </td>

                            <td class="p-4">
                                @php $status = $this->dateStatus($vehicle->insurance_date); @endphp
                                <flux:badge color="{{ $status['color'] }}">
                                    {{ $vehicle->insurance_date }} — {{ $status['label'] }}
                                </flux:badge>
                            </td>

                            <td class="p-4">
                                @php $status = $this->dateStatus($vehicle->oil_change_date); @endphp
                                <flux:badge color="{{ $status['color'] }}">
                                    {{ $vehicle->oil_change_date }} — {{ $status['label'] }}
                                </flux:badge>
                            </td>

                            <td class="p-4">
                                @if($vehicle->employee)
                                    <flux:badge color="purple">{{ $vehicle->employee->fullName() }}</flux:badge>
                                @else
                                    <flux:badge color="gray">Nieprzypisany</flux:badge>
                                @endif
                            </td>

                            <td class="p-4">
                                @if($vehicle->is_active)
                                    <flux:badge color="green">Aktywny</flux:badge>
                                @else
                                    <flux:badge color="red">Nieaktywny</flux:badge>
                                @endif
                            </td>

                            {{-- Akcje --}}
                            <td class="p-4 text-right">
                                <flux:dropdown position="bottom-end">
                                    <flux:button variant="ghost" icon="ellipsis-vertical" size="sm" />

                                    <flux:menu>

                                        <flux:menu.item 
                                            :href="route('vehicles.show', $vehicle->id)" 
                                            icon="folder-open"
                                            wire:navigate
                                        >
                                            Szczegóły pojazdu
                                        </flux:menu.item>

                                        <flux:menu.item 
                                            :href="route('vehicles.edit', $vehicle->id)" 
                                            icon="pencil-square"
                                            wire:navigate
                                        >
                                            Edytuj dane
                                        </flux:menu.item>

                                        @if($vehicle->is_active)
                                            <flux:menu.item 
                                                :href="route('vehicles.deactivate', $vehicle->id)"
                                                icon="no-symbol"
                                            >
                                                Dezaktywuj
                                            </flux:menu.item>
                                        @else
                                            <flux:menu.item 
                                                :href="route('vehicles.activate', $vehicle->id)"
                                                icon="check"
                                            >
                                                Aktywuj
                                            </flux:menu.item>
                                        @endif

                                        <flux:menu.separator />

                                        <flux:menu.item 
                                            wire:click="delete({{ $vehicle->id }})"
                                            icon="trash"
                                            color="red"
                                        >
                                            Usuń pojazd
                                        </flux:menu.item>

                                    </flux:menu>
                                </flux:dropdown>
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>

