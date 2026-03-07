<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('phpversion', function () {
    return phpinfo();
});

Route::get('/tally', function () {
    return view('tally');
})->name('tally');