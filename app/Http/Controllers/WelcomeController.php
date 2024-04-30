<?php

namespace App\Http\Controllers;

use App\Models\Brief;

class WelcomeController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $briefs = Brief::with('briefBranch', 'briefLevel')->get();
        //dd(compact('briefs'));
        return view('welcome', compact('briefs'));
    }
}
