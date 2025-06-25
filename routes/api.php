<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AccessTokenController;

Route::post('/oauth/token', [AccessTokenController::class, 'issueToken'])->name('passport.token');


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

