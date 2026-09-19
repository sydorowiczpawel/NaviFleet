<x-layouts::auth :title="__('Rejestracja nowego użytkownika')">
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Rejestracja nowego użytkownika')" :description="__('Wypełnij poniższe pola, aby utworzyć konto w aplikacji NaviFleet')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />
        <form method="POST" action="{{ route('createUser.random') }}">
            @csrf
            <flux:button type="submit" variant="primary" class="w-full" data-test="register-user-button">
                {{ __('Utwórz konto z losowym hasłem') }}
            </flux:button>
        </form>

        <form method="POST" action="{{ route('createUser.store') }}" class="flex flex-col gap-6">
            @csrf
            <!-- First Name -->
            <flux:input
                name="first_name"
                :label="__('Imię')"
                :value="old('first_name')"
                type="text"
                required
                autofocus
                autocomplete="first_name"
                :placeholder="__('First name only')"
            />
            <!-- Last Name -->
            <flux:input
                name="last_name"
                :label="__('Nazwisko')"
                :value="old('last_name')"
                type="text"
                required
                autocomplete="last_name"
                :placeholder="__('Last name')"
            />

            <!-- Email Address -->
            <flux:input
                name="email"
                :label="__('Adres email')"
                :value="old('email')"
                type="email"
                required
                autocomplete="email"
                placeholder="email@example.com"
            />
            <!-- Role in the company  - przyznawana jest przez Administratora lub moderatora-->
            @if(false)
            <flux:select
                name="role"
                :label="__('Rola w firmie')"
                :value="old('role')"
                required
>
                <option value="pracownik">Pracownik firmy NaviFleet</option>
                <option value="administrator aplikacji">Administrator aplikacji</option>
                <option value="moderator">Moderator</option>
                <option value="użytkownik">Użytkownik aplikacji</option>
            </flux:select>
            @endif


            <!-- Password -->
            <flux:input
                name="password"
                :label="__('Hasło')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Hasło')"
                passwordrules="{{ \Illuminate\Validation\Rules\Password::defaults()->toPasswordRulesString() }}"
                viewable
            />

            <!-- Confirm Password -->
            <flux:input
                name="password_confirmation"
                :label="__('Potwierdź hasło')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Potwierdź hasło')"
                passwordrules="{{ \Illuminate\Validation\Rules\Password::defaults()->toPasswordRulesString() }}"
                viewable
            />

            <div class="flex items-center justify-end">
                <flux:button type="submit" variant="primary" class="w-full" data-test="register-user-button">
                    {{ __('Utwórz konto') }}
                </flux:button>
            </div>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            <span>{{ __('Wygląda na to, że masz już konto.') }}</span>
            <flux:link :href="route('login')" wire:navigate>{{ __('Zaloguj się') }}</flux:link>
        </div>
    </div>
</x-layouts::auth>
