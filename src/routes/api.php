<?php

use CommunityHive\App\Http\Controllers\Api\PostsController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'community-hive'], function () {
    Route::get('/posts', [PostsController::class, 'index']);
});
