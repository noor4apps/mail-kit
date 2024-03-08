<?php

use App\Http\Api\Subscriber\CreateSubscriberController;
use Illuminate\Support\Facades\Route;

Route::middleware(['api', 'auth:sanctum'])->group(function () {
    Route::post('subscribers', CreateSubscriberController::class);
});
