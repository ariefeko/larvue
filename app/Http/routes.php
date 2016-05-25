<?php

Route::resource('/', 'UserController');

// API
Route::group(['prefix' => '/api/users'], function () {

    Route::match(['GET', 'POST'], '/', function () {
        if(Request::isMethod('GET')){
            return App\User::latest()->get();
        }else{
            return App\User::create(Request::all());
        }
    });

    Route::match(['GET', 'PATCH', 'DELETE'], '/{id}', function ($id) {
        if(Request::isMethod('GET')){
            return App\User::findOrFail($id);
        }elseif(Request::isMethod('PATCH')){
            App\User::findOrFail($id)->update(Request::all());
            return Response::json(Request::all());
        }else{
            App\User::findOrFail($id)->delete();
        }
    });
});
