<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\ClientController;


/*
Route::get('/', function () {
    return view('welcome');
});
*/

//// HOME

Route::get('/', [DefaultController::class, 'home'])->name('home');
Route::get('/withoutCookie', [DefaultController::class, 'withoutCookie'])->name('withoutCookie');
Route::get('/withoutCerca', [DefaultController::class, 'withoutCerca'])->name('withoutCerca');

//// COMPTES

Route::get('/compte/list', [CompteController::class, 'list'])->name('compte_list');

Route::get('/compte/search', [CompteController::class, 'search'])->name('compte_cerca');

Route::match(['get', 'post'], '/compte/new', [CompteController::class, 'new'])->name('compte_new')->middleware('auth');;

Route::get('/compte/delete/{id}', [CompteController::class, 'delete'])->name('compte_delete')->middleware('auth');;

Route::match(['get', 'post'], '/compte/edit{id}', [CompteController::class, 'edit'])->name('compte_edit')->middleware('auth');;

Route::match(['get', 'post'], '/compte/maximSaldo', [CompteController::class, 'maximSaldo'])->name('estadistiques_list');

//// CLIENTS

Route::get('/client/list', [ClientController::class, 'list'])->name('client_list');

Route::match(['get', 'post'], '/client/new', [ClientController::class, 'new'])->name('client_new')->middleware('auth');;

Route::get('/client/delete/{id}', [ClientController::class, 'delete'])->name('client_delete')->middleware('auth');;

Route::match(['get', 'post'], '/client/edit{id}', [ClientController::class, 'edit'])->name('client_edit')->middleware('auth');;
