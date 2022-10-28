<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'value',
        'payment_method_id',
        'pay_on_delivery',
        'weight',
        'width',
        'height',
        'length',
        'observations',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function getVolumeAttribute()
    {
        return $this->width * $this->height * $this->length / 1000;
    }

}
