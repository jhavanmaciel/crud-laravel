<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PessoaController;
 
Route::get('/', function () {
    return view('crud');
});
    
Route::get('pessoas', [PessoaController::class, 'index'])->name('pessoas.index');
Route::post('pessoas/store', [PessoaController::class, 'store'])->name('pessoas.store');
Route::get('pessoas/edit/{id}/', [PessoaController::class, 'edit']);
Route::post('pessoas/update', [PessoaController::class, 'update'])->name('pessoas.update');
Route::get('pessoas/destroy/{id}/', [PessoaController::class, 'destroy']);