<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTemplateController;
use App\Http\Controllers\UserTemplateSectionController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('/auth/login', 'login');
    Route::post('/auth/register', 'register');
    Route::post('/auth/logout', 'logout')->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/users/me', 'me');
    });

    Route::resource('user-templates', UserTemplateController::class);
    Route::resource('user-template-sections', UserTemplateSectionController::class)->only((['show', 'update']));
});

Route::resource('templates', TemplateController::class)->only(['index', 'show']);
