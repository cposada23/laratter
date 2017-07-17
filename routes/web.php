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

Route::get('/', 'PagesController@home');

// Route::resource('/messages','MessagesController');




Auth::routes();
Route::get('/auth/facebook', 'SocialAuthController@facebook');
Route::get('/auth/facebook/callback', 'SocialAuthController@callback');
Route::post('/auth/facebook/register', 'SocialAuthController@register');

// Esta se puede agrupar
// Route::post('/messages', 'MessagesController@store')->middleware('auth');
Route::get('/messages/search', 'MessagesController@search');
Route::get('/messages/{message}', 'MessagesController@show');
Route::group(['middleware'=>'auth'], function(){
  Route::post('/{username}/dms', 'UsersController@sendPrivateMessage');
  Route::post('{username}/follow', 'UsersController@follow');
  Route::post('{username}/unfollow', 'UsersController@unfollow');
  Route::post('/messages', 'MessagesController@store');
  Route::get('/conversations/{conversation}', 'UsersController@showConversation');
});


Route::get('/{username}/follows', 'UsersController@follows');
Route::get('/{username}/followers', 'UsersController@followers');

Route::get('/{username}', 'UsersController@show');
