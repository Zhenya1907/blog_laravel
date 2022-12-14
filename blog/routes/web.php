<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
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


Route::get('/main', [ArticleController::class, 'index'])->name('index');
Route::get('/pagination', [ArticleController::class, 'ajaxPagination'])->name('pagination');
Route::get('/{article}', [ArticleController::class, 'article'])->name('show_one_article');
Route::post('/{article}/comments', [ArticleController::class, 'pushComment'])->name('add_comment');
