<?php

namespace App\Http\Controllers;

use App\Models\Brief;
use App\Filament\Resources\BrieffResource;
class PublicBriefController
{


    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $briefs = Brief::with('briefBranch', 'briefLevel')->get();
        return view('filament.pages.public-briefs');
    }


}
