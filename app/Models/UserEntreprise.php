<?php
// app/Models/BriefRealisation.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEntreprise extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'entreprise_id',
    ];

}
