<?php
use System\Router as Route;
use System\Controller;

function view(string $view, array $var = null){
	(new Controller())->load->view($view, $var);
}


/**
|
|	IceTea Web Routes
|
|
|
|
|
*/






Route::get("/","index@index");
Route::get("/login", "login@index");