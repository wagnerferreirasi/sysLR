<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'user_id',
        'place_id',
        'destiny_id',
        'client_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function destiny()
    {
        return $this->belongsTo(Destiny::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function detail()
    {
        return $this->hasOne(PackageItem::class);
    }

    public function getVolumeAttribute()
    {
        return $this->detail->volume;
    }

}
