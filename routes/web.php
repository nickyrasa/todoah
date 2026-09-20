<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/', 'dashboard')->name('dashboard');
Route::livewire('/routines', 'routines-projects')->name('routines');
Route::livewire('/groupe', 'groupe-view')->name('groupe');
