<?php

// app/Models/BriefRealisation.php

namespace App\Models;

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
