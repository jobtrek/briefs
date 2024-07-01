<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalEvaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'teamwork',
        'punctuality',
        'reactivity',
        'communication',
        'problem_solving',
        'adaptability',
        'innovation',
        'professionalism',
        'commentaire',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function professionalEvaluations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProfessionalEvaluation::class);
    }
}
