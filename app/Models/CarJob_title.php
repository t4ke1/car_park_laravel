<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarJob_title extends Model
{
    use HasFactory;

    protected $table = 'car_job_titles';

    protected $fillable = [
        'car_id',
        'job_title_id',
    ];
}
