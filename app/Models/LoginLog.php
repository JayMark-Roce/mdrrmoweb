<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_type',
        'user_id',
        'email',
        'name',
        'ip_address',
        'user_agent',
        'login_at',
        'success',
        'failure_reason',
    ];

    protected $casts = [
        'login_at' => 'datetime',
        'success' => 'boolean',
    ];

    public function user()
    {
        if ($this->user_type === 'admin') {
            return $this->belongsTo(User::class, 'user_id');
        }
        return null;
    }

    public function driver()
    {
        if ($this->user_type === 'driver') {
            return $this->belongsTo(Driver::class, 'user_id');
        }
        return null;
    }
}
