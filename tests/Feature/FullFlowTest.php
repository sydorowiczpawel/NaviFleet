<?php

use App\Models\User;
use App\Models\Employee;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

it('registers user, assaigns role, creates vehicle, assaigns it to the user, and log out an user', function() {
   
    // Create a user with known credentials
    // $password = 'password';
    $user = User::factory()->create([
        'first_name' => 'Unit',
        'last_name' => 'Test',
        'email' => 'test@example.com',
        'password' => Hash::make('dupa'),
    ]);

    // Send POST request to the login route with the correct credentials
    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'dupa',
    ]);

    // Assert that the user is authenticated and redirected to the home page
    $this->assertAuthenticatedAs($user);
    $response->assertRedirect('/dashboard');

    // Nadanie uprawnień pracowniczych i stanowiska kierowcy
    $employee = Employee::create([
        'user_id' => $user->id,
        'department' => 'grupa robotnicza',
        'job_role' => 'kierowca',
    ]);

    expect($employee->job_role)->toBe('kierowca');
    expect($employee->department)->not->toBe('Administracja');

    //Creating a Vehicle
    $vehicle = Vehicle::create([
        'make' => 'Acura',
        'model' => 'A50',
        'registration_number' => 'CBY12345',
        'vin' => 'testVIN1234567890',
        'manufactured_year' => 1990,
        'inspection_date' => NULL,
        'insurance_date' => NULL ,
        'is_active' => 0,
        'mileage' => 99345,
        'fuel_type' => 'benzyna',
        'oil_change_date' => NULL,
    ]);

    expect($vehicle->make)->toBe('Acura');

    // Przypisanie pojazdu do pracownika
    $vehicle->employee()->associate($employee->id);
    $vehicle->save();

    // expect($vehicle->employee()->count())->toBe(1);
    expect($employee->vehicles()->count())->toBe(1);


});