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
        'brief_id',

    ];

    public function brief(): BelongsTo
    {
        return $this->belongsTo(Brief::class);
    }
    public function evaluationCriteria(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Evaluation_Criteria::class, 'id_criteria');
    }
}
