<x-app-layout>
<!-- Tutaj zaczyna się wszystko pod Logo Laravel i nagówka Dashboard -->
    <!-- TREŚĆ STRONY -->
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4">

            <!-- GRID KAFELKÓW -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Brak uprawnień -->
                @if(auth()->user()->role === null)
                    <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-xl transition transform hover:-translate-y-1">
                        <h3 class="text-xl font-semibold mb-2">Nie posiadasz uprawnień</h3>
                        <p class="text-gray-600 dark:text-gray-400">Skontaktuj się z administratorem.</p>
                    </div>
                @endif

                <!-- Użytkownik -->
                @if(auth()->user()->role === 'user')
                    <a href="{{ route('vehicles.index') }}" 
                       class="group p-6 bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-xl transition transform hover:-translate-y-1 block">
                        <div class="flex items-center gap-3 mb-3">
                            <svg class="h-7 w-7 text-indigo-600 group-hover:text-indigo-700" fill="none"
                                 stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M3 13l2-2m0 0l7-7 7 7M5 11v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3" />
                            </svg>
                            <h3 class="text-xl font-semibold">Moje pojazdy</h3>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400">Lista pojazdów przypisanych do Ciebie.</p>
                    </a>
                @endif

                <!-- Moderator -->
                @if(auth()->user()->role === 'moderator')
                    <a href="{{ route('employees.index') }}" 
                       class="group p-6 bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-xl transition transform hover:-translate-y-1 block">
                        <div class="flex items-center gap-3 mb-3">
                            <svg class="h-7 w-7 text-indigo-600 group-hover:text-indigo-700" fill="none"
                                 stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M17 20h5v-2a4 4 0 00-4-4h-1m-6 6h5v-2a4 4 0 00-4-4H9m-6 6h5v-2a4 4 0 00-4-4H4" />
                            </svg>
                            <h3 class="text-xl font-semibold">Pracownicy</h3>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400">Zarządzaj pracownikami.</p>
                    </a>

                    <a href="{{ route('vehicles.index') }}" 
                       class="group p-6 bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-xl transition transform hover:-translate-y-1 block">
                        <div class="flex items-center gap-3 mb-3">
                            <svg class="h-7 w-7 text-indigo-600 group-hover:text-indigo-700" fill="none"
                                 stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M3 13l2-2m0 0l7-7 7 7M5 11v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3" />
                            </svg>
                            <h3 class="text-xl font-semibold">Pojazdy</h3>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400">Zarządzaj flotą.</p>
                    </a>
                @endif

                <!-- Administrator -->
                @if(auth()->user()->role === 'administrator')
                    <a href="{{ route('employees.index') }}" 
                       class="group p-6 bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-xl transition transform hover:-translate-y-1 block">
                        <div class="flex items-center gap-3 mb-3">
                            <svg class="h-7 w-7 text-indigo-600 group-hover:text-indigo-700" fill="none"
                                 stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M17 20h5v-2a4 4 0 00-4-4h-1m-6 6h5v-2a4 4 0 00-4-4H9m-6 6h5v-2a4 4 0 00-4-4H4" />
                            </svg>
                            <h3 class="text-xl font-semibold">Pracownicy</h3>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400">Zarządzaj pracownikami.</p>
                    </a>

                    <a href="{{ route('vehicles.index') }}" 
                       class="group p-6 bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-xl transition transform hover:-translate-y-1 block">
                        <div class="flex items-center gap-3 mb-3">
                            <svg class="h-7 w-7 text-indigo-600 group-hover:text-indigo-700" fill="none"
                                 stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M3 13l2-2m0 0l7-7 7 7M5 11v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3" />
                            </svg>
                            <h3 class="text-xl font-semibold">Pojazdy</h3>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400">Zarządzaj flotą.</p>
                    </a>

                    <a href="{{ route('employees.create') }}" 
                       class="group p-6 bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-xl transition transform hover:-translate-y-1 block">
                        <div class="flex items-center gap-3 mb-3">
                            <svg class="h-7 w-7 text-indigo-600 group-hover:text-indigo-700" fill="none"
                                 stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M12 4v16m8-8H4" />
                            </svg>
                            <h3 class="text-xl font-semibold">Nadaj uprawnienia</h3>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400">Dodaj nowego użytkownika.</p>
                    </a>

                    <a href="#" 
                       class="group p-6 bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-xl transition transform hover:-translate-y-1 block">
                        <div class="flex items-center gap-3 mb-3">
                            <svg class="h-7 w-7 text-indigo-600 group-hover:text-indigo-700" fill="none"
                                 stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M12 8c-1.1 0-2 .9-2 2v4h4v-4c0-1.1-.9-2-2-2z" />
                                <path d="M19.4 15a7.96 7.96 0 00.4-2 8 8 0 10-8 8 7.96 7.96 0 002-.4" />
                            </svg>
                            <h3 class="text-xl font-semibold">Ustawienia aplikacji</h3>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400">Konfiguracja systemu.</p>
                    </a>
                @endif

            </div>

        </div>
    </div>

</x-app-layout>