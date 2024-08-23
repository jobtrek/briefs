<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    /**
     * Récupère les critères associés à un utilisateur spécifique.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCriterias(User $user)
    {
        // Charge la relation "criterias" du modèle User
        $criterias = $user->criterias()->get(['id', 'description']);

        return response()->json($criterias);
    }


}
