<?php

use IceTea\Routing\Route;

Route::get("/", function() {
	return view('welcome');
});