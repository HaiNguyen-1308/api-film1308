<?php
Route::get('/', 'Admins\AdminController@index')->name('getHome');

Route::prefix('/ad')->group(function () {

    Route::get('/login', 'Admins\AdminController@getLogin')->name('adgetLogin');
    Route::post('/login', 'Admins\AdminController@postLogin')->name('adpostLogin');

    Route::middleware(['check_admin'])->group(function () {
        // Home
        Route::get('/', 'Admins\AdminController@getHome')->name('adgetHome');
        Route::get('/logout', 'Admins\AdminController@getLogout')->name('adgetLogout');

        // FilmCates
        Route::prefix('/film-cate')->group(function () {
            Route::get('/list/{page?}/{query?}', 'Admins\FilmCategoryController@index')->name('adgetListFilmCate');

            Route::get('/add', 'Admins\FilmCategoryController@getAddFilmCate')->name('adgetAddFilmCate');
            Route::post('/add', 'Admins\FilmCategoryController@postAddFilmCate')->name('adpostAddFilmCate');

            Route::get('/edit/{id}', 'Admins\FilmCategoryController@getEditFilmCate')->name('adgetEditFilmCate');
            Route::post('/edit/{id}', 'Admins\FilmCategoryController@postEditFilmCate')->name('adpostEditFilmCate');

            Route::get('/del/{id}', 'Admins\FilmCategoryController@getDelFilmCate')->name('adgetDelFilmCate');
        });

        // Users
        Route::prefix('/user')->group(function () {
            Route::get('/list/{page?}/{query?}', 'Admins\UserController@index')->name('adgetListUser');

            Route::get('/add', 'Admins\UserController@getAddUser')->name('adgetAddUser');
            Route::post('/add', 'Admins\UserController@postAddUser')->name('adpostAddUser');

            Route::get('/edit/{id}', 'Admins\UserController@getEditUser')->name('adgetEditUser');
            Route::post('/edit/{id}', 'Admins\UserController@postEditUser')->name('adpostEditUser');

            Route::get('/del/{id}', 'Admins\UserController@getDelUser')->name('adgetDelUser');
        });
    });

});