<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Load extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'number',
        'mop',
        'type',
        'network_id',
        'amount_id',
        'package_id',
    ];

    public function amount()
    {
        return $this->belongsTo(Amount::class, 'amount_id');
    }

    public function network()
    {
        return $this->belongsTo(Network::class, 'network_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
