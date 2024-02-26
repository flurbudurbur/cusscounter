<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

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

Route::get('/', [Controller::class, 'index']);
Route::get('/add', function () {
    (new Controller)->increment();
    return redirect('/')->with('undo', true);
});
Route::get('/min', function () {
    (new Controller)->decrement();
    return redirect('/')->with('undo', false);
});