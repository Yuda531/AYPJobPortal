<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSeekers extends Model
{
    use HasFactory;

    protected $table = 'job_seekers';

    protected $fillable = [
        'user_id',
        'phone',
        'location',
        'title',
        'bio',
        'skills',
        'experience',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
