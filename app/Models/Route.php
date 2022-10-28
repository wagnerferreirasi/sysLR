<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        'place_id',
        'destiny_id',
        'price1',
        'price2',
        'price3',
        'status',
    ];

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function destiny()
    {
        return $this->belongsTo(Destiny::class);
    }

    public function scopeStatus($query)
    {
        return $query->where('status', true);
    }

    public function getDestinyNameAttribute()
    {
        return $this->destiny->name;
    }

    public function getPlaceNameAttribute()
    {
        return $this->place->name;
    }

    public function getPrice1Attribute($value)
    {
        return $value;
    }

    public function getPrice2Attribute($value)
    {
        return $value;
    }

    public function getPrice3Attribute($value)
    {
        return $value;
    }
}
