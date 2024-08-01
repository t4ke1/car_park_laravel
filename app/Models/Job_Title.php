<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job_Title extends Model
{
    use HasFactory;

    protected $table = 'job_titles';

    protected $fillable = [
        'title',
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employees::class);
    }

    public function cars(): BelongsToMany
    {
        return $this->belongsToMany(
            Car::class,
            'car_job_titles',
            'job_title_id',
            'car_id'
        );
    }
}
