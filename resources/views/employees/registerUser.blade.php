<x-guest-layout>

    <div class="max-w-md mx-auto bg-white/70 dark:bg-gray-800/40 
                backdrop-blur-sm border border-gray-200 dark:border-gray-700 
                shadow-lg rounded-xl p-8">

        <h1 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-6 tracking-wide">
            Utwórz nowe konto użytkownika
        </h1>

        <form method="POST" action="{{ route('newRegister') }}" class="space-y-6">
            @csrf

            <!-- Imię -->
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Imię
                </label>
                <input id="first_name" type="text" name="first_name"
                       value="{{ old('first_name') }}"
                       required autofocus
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 
                              bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 
                              focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" />
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>

            <!-- Nazwisko -->
            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Nazwisko
                </label>
                <input id="last_name" type="text" name="last_name"
                       value="{{ old('last_name') }}"
                       required
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 
                              bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 
                              focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Email
                </label>
                <input id="email" type="email" name="email"
                       value="{{ old('email') }}"
                       required
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 
                              bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 
                              focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Hasło -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Hasło
                </label>
                <input id="password" type="password" name="password"
                       required
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 
                              bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 
                              focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Potwierdzenie hasła -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Potwierdź hasło
                </label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                       required
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 
                              bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 
                              focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Akcja -->
            <div class="flex items-center justify-end pt-4">
                <button type="submit"
                        class="px-6 py-2.5 rounded-lg bg-indigo-600 text-white font-medium 
                               hover:bg-indigo-700 transition shadow-sm">
                    Utwórz konto
                </button>
            </div>

        </form>
    </div>

</x-guest-layout>