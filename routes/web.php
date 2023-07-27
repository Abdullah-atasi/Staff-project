<?php

use App\Http\Controllers\JobsController;
use Illuminate\Support\Facades\Auth;
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
Route::get('jobs',[JobsController::class,'index'])->name('index');
Route::get('/create',[JobsController::class,'create'])->name('createjob');
Route::post('store',[JobsController::class,'store'])->name('storejob');
Route::get('edit/{id}',[JobsController::class,'edit'])->name('editjob');
Route::post('update/{id}',[JobsController::class,'update'])->name('updatejob');
Route::get('delete/{id}',[JobsController::class,'destroy'])->name('deltejob');
Route::post('search',[JobsController::class,'ajax_search'])->name('ajax_search_job');
Route::get('languageConverter/{locale}',function($locale){
    // if(is_array($locale,['ar','en'])){
        session()->put('locale',$locale);
    // }
    return redirect()->back();
})->name('languageConverter');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
