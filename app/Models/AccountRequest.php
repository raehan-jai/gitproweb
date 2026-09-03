<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'jabatan',
        'alasan',
        'status',
        'catatan_admin',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $hidden = ['password'];

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }
}