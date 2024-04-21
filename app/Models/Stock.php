<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'qty',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
