<?php

use App\Models\Pet;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'users' => User::all(),
        'petQuantity' => Pet::has('user')->count(),
    ]);
});
