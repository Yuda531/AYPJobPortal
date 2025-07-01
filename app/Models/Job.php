<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id',
        'title',
        'description',
        'requirements',
        'location',
        'salary',
        'job_type',
        'experience_level',
        'deadline',
        'skills'
    ];

    protected $casts = [
        'deadline' => 'date'
    ];

    public function employer()
    {
        return $this->belongsTo(Employers::class, 'employer_id');
    }

    public function applications()
    {
        return $this->hasMany(\App\Models\JobApplication::class, 'job_id');
    }
}
