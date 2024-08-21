<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get("/", [HomeController::class, "index"])->name("home");
Route::get("/create", [HomeController::class, "create"])->name("create");
Route::post("/store", [HomeController::class, "store"])->name("store");
Route::get("/{id}/edit", [HomeController::class, "edit"])->name("edit");
Route::put("/{id}/update", [HomeController::class, "update"])->name("update");
Route::delete("/{id}/delete", [HomeController::class, "delete"])->name("delete");

Route::get("/audio/duration", [HomeController::class, "audio_duration"])->name("audio_duration");
Route::get("/location/distance", [HomeController::class, "location_distance"])->name("location_distance");
Route::get("/download/csv", [HomeController::class, "download_csv"])->name("download_csv");
