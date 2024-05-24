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
    public function evaluationCriteria(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EvaluationCriteria::class, 'criteria_id');
    }
    public function getAverageNoteAttribute(): float|int
    {
        $evaluationCriterias = $this->evaluationCriteria()->get();
        $totalNotes = $evaluationCriterias->sum('note');
        $totalMaxNotes = $evaluationCriterias->sum('note_max');

        if ($totalMaxNotes > 0) {
            return round(($totalNotes / $totalMaxNotes) * 100, 2);
        }

        return 0;
    }
}
