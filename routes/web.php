<?php

use App\Http\Controllers\Admin\ManageCompanies;
use App\Http\Controllers\Admin\ManageEmployees;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);

Route::resource('companies', ManageCompanies::class);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('employees', ManageEmployees::class);
