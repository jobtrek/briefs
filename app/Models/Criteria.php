<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Criteria extends Model
{
    protected $fillable = [
        'name',
        'description',
        'brief_id',
    ];

    public function brief(): BelongsTo
    {
        return $this->belongsTo(Brief::class);
    }
}
