<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class Password extends Model
{
    use HasFactory;

    protected $table = 'password';

    protected $fillable = [
        'password',
        'expiration_date',
        'status'
    ];

    protected $casts = [
        'expiration_date' => 'datetime'
    ];

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeUsed($query)
    {
        return $query->where('status', 'used');
    }

    public function scopeExpired($query)
    {
        return $query->where('status', 'expired');
    }

    public function checkPassword(string $password): bool
    {
        return $this->password === $password;
    }

}
