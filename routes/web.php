<?php

Route::get('/', 'IndexController@index');

Route::get('/test/{x}', function (Route $a) {
	
})->name('test');

Route::group(['prefix' => 'admin'], function () {
	Route::get('data', function () {
	});
});
