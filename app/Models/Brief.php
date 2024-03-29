<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Brief extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brief_branch_id',
        'brief_level_id'
    ];

    public function briefLevel(): BelongsTo
    {
        return $this->belongsTo(BriefLevel::class);
    }

    public function briefBranch(): BelongsTo
    {
        return $this->belongsTo(BriefBranch::class);
    }
}
