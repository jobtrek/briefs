<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_evaluation',
        'brief_id',
        'criteria_id',
        'user_id',
        'note',
        'note_max',
        'commentaire_general_mandat',
    ];
    private mixed $criteria;

    protected static function booted(): void
    {
        static::created(function ($evaluation) {
            DB::table('evaluation_criterias')->insert([
                'criteria_id' => $evaluation->criteria_id,
                'note' => $evaluation->note,
                'note_max' => $evaluation->note_max,
                'commentaire' => $evaluation->commentaire_general_mandat,
                'updated_at' => now(),
            ]);
        });
    }

    public function brief(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brief::class);
    }

    public function criteria(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Criteria::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getCriteriaDescriptionAttribute()
    {
        return optional($this->criteria)->description;
    }
}
