<x-layouts::app :title="__('Nadawanie uprawnień pracownikom')">

    <div class="max-w-6xl mx-auto w-full p-8">

        <h2 class="text-2xl font-semibold text-neutral-800 dark:text-neutral-200 mb-8 tracking-wide">
            Użytkownicy bez nadanych uprawnień
        </h2>

        <div class="overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 shadow-sm">
            <table class="w-full border-collapse">
                <thead class="bg-neutral-50 dark:bg-neutral-800/50">
                    <tr class="text-left text-sm text-gray-600 dark:text-gray-400 border-b border-neutral-300 dark:border-neutral-700">
                        <th class="py-3 px-4">Użytkownik</th>
                        <th class="py-3 px-4">Email</th>
                        <th class="py-3 px-4">Dział</th>
                        <th class="py-3 px-4">Stanowisko</th>
                        <th class="py-3 px-4 text-right">Akcja</th>
                    </tr>
                </thead>

                <tbody class="text-sm text-gray-800 dark:text-gray-200">

                    @foreach($users as $user)
                        <tr 
                            x-data="{
                                department: '',
                                role: '',
                                rolesByDepartment: {
                                    'administracja': ['Sekretarka', 'Asystent', 'Koordynator'],
                                    'grupa robotnicza': ['Kierowca', 'Mechanik', 'Magazynier'],
                                    'zarząd': ['Manager', 'Dyrektor', 'Kierownik']
                                }
                            }"
                            class="border-b border-neutral-200 dark:border-neutral-700 hover:bg-neutral-50/50 dark:hover:bg-neutral-800/30 transition"
                        >

                            <!-- Użytkownik -->
                            <td class="py-4 px-4 font-medium flex items-center gap-2">
                                <!-- Ikona -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-neutral-500" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 1115 0v.75H4.5v-.75z" />
                                </svg>

                                {{ $user->first_name }} {{ $user->last_name }}
                            </td>

                            <!-- Email -->
                            <td class="py-4 px-4 text-gray-600 dark:text-gray-400">
                                {{ $user->email }}
                            </td>

                            <!-- Dział -->
                            <td class="py-4 px-4">
                                <select 
                                    class="px-3 py-2 rounded-lg border border-neutral-300 dark:border-neutral-600 
                                           bg-white dark:bg-neutral-800 w-full transition"
                                    x-model="department"
                                >
                                    <option value="">Wybierz dział…</option>
                                    <option value="administracja">Administracja</option>
                                    <option value="grupa robotnicza">Grupa robotnicza</option>
                                    <option value="zarząd">Zarząd</option>
                                </select>
                            </td>

                            <!-- Stanowisko -->
                            <td class="py-4 px-4">
                                <template x-if="department">
                                    <select 
                                        class="px-3 py-2 rounded-lg border border-neutral-300 dark:border-neutral-600 
                                               bg-white dark:bg-neutral-800 w-full transition"
                                        x-model="role"
                                        x-transition.opacity
                                    >
                                        <option value="">Wybierz stanowisko…</option>
                                        <template x-for="r in rolesByDepartment[department]">
                                            <option :value="r" x-text="r"></option>
                                        </template>
                                    </select>
                                </template>

                                <template x-if="!department">
                                    <div class="text-neutral-400 dark:text-neutral-600 italic">
                                        Najpierw wybierz dział…
                                    </div>
                                </template>
                            </td>

                            <!-- Akcja -->
                            <td class="py-4 px-4 text-right">
                                <form method="POST" action="{{ route('employees.convert') }}">
                                    @csrf

                                    <input type="hidden" name="email" value="{{ $user->email }}">
                                    <input type="hidden" name="department" :value="department">
                                    <input type="hidden" name="job_role" :value="role">

                                    <button 
                                        type="submit"
                                        class="px-4 py-2 rounded-lg bg-indigo-600 text-white font-medium 
                                               shadow-sm hover:bg-indigo-700 transition
                                               disabled:opacity-40 disabled:cursor-not-allowed"
                                        :disabled="department === '' || role === ''"
                                        x-transition.opacity
                                    >
                                        Nadaj uprawnienia
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>

</x-layouts::app>