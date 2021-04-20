<?php

Route::group(['prefix' => config('filemanager.ROUTE_PREFIX'), 'namespace' => 'zobayer\LaravelFileManager\Http\Controllers'], function () {
    Route::post('/add', 'LaravelFileManagerController@AddFile')->name('laravel.file.manager.add');
    Route::get('/get', 'LaravelFileManagerController@GetFileAll')->name('laravel.file.manager.get.all');
    Route::get('/get/single/{id}', 'LaravelFileManagerController@GetFileSingle')->name('laravel.file.manager.get.single');
    Route::post('/delete/single/{id}', 'LaravelFileManagerController@DeleteFileSingle')->name('laravel.file.manager.get.delete');
    Route::post('/hard/delete/single/{id}', 'LaravelFileManagerController@DeleteFileSingleHard')->name('laravel.file.manager.get.delete.hard');
});
