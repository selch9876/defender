<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\FightController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\MageSpellController;
use App\Http\Controllers\PlayerClassController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

/* Route::get('/fight', function () {
    return view('game.fight')->name('fight');
}); */

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::resource('/game', GameController::class);
Route::resource('/character', CharacterController::class);
Route::resource('/player-class', PlayerClassController::class);
Route::resource('/mage-spell', MageSpellController::class);

Route::middleware('auth')->post('/select-character', [CharacterController::class, 'select'])->name('select-character');


// Game Routes
Route::get('/fight', [FightController::class, 'fight'] )->name('fight');
Route::post('/attack', [FightController::class, 'attack'] )->name('fight.attack');
Route::post('/defend', [FightController::class, 'defend'] )->name('fight.defend');
Route::post('/heal', [FightController::class, 'heal'] )->name('fight.heal');
Route::post('/run', [FightController::class, 'run'] )->name('fight.run');
Route::post('/cast', [FightController::class, 'cast'] )->name('fight.cast');
Route::post('/start-game', [GameController::class, 'startGame'])->name('start-game');
Route::get('/win/{id}', [FightController::class, 'win'])->name('win');

//Shop Routes
//Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::post('/shop/buy', [ShopController::class, 'buy'])->name('shop.buy');
Route::post('/shop/sell', [ShopController::class, 'sell'])->name('shop.sell');
Route::middleware(['auth', 'characterselected'])->get('/shop', [ShopController::class, 'index'])->name('shop');



