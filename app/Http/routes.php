<?php

Route::resource('/', 'UserController');

// API
Route::get('/api/users', function(){
    return App\User::all();
});

Route::post('/api/users/', function() {
    // dd(Request::all());
    return App\User::create(Request::all());
});
