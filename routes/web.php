<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DeckController;
use App\Http\Controllers\CardController;





Route::get('/', function () {
    return view('login');
});

// Route::get('/admin/dashboard', function () {
//     return view('dashboard');
// });
Route::get('api/users', [UserController::class, 'index']);

Route::post('api/addDummyUser', [UserController::class, 'insert']);
Route::post('api/deleteDummyUser', [UserController::class, 'deleteByEmail']);

// Show login form
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

// Handle login form submission
Route::post('login', [LoginController::class, 'login']);

Route::get('/api/getAuth', function () {
    return Auth::user();
})->middleware('auth');

Route::get('api/decks', [DeckController::class, 'getDecksByID']);
Route::get('api/getDeck', [DeckController::class, 'getDeckByDeckID']);

Route::post('api/addDeck', [DeckController::class, 'insertDeck']);
Route::post('api/deleteDeck', [DeckController::class, 'deleteDeckById']);


Route::get('api/cards', [CardController::class, 'getCardsByDeckId']);
Route::post('api/addCard', [CardController::class, 'insertCard']);
Route::post('api/deleteCard', [CardController::class, 'deleteCardById']);




Route::get('{view}', ApplicationController::class)->where('view', '(.*)');
