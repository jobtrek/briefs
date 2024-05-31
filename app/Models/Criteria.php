<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'brief_id',
    ];

    public function brief(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brief::class);
    }

}
