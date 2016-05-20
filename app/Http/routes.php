<?php

Route::resource('/', 'UserController');

// API
Route::get('/api/users', function(){
    return App\User::all();
});
