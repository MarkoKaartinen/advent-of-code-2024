<?php

use App\Livewire\Home;
use App\Livewire\ShowDay;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/day/{day}', ShowDay::class)->name('day');
