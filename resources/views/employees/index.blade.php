<x-layouts::app :title="__('Pracownicy')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900">
            <table class="w-full border-collapse">
                <thead class="bg-neutral-50 dark:bg-neutral-800">
                    <tr class="border-b text-center">
                        <th class="p-3 font-semibold">Imię i nazwisko</th>
                        <th class="p-3 font-semibold">Email</th>
                        <th class="p-3 font-semibold">Rola</th>
                        <th class="p-3 font-semibold">Dział</th>
                        <th class="p-3 font-semibold">Status</th>
                        <th class="p-3 font-semibold text-right">Teczka</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @foreach($employees as $employee)
                        <tr class="hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors text-center">
                            <td class="p-3">{{ $employee->fullName() }}</td>
                            <td class="p-3">{{ $employee->user->email }}</td>
                            <td class="p-3">{{ $employee->job_role }}</td>
                            <td class="p-3">{{ $employee->department }}</td>
                            <td class="p-3">{{ $employee->active ? 'Aktywny' : 'Wygaszony' }}</td>

                            <td class="p-3 text-right">
                                <flux:button 
                                    variant="primary" 
                                    size="sm"
                                    :href="route('employees.show', $employee->id)"
                                    wire:navigate
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-person" viewBox="0 0 16 16">
                                        <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2v9.255S12 12 8 12s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h5.5z"/>
                                    </svg>
                                </flux:button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-layouts::app>