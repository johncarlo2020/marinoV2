<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'item_id',
        'qty',
        'price',
        'mop',
        'or',
        'notes',
    ];
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
