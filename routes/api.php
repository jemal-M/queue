<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\ServiceController;
use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/auth')->group(function (){
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[Authcontroller::class,'login']);

});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout',[Authcontroller::class,'logout']);
    Route::get('/me',[Authcontroller::class,'me']);

    // 

});

Route::middleware(['auth:sanctum','permission:manage-organizations'])->apiResource('organizations',OrganizationController::class);
Route::middleware(['auth:sanctum','permission:manage-services'])->apiResource('services',ServiceController::class);
Route::middleware(['auth:sanctum','permission:manage-appointments'])->apiResource('appointments',AppointmentController::class);
Route::middleware(['auth:sanctum','permission:manage-queues'])->group(function (){
    Route::get('/queues',[QueueController::class,'index']);
    Route::post('queue/{id}/call',[QueueController::class,'callNext']);
    Route::post('/queues/{id}/complete',[QueueController::class,'complete']);
});

Route::middleware('auth:sanctum')->group(function(){
Route::post('/feedback',[FeedbackController::class,'store']);
});

Route::middleware(['auth:sanctum','permission:view-dashboard'])->group(function(){
Route::get('/dashboard',[FeedbackController::class,'store']);
});