<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'place_id',
        'user_id',
        'status',
    ];

    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cashMovements()
    {
        return $this->hasMany(CashMovement::class, 'cashier_id');
    }

    public function amount()
    {
        return $this->cashMovements()->where('type', 'in')->sum('value') - $this->cashMovements()->where('type', 'out')->sum('value');
    }
}
