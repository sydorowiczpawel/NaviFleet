edycja istniejącego pracownika, w tym przypadku użytkownika z ID 1. Formularz jest wypełniony danymi tego użytkownika, a po jego edycji i wysłaniu formularza, dane zostaną zaktualizowane w bazie danych.

Proba wyswietlania:

- imię i nazwisko: {{ $employee->fullName() }}
- email: {{ $employee->user->email }}   