<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'Shift',
        'name',
        'opening',
        'closing',
        'sales'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
