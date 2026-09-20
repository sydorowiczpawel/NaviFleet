<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index()
    {
        // lista pracowników
        $employees = Employee::with('user')->get();
        return view('employees.index', compact('employees'));
    }

    public function givePrivileges()
    {
        // formularz nadawania uprawnień    
        $users = User::whereDoesntHave('employee')->get(); // pobieramy tylko użytkowników, którzy nie są jeszcze pracownikami

        return view('employees.convert', compact('users'));
    }   

    // przekształć użytkownika w pracownika
    public function convertFromUser(Request $request)
    {
        request()->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'job_role' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
        ]);

        $user = User::where('email', $request->email)->firstOrFail();

        // omijamy administratora aplikacji
        if ($user->role === 'administrator aplikacji') {
            return redirect()->back()->with('error', 'Nie można przekształcić administratora aplikacji w pracownika.');
        }

        // sprawdzamy, czy użytkownik nie jest już pracownikiem
        if ($user->employee) {
            return redirect()->back()->with('error', 'Użytkownik jest już pracownikiem.');
        }

        // jeśli już ma rekord w employees → nie rób nic / zwróć błąd
        if (Employee::where('user_id', $user->id)->exists()) {
        return back()->with('error', 'Ten użytkownik ma już nadane uprawnienia.');
    }

        // tworzymy nowego pracownika
        $employee = Employee::create([
            'user_id' => $user->id,
            'job_role' => $request->job_role,
            'department' => $request->department,
            'active' => true,
        ]);

        
        return back()->with('success', 'Pracownik został pomyślnie utworzony.');
    }   

    public function show($id)
    {
        $employee = Employee::with('user')->findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    public function edit($id)
    {
        $employee = Employee::with('user')->findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::with('user')->findOrFail($id);

        $validatedData = $request->validate([
            'job_role' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
        ]);

        $employee->update($validatedData);

        return redirect()->route('employees.show', $employee->id)->with('success', 'Pracownik został pomyślnie zaktualizowany.');
    }

    public function settings()
    {
        return view('employees.settings');
    }
}
