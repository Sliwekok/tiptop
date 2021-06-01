<?php

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {

    Route::get('/', 'AdminController@dashboardView');

    Route::prefix('users')->group(function () {
        Route::get('/', 'AdminUsersController@listView');
    });

});