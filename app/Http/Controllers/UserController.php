<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // Walidacja
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'unique:users,email'],
            // 'role'       => ['required', 'string'],
            'password'   => ['required', 'string', 'min:8'],
        ]);

        // Zapis do bazy
        User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            // 'role'       => $request->role,
            'password'   => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Użytkownik został zapisany.');
    }

    public function storeRandom()
    {
        //lista ról - bez administratora
        $roles = ['moderator', 'pracownik', 'użytkownik'];

        // Generowanie losowych danych użytkownika
        $firstName = fake()->firstName();
        $lastName = fake()->lastName();
        $email = fake()->unique()->email();
        // $role = $roles[array_rand($roles)];
        $password = Hash::make('password'); // Możesz ustawić domyślne hasło lub wygenerować losowe

        // Zapis do bazy
        User::create([
            'first_name' => $firstName,
            'last_name'  => $lastName,
            'email'      => $email,
            // 'role'       => $role,
            'password'   => $password,
        ]);

        return redirect()->back()->with('success', 'Losowy użytkownik został zapisany.');
    }

    public function registerNewUser()
    {
        return view('employees.registerUser');
    }
}
