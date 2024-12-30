<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ChatController::class,'index'])->name('user.login');
Route::post('/broadcast', [ChatController::class,'broadcastChat'])->name('broadcast.chat');
Route::get('/chat', [ChatController::class,'notFound'])->name('no.chat');
Route::post('/chat', [ChatController::class,'chat'])->name('chat');
