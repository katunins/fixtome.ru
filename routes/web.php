<?php

use App\Http\Controllers\SearchController;
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

Route::get('/', function () {
        return view('welcome');
});

Route::get('/newResearch', function () {
    return view('newresearch');
});

Route::get('/newOrder', function () {
    return view('neworder');
});

Route::post('/newResearch', [SearchController::class, 'newResearch']);

Route::get('/research/{token}', function ($token) {
    return SearchController::getResearch($token); 
});

Route::post('/setLike', [SearchController::class, 'setLike']);
Route::post('/research/newTweet', [SearchController::class, 'newTweet']);
