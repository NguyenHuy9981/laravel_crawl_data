<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', 'HomeController@home')->name('home');

Route::get('/index', 'HomeController@index')->name('index')->middleware('role');

Route::post('/checkSubmit', 'HomeController@checkSubmit')->name('checkSubmit');

Route::get('/listuser', 'HomeController@listuser')->name('listUser');

Route::get('/403', function () {
    return view('403');
})->name('403');

/// Crawl
Route::get('/crawlForm', 'CrawlController@crawlForm')->name('news.crawlForm');

Route::post('/crawl', 'CrawlController@crawl')->name('news.crawl');