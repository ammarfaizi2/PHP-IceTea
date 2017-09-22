<?php

/**
 * Pengaturan router.
 */

Route::get("/", "TestController@index");
Route::get("/test-random-string", "TestController@testRandomString");
Route::get("/test-encryption", "TestController@testEncrypt");
