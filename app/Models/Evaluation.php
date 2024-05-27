<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_evaluation',
        'commentaire_general_mandat',
        'brief_id',
        'user_id',
    ];

    public function evaluation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function criteria(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EvaluationCriteria::class);
    }
}
