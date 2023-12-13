<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;


Route::get('/', function () {
    return view('layouts.dashboard');
});

require __DIR__.'/auth.php';