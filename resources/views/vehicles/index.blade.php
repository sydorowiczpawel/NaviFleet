<x-layouts::app :title="__('Pojazdy')">

    <div class="flex flex-col gap-6">
        <flux:button variant="primary" :href="route('vehicles.add')" wire:navigate>
            {{ __('Dodaj pojazd do floty') }}
        </flux:button>

        <!-- 🔍 Wyszukiwarka + Filtry -->
        <div class="flex flex-wrap items-center gap-4">

            <flux:input 
                placeholder="Szukaj po marce, modelu, VIN lub rejestracji..."
                wire:model.live="search"
                class="w-72"
            />

            <flux:select  name='make'wire:model.live="filterMake" class="w-40">
                <option value="">Szukaj po marce pojazdu</option>
                
                @foreach($uniqueMakes as $make)
                    <option value="{{ $make }}">{{ ucfirst($make) }}</option>
                @endforeach
            </flux:select>

            <flux:select wire:model.live="filterFuel" class="w-40">
                <option value="">Paliwo</option>
                <option value="benzyna">Benzyna</option>
                <option value="diesel">Diesel</option>
                <option value="hybryda">Hybryda</option>
                <option value="elektryczny">Elektryczny</option>
            </flux:select>

            <flux:select wire:model.live="filterStatus" class="w-40">
                <option value="">Status</option>
                <option value="active">Aktywny</option>
                <option value="inactive">Nieaktywny</option>
            </flux:select>

        </div>

        <!-- 📋 Tabela -->
        <div class="w-full overflow-x-auto rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900">

            <table class="w-full border-collapse">
                <thead class="bg-neutral-50 dark:bg-neutral-800">
                    <tr class="border-b text-left">

                        <th class="p-3 font-semibold">
                            <flux:button variant="ghost" size="sm" wire:click="sortBy('id')">
                                ID
                            </flux:button>
                        </th>

                        <th class="p-3 font-semibold">
                            <flux:button variant="ghost" size="sm" wire:click="sortBy('make')">
                                Marka / Model
                            </flux:button>
                        </th>

                        <th class="p-3 font-semibold">
                            Rejestracja
                        </th>

                        <th class="p-3 font-semibold">
                            VIN
                        </th>

                        <th class="p-3 font-semibold">
                            Rok prod.
                        </th>

                        <th class="p-3 font-semibold">
                            Przegląd
                        </th>

                        <th class="p-3 font-semibold">
                            Ubezpieczenie
                        </th>

                        <th class="p-3 font-semibold">
                            Przypisany
                        </th>

                        <th class="p-3 font-semibold">
                            Status
                        </th>

                        <th class="p-3 font-semibold text-right">
                            Akcje
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">

                    @foreach($vehicles as $vehicle)
                        <tr class="hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors">

                            <!-- ID -->
                            <td class="p-3 font-mono text-neutral-600 dark:text-neutral-300">
                                #{{ $vehicle->id }}
                            </td>

                            <!-- Avatar + Marka/Model -->
                            <td class="p-3 flex items-center gap-3">
                                <flux:avatar 
                                    :name="$vehicle->make . ' ' . $vehicle->model"
                                    :initials="strtoupper(substr($vehicle->make,0,1))"
                                />
                                {{ $vehicle->make }} {{ $vehicle->model }}
                            </td>

                            <td class="p-3">
                                {{ $vehicle->registration_number ?? '—' }}
                            </td>

                            <td class="p-3 font-mono">
                                {{ $vehicle->vin }}
                            </td>

                            <td class="p-3">
                                {{ $vehicle->manufactured_year }}
                            </td>

                            <td class="p-3">
                                @if($vehicle->inspection_date)
                                    <flux:badge color="blue">
                                        {{ $vehicle->inspection_date }}
                                    </flux:badge>
                                @else
                                    <flux:badge color="red">Brak</flux:badge>
                                @endif
                            </td>

                            <td class="p-3">
                                @if($vehicle->insurance_date)
                                    <flux:badge color="green">
                                        {{ $vehicle->insurance_date }}
                                    </flux:badge>
                                @else
                                    <flux:badge color="red">Brak</flux:badge>
                                @endif
                            </td>

                            <td class="p-3">
                                @if($vehicle->employee)
                                    <flux:badge color="purple">
                                        {{ $vehicle->employee->fullName() }}
                                    </flux:badge>
                                @else
                                    <flux:badge color="gray">Nieprzypisany</flux:badge>
                                @endif
                            </td>

                            <td class="p-3">
                                @if($vehicle->is_active)
                                    <flux:badge color="green">Aktywny</flux:badge>
                                @else
                                    <flux:badge color="red">Nieaktywny</flux:badge>
                                @endif
                            </td>

                            <!-- Menu akcji -->
                            <td class="p-3 text-right">

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

        <!-- 📄 Paginacja -->
        @if(false)
        <div>
            {{ $vehicles->links() }}
        </div>
        @endif

    </div>

</x-layouts::app>