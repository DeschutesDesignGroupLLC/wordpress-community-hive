<?php

use CommunityHive\App\Http\Controllers\ApiController;
use CommunityHive\App\Http\Middleware\AuthenticateJwt;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'community-hive'], function () {
    Route::post('', [ApiController::class, 'index'])->middleware(AuthenticateJwt::class)->name('api.index');
    Route::get('', [ApiController::class, 'show'])->name('api.show');
});

Route::fallback(function () {
    return response()->json([
        'error' => 'The requested API endpoint was not found.',
    ]);
});
