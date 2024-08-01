<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drive_times extends Model
{
    use HasFactory;

    protected $table = 'drive_times';

    protected $fillable = [
        'date',
        'start_time',
        'end_time',
    ];
}
