<?php

// app/Models/BriefRealisation.php

namespace App\Models;

use App\Enums\BriefStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

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
    public static function booted()
    {
        static::creating(function ($model) {
            $model->validateUniqueBriefUser();
        });

        static::updating(function ($model) {
            $model->validateUniqueBriefUser();
        });
    }

    protected function validateUniqueBriefUser()
    {
        $this->validate([
            'brief_id' => [
                'required',
                Rule::unique('brief_realisations')->where(function ($query) {
                    return $query->where('user_id', $this->user_id);
                }),
            ],
        ], [
            'brief_id.unique' => 'Ce brief a déjà été associé à cet utilisateur.',
        ]);
    }
}
