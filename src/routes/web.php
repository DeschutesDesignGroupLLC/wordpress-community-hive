<?php

use CommunityHive\App\Http\Controllers\FollowController;
use CommunityHive\App\Http\Controllers\SettingsController;
use CommunityHive\App\Http\Middleware\AuthenticateAdmin;
use CommunityHive\App\Http\Middleware\AuthenticateUser;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'community-hive'], function () {
    Route::group(['prefix' => 'admin', 'middleware' => [ConvertEmptyStringsToNull::class, AuthenticateAdmin::class]], function () {
        Route::post('activate', [SettingsController::class, 'index'])->name('settings.index');
        Route::post('settings', [SettingsController::class, 'store'])->name('settings.store');
    });

    Route::get('follow/{action?}', [FollowController::class, 'index'])->name('follow.index');
    Route::post('follow', [FollowController::class, 'store'])->middleware(AuthenticateUser::class)->name('follow.store');
});
