<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminInvite extends Model
{
    protected $fillable = ['token', 'used', 'expires_at'];

    protected $casts = [
        'expires_at' => 'datetime',
        'used' => 'boolean',
    ];

    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    public function isValid(): bool
    {
        return !$this->used && !$this->isExpired();
    }
}
