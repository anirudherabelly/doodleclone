<?php

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
    return view('pages.welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/about', function () {
    return view('pages.about');
});
// Route::get('/createevent', function () {
//     return view('pages.createevent');
// });

Route::resource('events','EventController');
Route::get('/participant/create','ParticipantController@index')->name('participant.show');
Route::post('/participant/create','ParticipantController@createParticipant')->name('participant.create');
// Route::get('/timeslot/create','TimeSlotController@index')->name('timeslot.show');
// Route::post('/timeslot/create','TimeSlotController@createTimeSlot')->name('timeslot.store');
// Route::get('/events', 'HomeController@index')->name('home');
