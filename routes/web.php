<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dbcheck', function () {
    return config('database.connections.mysql');
});
