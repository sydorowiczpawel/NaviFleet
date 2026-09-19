co sie odpierdala
<x-layouts::app :title="__('Przekształć na pracownika')">
    <div class="max-w-xl mx-auto w-full rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 p-6 shadow-sm">

        <h2 class="text-xl font-semibold text-neutral-800 dark:text-neutral-200 mb-6">
            Przekształć na pracownika
        </h2>

        <form method="POST" action="{{ route('employees.convert') }}" class="flex flex-col gap-4">
        @csrf

            <select name="email" class="border p-2 rounded" required>
                <option value="">-- wybierz użytkownika --</option>

                @foreach($users as $user)
                    <option value="{{ $user->email }}">
                        {{ $user->first_name }} {{ $user->last_name }} — {{ $user->email }}
                    </option>
                @endforeach
            </select>

            <select name="job_role" class="border p-2 rounded" required>
                <option value="kierowca">Kierowca</option>
                <option value="sprzątaczka">Sprzątaczka</option>
                <option value="mechanik">Mechanik</option>
                <option value="magazynier">Magazynier</option>
            </select>

            <select name="department" class="border p-2 rounded" required>
                <option value="administracja">Administracja</option>
                <option value="grupa robotnicza">Grupa robotnicza</option>
                <option value="zarząd">Zarząd</option>
            </select>

            <button type="submit" 
    class="bg-blue-600 text-white px-4 py-2 rounded !block !visible !opacity-100">
    Przekształć na pracownika   
            </button>
        </form>
    </div>
</x-layouts::app>
