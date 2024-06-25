<?php

namespace App\Models;

use App\Enums\BriefStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BriefRealisation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'brief_id',
        'date_debut',
        'date_fin',
        'status',
    ];

    protected static function booted(): void
    {
        static::creating(function ($briefRealisation) {
            $briefRealisation->status = 'new';
        });

        static::saving(function ($briefRealisation) {
            if (now()->gt($briefRealisation->date_fin) && $briefRealisation->status !== 'delivered') {
                $briefRealisation->status = 'undelivered';
            }
        });
    }

    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
        'status' => BriefStatus::class,
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function brief(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brief::class);
    }
}
