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
/* * ******For Language Switcher start******* */

Route::get('/lang/{lang?}', [
    'uses' => 'LangSwitcherController@LangSwitcher',
    'as' => 'lang.switch'
]);

/* * ******For Language Switcher end******* */


Route::get('glogin', array('as' => 'glogin', 'uses' => 'UserController@googleLogin'));
Route::post('upload-file', array('as' => 'upload-file', 'uses' => 'UserController@uploadFileUsingAccessToken'));

Route::get('/video-search', [
    'uses' => 'VideoController@VideoSearch',
    'as' => 'video.search'
]);
Route::get('/video-playlist-card', [
    'uses' => 'VideoController@videoPlaylistBYCard',
    'as' => 'video.playlist.card'
]);

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

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
Route::get('/terms', function () {
    return view('terms-of-use');
});
Route::get('/privacy-policy', function () {
    return view('privacy-policy');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test', 'HomeController@test');

Route::get('checksubtitle', 'VideoController@checksubtitle');
Route::post('subtitleDownload', 'VideoController@subtitleDownload');
Route::post('dualSubtitleDownload', 'VideoController@dualSubtitleDownload');
