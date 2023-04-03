<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'user_id',
        'event',
        'when',
        'details',
        'auditable_id',
        'auditable_type',
    ];

    protected $casts = [
        'when' => 'datetime',
        'details' => 'json',
    ];

}
