<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivedCase extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_num',
        'case_snapshot',
        'archived_by',
        'archived_reason',
        'archived_at',
    ];

    protected $casts = [
        'case_snapshot' => 'array',
        'archived_at' => 'datetime',
    ];

    public function archiver()
    {
        return $this->belongsTo(User::class, 'archived_by');
    }
}
