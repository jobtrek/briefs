<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_evaluation',
        'brief_id',
        'criteria_id',
        'user',
        'commentaire_general_mandat',
    ];
    private mixed $criteria;

    public function brief(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brief::class);
    }

    public function criteria(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Criteria::class);
    }

    public function evaluationCriteria(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EvaluationCriteria::class);
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

