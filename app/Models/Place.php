<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'phone',
        'email',
        'cnpj',
        'zipcode',
        'address',
        'number',
        'complement',
        'district',
        'city',
        'state',
        'active',
    ];

    public function destiny()
    {
        return $this->belongsTo(Destiny::class);
    }

    public function cashiers()
    {
        return $this->hasMany(Cashier::class);
    }

}
