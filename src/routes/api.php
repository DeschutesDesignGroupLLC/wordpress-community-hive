<?php

use WordpressPluginTemplate\App\Http\Controllers\Api\PostsController;
use Illuminate\Support\Facades\Route;

Route::get('/posts', [PostsController::class, 'index']);