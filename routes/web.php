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
    return view('welcome');
});
Route::get('login/google', 'SocialLoginController@redirectToProvider');
Route::get('login/google/callback', 'SocialLoginController@handleProviderCallback');
Route::get('/home', function() {
    return 'Hello';
});
Route::get('/profile', function (){
    if(Auth::user())
    {
       $user = Auth::user();
       return $user;
    }
    else{
        return "login agian";
    }
});
Route::get('/logout', function (){
    $user = Auth::logout();
    echo $user;
});
