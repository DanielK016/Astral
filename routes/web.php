<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Game\MenuController;
use App\Http\Controllers\Game\NewGameController;
use App\Http\Controllers\Game\GameController;
use App\Http\Controllers\Game\GameApiController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\GalaxyController as AdminGalaxyController;
use App\Http\Controllers\Admin\StarSystemController as AdminStarSystemController;
use App\Http\Controllers\Admin\PlanetController as AdminPlanetController;
use App\Http\Controllers\Admin\HyperlaneController as AdminHyperlaneController;
use App\Http\Controllers\Admin\RaceController as AdminRaceController;

Route::get('/', [MenuController::class, 'menu'])->name('menu');
Route::get('/continue', [MenuController::class, 'continue'])->name('continue');
Route::post('/continue/{session}/load', [MenuController::class, 'load'])->name('continue.load');
Route::get('/settings', [MenuController::class, 'settings'])->name('settings');

Route::prefix('new-game')->group(function () {
    Route::get('/difficulty', [NewGameController::class, 'difficulty'])->name('newgame.difficulty');
    Route::post('/difficulty', [NewGameController::class, 'storeDifficulty'])->name('newgame.difficulty.store');

    Route::get('/race', [NewGameController::class, 'race'])->name('newgame.race');
    Route::post('/race', [NewGameController::class, 'storeRace'])->name('newgame.race.store');

    Route::get('/configure', [NewGameController::class, 'configure'])->name('newgame.configure');
    Route::post('/configure', [NewGameController::class, 'storeConfigure'])->name('newgame.configure.store');

    Route::get('/generate', [NewGameController::class, 'generating'])->name('newgame.generate');
    Route::post('/generate/run', [NewGameController::class, 'runGenerate'])->name('newgame.generate.run');
});

Route::prefix('game')->group(function () {
    Route::get('/session/{session}', [GameController::class, 'galaxy'])->name('game.galaxy');
    Route::post('/session/{session}/end-turn', [GameController::class, 'endTurn'])->name('game.endTurn');

    Route::get('/session/{session}/system/{system}', [GameController::class, 'system'])->name('game.system');

    Route::post('/session/{session}/research', [GameController::class, 'selectResearch'])->name('game.research.select');
    Route::post('/session/{session}/planet/{planet}/build', [GameController::class, 'build'])->name('game.planet.build');
    Route::post('/session/{session}/fleet/{fleet}/move', [GameController::class, 'orderFleetMove'])->name('game.fleet.move');
    Route::post('/session/{session}/fleet/{fleet}/planet-move', [GameController::class, 'moveFleetToPlanet'])->name('game.fleet.planet.move');
    Route::post('/session/{session}/fleet/{fleet}/survey', [GameController::class, 'orderFleetSurvey'])->name('game.fleet.survey');
    Route::post('/session/{session}/system/{system}/claim', [GameController::class, 'claimSystem'])->name('game.system.claim');

    Route::post('/session/{session}/diplomacy/{other}/contact', [GameController::class, 'diplomacyContact'])->name('game.diplomacy.contact');
    Route::post('/session/{session}/diplomacy/{other}/war', [GameController::class, 'diplomacyWar'])->name('game.diplomacy.war');
    Route::post('/session/{session}/diplomacy/{other}/peace', [GameController::class, 'diplomacyPeace'])->name('game.diplomacy.peace');

    Route::post('/session/{session}/encounter/{encounter}/peace', [GameController::class, 'encounterPeace'])->name('game.encounter.peace');
    Route::post('/session/{session}/encounter/{encounter}/war', [GameController::class, 'encounterWar'])->name('game.encounter.war');

    Route::get('/api/session/{session}/galaxy', [GameApiController::class, 'galaxy'])->name('game.api.galaxy');
    Route::get('/api/session/{session}/system/{system}', [GameApiController::class, 'system'])->name('game.api.system');
    Route::get('/api/session/{session}/planet/{planet}', [GameApiController::class, 'planet'])->name('game.api.planet');
    Route::post('/api/session/{session}/galaxy/move-fleets', [GameApiController::class, 'moveFleets'])->name('game.api.galaxy.moveFleets');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('galaxies', AdminGalaxyController::class);
    Route::resource('star-systems', AdminStarSystemController::class);
    Route::resource('planets', AdminPlanetController::class);
    Route::resource('hyperlanes', AdminHyperlaneController::class);
    Route::resource('races', AdminRaceController::class);
});

