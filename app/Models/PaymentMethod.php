<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
    ];

    public function cashMovements()
    {
        return $this->hasMany(CashMovement::class);
    }

    public function getNameAttribute($value)
    {
        return $value;
    }
}
