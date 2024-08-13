<?php

use App\Livewire\Recipe;
use App\Livewire\Dashboard;
use App\Livewire\Auth\Login;
use App\Livewire\Recipe\Edit;
use App\Livewire\Recipe\Index;
use App\Livewire\Auth\Register;
use App\Livewire\Recipe\Create;
use Illuminate\Support\Facades\Route;

Route::get('/', Dashboard::class)->name('home');
Route::get('/recipes', Index::class)->name('index');
Route::get('/create-recipe',Create::class)->name('create')->middleware('auth');
Route::get('/edit/{id}', Edit::class)->name('recipe.edit');

Route::get('/register',Register::class);
Route::get('/login',Login::class)->name('login');

Route::get('/about',function(){
    return view('components.about-us');
});



