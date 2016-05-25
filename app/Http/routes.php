<?php

Route::resource('/', 'UserController');

// API
Route::get('/api/users', function(){
    return App\User::latest()->get();
});

Route::post('/api/users', function() {
    return App\User::create(Request::all());
});

Route::get('/api/users/{id}', function ($id) {
    return App\User::findOrFail($id);
});

Route::patch('/api/users/{id}', function ($id) {
    // dd("ini patch");
    App\User::findOrFail($id)->update(Request::all());
    return Response::json(Request::all());
});
