<x-layouts::app :title="$employee->fullName()" class="bg-neutral-100">

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div class="flex items-center gap-4 mb-8">

            {{-- Powrót --}}
            <a href="{{ route('employees.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-neutral-100 text-neutral-700
                hover:bg-neutral-200 transition font-medium border border-neutral-300 shadow-sm">
                <i class="fas fa-arrow-left"></i>
                Powrót do listy
            </a>

            {{-- Edycja --}}
            <a href="{{ route('employees.edit', $employee) }}"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-indigo-600 text-white
                hover:bg-indigo-700 transition font-medium shadow-sm">
                <i class="fas fa-edit"></i>
                Edytuj pracownika
            </a>
        </div>

        {{-- PROFILE HEADER --}}
        <div class="relative -mt-20 px-6">

            <div class="bg-white rounded-3xl shadow-xl p-8 border border-neutral-200">

                <div class="flex flex-col md:flex-row gap-8">

                    {{-- PROFILE PHOTO (twardo ograniczone do 30%) --}}
                    <div class="employee-photo">
                        <img src="https://i.imgur.com/8Km9tLL.png" alt="Avatar pracownika">
                    </div>

                    {{-- MAIN INFO --}}
                    <div class="flex-1 flex flex-col justify-center">

                        <h1 class="text-4xl font-extrabold text-neutral-900 tracking-tight">
                            {{ $employee->fullName() }}
                        </h1>

                        <p class="text-xl text-indigo-600 font-semibold mt-2">
                            {{ $employee->job_role }}
                        </p>

                        <p class="text-neutral-600 text-lg mt-1">
                            {{ $employee->department }}
                        </p>

                        <div class="mt-4 flex flex-wrap gap-4 text-neutral-700">

                            <div class="px-4 py-2 bg-neutral-100 rounded-xl shadow-sm border border-neutral-200">
                                <span class="font-medium">Status:</span>
                                <span class="{{ $employee->active ? 'text-green-600' : 'text-red-600' }} font-semibold">
                                    {{ $employee->active ? 'Aktywny' : 'Wygaszony' }}
                                </span>
                            </div>

                            <div class="px-4 py-2 bg-neutral-100 rounded-xl shadow-sm border border-neutral-200">
                                <span class="font-medium">Email:</span>
                                {{ $employee->user->email }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- CONTENT SECTIONS --}}
        <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-10">

            {{-- ACCOUNT DATA --}}
            <div class="bg-white rounded-3xl shadow-lg p-8 border border-neutral-200">
                <h2 class="text-2xl font-bold text-neutral-900 mb-6">Dane konta</h2>

                <div class="space-y-3 text-neutral-700 text-lg">
                    <p><span class="font-medium text-neutral-900">ID konta:</span> {{ $employee->user->id }}</p>
                    <p><span class="font-medium text-neutral-900">Email:</span> {{ $employee->user->email }}</p>
                    <p><span class="font-medium text-neutral-900">Utworzono:</span> {{ $employee->user->created_at->format('d.m.Y') }}</p>
                    <p><span class="font-medium text-neutral-900">Aktualizacja:</span> {{ $employee->user->updated_at->format('d.m.Y') }}</p>
                </div>
            </div>

            {{-- EMPLOYEE DATA --}}
            <div class="bg-white rounded-3xl shadow-lg p-8 border border-neutral-200">
                <h2 class="text-2xl font-bold text-neutral-900 mb-6">Dane pracownicze</h2>

                <div class="space-y-3 text-neutral-700 text-lg">
                    <p><span class="font-medium text-neutral-900">ID pracownika:</span> {{ $employee->id }}</p>
                    <p><span class="font-medium text-neutral-900">Rola:</span> {{ $employee->job_role }}</p>
                    <p><span class="font-medium text-neutral-900">Dział:</span> {{ $employee->department }}</p>
                    <p>
                        <span class="font-medium text-neutral-900">Status:</span>
                        <span class="{{ $employee->active ? 'text-green-600' : 'text-red-600' }} font-semibold">
                            {{ $employee->active ? 'Aktywny' : 'Wygaszony' }}
                        </span>
                    </p>
                    <p><span class="font-medium text-neutral-900">Utworzono:</span> {{ $employee->created_at->format('d.m.Y') }}</p>
                    <p><span class="font-medium text-neutral-900">Aktualizacja:</span> {{ $employee->updated_at->format('d.m.Y') }}</p>
                </div>
            </div>

        </div>

        {{-- NOTES --}}
        <div class="mt-12 bg-white rounded-3xl shadow-lg p-10 border border-neutral-200">
            <h2 class="text-2xl font-bold text-neutral-900 mb-6">Notatki / Informacje dodatkowe</h2>

            <p class="text-neutral-700 leading-relaxed text-lg">
                Tutaj możesz dodać opis stanowiska, zakres obowiązków, historię zatrudnienia, uwagi HR,
                informacje o szkoleniach, certyfikatach lub inne dane, które chcesz przechowywać.
            </p>
        </div>

    </div>

</x-layouts::app>