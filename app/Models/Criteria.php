<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Criteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'evaluation',
        'brief_id',
        'commentaire',
        "evaluation_criteria_id"

    ];

    public function brief(): BelongsTo
    {
        return $this->belongsTo(Brief::class);
    }
    public function evaluationCriteria(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(evaluationCriteria::class, 'id_criteria');
    }

    public function Evaluation(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Evaluation::class, 'criteria_id');
    }
}
