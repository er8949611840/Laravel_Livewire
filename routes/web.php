<?php

use App\Http\Livewire\CreatePage;
use App\Http\Livewire\Pages;
use App\Http\Livewire\ShowPage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', Pages::class)->name('get.page');
Route::get('/{slug}/{child?}/{subchild?}', ShowPage::class)->name('show.page');

// Page CRUD
Route::get('/crm/admin/create/page', CreatePage::class)->name('create.page');
