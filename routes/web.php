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
/* * ******For Language Switcher ******* */

Route::get('/lang/{lang?}', [
    'uses' => 'LangSwitcherController@LangSwitcher',
    'as' => 'lang.switch'
]);

/* * ******For Language Switcher ******* */
     

Route::get('/', function () {
    return view('home');
});
Route::get('/home', function () {
    return view('home');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/faq', function () {
    return view('faq');
});
Route::get('/feedback', function () {
    return view('feedback');
});
Route::get('/blog', function () {
    return view('blog');
});
Route::get('/contact', function () {
    return view('contact');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
