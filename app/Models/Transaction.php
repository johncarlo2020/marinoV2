<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'name',
        'baht_amount',
        'php_amount',
        'mop',
        'or',
        'notes',
        'shift_id',
    ];

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }
}
