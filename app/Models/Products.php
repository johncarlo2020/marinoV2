<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'details',
        'image',
        'price',
        'isReaload',
        'shopUrl',
        'countries',
        'notes',
        'packages',
        'top_up',
        'mop',
    ];
}
