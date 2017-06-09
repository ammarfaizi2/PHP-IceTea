<?php
use System\Router as Route;
use System\Controller;

function view(string $view, array $var = null){
	(new Controller())->load->view($view, $var);
}


/**
|
|	Web Routes
|
|
|
|
|
*/






Route::get("/", function(){
	view("welcome");
});