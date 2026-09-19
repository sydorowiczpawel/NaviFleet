<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800">
    <!-- SIDEBAR -->
    <flux:sidebar sticky collapsible="mobile" class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">

        <flux:sidebar.header>
            <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
            <flux:sidebar.collapse class="lg:hidden" />
        </flux:sidebar.header>

        <flux:sidebar.nav>
            
        <!-- Panel osoby z nieaktywnymi uprawnieniami -->
         @if(auth()->user()?->role === NULL)
            <flux:sidebar.group :heading="__('Nie posiadasz uprawnień')" class="grid">
                ELO
            </flux:sidebar.group>
            <!-- Panel użytkownika -->
        @elseif (auth()->user()?->role !== 'administrator')
            <flux:sidebar.group :heading="__('Panel użytkownika')" class="grid">
                <!-- Przycisk "Pracownicy" -->
                <flux:sidebar.item 
                    icon="home" :href="route('employees.index')" :current="request()->routeIs('employees.index')" wire:navigate>
                    {{ __('Pracownicy') }}
                </flux:sidebar.item>
                @if(false)
                <!-- Przycisk "Pojazdy" -->
                <flux:sidebar.item 
                    icon="home" 
                    :href="route('vehicles.index')" 
                    :current="request()->routeIs('vehicles.index')" 
                    wire:navigate>
                    {{ __('Pojazdy') }}
                </flux:sidebar.item>
                @endif
            </flux:sidebar.group>
        @endif
            
            <flux:spacer />

            <!-- Panel Administratora -->
            @if(auth()->user()?->role === 'administrator')
                
                    <flux:sidebar.group :heading="__('Administrator aplikacji')" class="grid"></flux:sidebar.group>

                    <!-- Przyciks Pracownicy -->
                    <flux:sidebar.item 
                    icon="home" :href="route('employees.index')" :current="request()->routeIs('employees.index')" wire:navigate>
                    {{ __('Pracownicy') }}
                    </flux:sidebar.item>
                
                    <!-- Przycisk "Pojazdy" -->
                    <flux:sidebar.item 
                    icon="home" :href="route('vehicles.index')" :current="request()->routeIs('vehicles.index')" wire:navigate>
                        {{ __('Pojazdy') }}
                    </flux:sidebar.item>

                    <!-- Przycisk "Zlecenia" -->
                    <flux:sidebar.item 
                    icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Zlecenia') }}
                    </flux:sidebar.item>

                    <!-- Przycisk "Przekształć na pracownika" -->
                    <flux:sidebar.item 
                        icon="users" :href="route('employees.create')" :current="request()->routeIs('employees/create')" wire:navigate>
                        {{ __('Przekształć na pracownika') }}
                    </flux:sidebar.item>

                    <flux:sidebar.item icon="folder-git-2" href="https://github.com/sydorowiczpawel" target="_blank">
                        {{ __('Github') }}
                    </flux:sidebar.item>

                    <flux:sidebar.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
                        {{ __('Documentation') }}
                    </flux:sidebar.item>
                
            @endif
        </flux:sidebar.nav>

        <flux:spacer />
        <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->first_name" />

    </flux:sidebar>
    
    <!-- MOBILE HEADER -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile
                :initials="auth()->user()->initials()"
                icon-trailing="chevron-down"
            />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <flux:avatar
                                :name="auth()->user()->first_name"
                                :initials="auth()->user()->initials()"
                            />

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <flux:heading class="truncate">{{ auth()->user()->first_name }}</flux:heading>
                                <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                        {{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item
                        as="button"
                        type="submit"
                        icon="arrow-right-start-on-rectangle"
                        class="w-full cursor-pointer"
                        data-test="logout-button"
                    >
                        {{ __('Log out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>
    
    <!-- MAIN CONTENT (TWÓJ SLOT) -->
    {{ $slot }}
    
    @persist('toast')
        <flux:toast.group>
            <flux:toast />
        </flux:toast.group>
    @endpersist

    @fluxScripts
</body>
</html>