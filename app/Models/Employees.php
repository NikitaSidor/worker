<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Employees extends Model
{
    use HasFactory;
    use AsSource;

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'job_title_id',
        'department_id',
        'salary',
        'employment_under',
        'currency',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function jobTitle()
    {
        return $this->belongsTo(JobTitle::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function getEmploymentUnderTextAttribute()
    {
        $employmentUnderTexts = [
            1 => 'Full-time',
            2 => 'Part-time',
            3 => 'Contract',
            // Add other mappings as needed
        ];

        return $employmentUnderTexts[$this->employment_under] ?? 'Unknown';
    }
}
