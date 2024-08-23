<?php

use App\Filament\pages\Dashboard;
use App\Http\Controllers\CriteriaController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\PublicBriefController;
use App\Filament\Pages\PublicBriefs;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/





//Route::get('/', [\App\Http\Controllers\WelcomeController::class, 'index']);

Route::get('/', PublicBriefs::class);

Route::get('/users/{user}/criterias', [CriteriaController::class, 'getCriterias']);


Route::get('/login/azure/redirect', function () {
    return Socialite::driver('azure')->redirect();
});

Route::get('/login/azure/callback', function () {
    $user = Socialite::driver('azure')->user();
});

