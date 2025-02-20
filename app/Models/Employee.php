<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Employee extends Model
{
    protected $guarded = [];

    public const RULES = [
        'original_id' => 'nullable|string|unique:employees,original_id|regex:/^\d+$/',
        'email' => 'required|email|unique:employees,email',
        'firstname' => 'required|string',
        'lastname' => 'required|string',
        'ssn' => 'required|string',
        'phone' => 'required|string',
        'salary' => 'required|integer',
        'dob' => 'required|date',
        'employment_from' => 'required|date',
        'employment_to' => 'nullable|date',
    ];

    /**
     * Get validation rules for creating a new employee
     */
    public static function getCreationRules(): array
    {
        return self::RULES;
    }

    /**
     * Get validation rules for updating an employee
     */
    public function getUpdateRules(): array
    {
        return [
            ...self::RULES,
            'email' => self::RULES['email'] . ($this->id ? ",$this->id" : ''),
        ];
    }

    /**
     * Check if is a former employee
     */
    public function isFormerEmployee(): bool
    {
        if ($this->employment_to === null) {
            return false;
        }

        return Carbon::parse($this->employment_to)->isPast();
    }
}
