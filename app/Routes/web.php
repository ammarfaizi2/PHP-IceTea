<?php

Route::get("/", "TestController@index");
Route::get("/rr", "TestController@testRandomString");
Route::get("/ec", "TestController@testEncrypt");
