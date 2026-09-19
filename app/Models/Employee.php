<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
        'job_role',
        'department',
        'active',
        'hired_at',
        'terminated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fullName(): string
    {
        return $this->user->first_name . ' ' . $this->user->last_name;
    }
}