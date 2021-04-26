<?php

use App\Http\Controllers\API\SchoolController;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => ['message' => Inspiring::quote()]);
Route::resource('schools', SchoolController::class)->only('index');
