<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/new-request', function () {
    return view('new-request');
})->name('new.request');

Route::get('/assessment-request', function () {
    return view('assessment-request');
})->name('assessment.request');