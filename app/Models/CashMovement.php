<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'cashier_id',
        'user_id',
        'payment_method_id',
        'type',
        'value',
        'description',
    ];

    public function cashier()
    {
        return $this->belongsTo(Cashier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function getTypeAttribute($value)
    {
        return $value === 'in' ? 'Entrada' : 'Saída';
    }

    public function getValueAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }
}
