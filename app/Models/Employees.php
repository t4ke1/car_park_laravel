<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employees extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function jobTitle(): BelongsTo
    {
        return $this->belongsTo(Job_Title::class);
    }
}
