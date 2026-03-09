<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'hardware_item_id',
        'status',
        'rejection_reason',
        'requested_at',
        'approved_at',
        'rejected_at',
        'borrowed_at',
        'expected_return_date',
        'returned_at',
    ];

    protected function casts(): array
    {
        return [
            'requested_at' => 'datetime',
            'approved_at' => 'datetime',
            'rejected_at' => 'datetime',
            'borrowed_at' => 'datetime',
            'expected_return_date' => 'date',
            'returned_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function hardwareItem(): BelongsTo
    {
        return $this->belongsTo(HardwareItem::class);
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isOverdue(): bool
    {
        return $this->status === 'borrowed'
            && $this->expected_return_date
            && $this->expected_return_date->isPast();
    }
}
