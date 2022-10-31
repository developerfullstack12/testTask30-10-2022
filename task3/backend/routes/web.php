<?php

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

/*
* This routes fetching records from the given url (https://randomuser.me/api/) and insert into the database
*/

Route::get('/insertRecords', 'DatabaseRecordsController@insertRecords')->name('insertRecords');

