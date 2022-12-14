<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix("admin")->group(function () {
    Route::get("/login", [Admin::class, 'login'])->name('admin-login');
    Route::post("/auth", [Admin::class, 'auth'])->name('admin-auth');
    Route::get("/home", [Admin::class, 'home'])->name('admin-home');
    Route::get("/logout", [Admin::class, 'logout'])->name('admin-logout');
    Route::get("/registrar", [Admin::class, 'registrar'])->name('admin-registrar');
    Route::post('/store', [Admin::class, 'store'])->name('admin-store');
    Route::get('/requisicao', [Admin::class, 'requisicao'])->name('admin-requisicao');
    Route::post('/requisicao-store', [Admin::class, 'requisicao_store'])->name('admin-requisicao-store');
    Route::put('/requisicao-update/{id}', [Admin::class, 'requisicao_update'])->where('id', '[0-9]+')->name('admin-requisicao-update');
    Route::get('/produto-simples', [Admin::class, 'produto_simples_create'])->name('admin-produto-simples');
    Route::post('/produto-simples-store', [Admin::class, 'produto_simples_store'])->name('admin-produto-simples-store');
    Route::put('/produto-simples-update/{id}', [Admin::class, 'produto_simples_update'])->where('id', '[0-9]+')->name('admin-produto-simples-update');
    Route::delete('/produto-simples-delete/{id}', [Admin::class, 'produto_simples_delete'])->where('id', '[0-9]+')->name('admin-produto-simples-delete');
    Route::get('/produto-simples-att/{id}', [Admin::class, 'produto_simples_att'])->where('id', '[0-9]+')->name('admin-produto-simples-att');
    Route::put('/produto-simples-update-dados/{id}', [Admin::class, 'produto_simples_update_dados'])->where('id', '[0-9]+')->name('admin-produto-simples-update-dados');
    Route::get('/relatorios', [Admin::class, 'admin_relatorios'])->name('admin-relatorios');
    Route::post('/relatorio-pdf', [Admin::class, 'admin_relatorio_pdf'])->name('admin-relatorio-pdf');
});

Route::fallback(function () {
    return "ERRO 404";
});
