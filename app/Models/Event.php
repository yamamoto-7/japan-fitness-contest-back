<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'organization',
        'start_date',
        'end_date',
        'location',
        'official_url',
        'is_published',
    ];
}
