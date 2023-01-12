<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sender extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'document',
        'phone',
        'email',
    ];

    public function package()
    {
        return $this->hasMany(Package::class);
    }
}
