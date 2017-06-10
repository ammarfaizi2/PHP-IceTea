<?php
use System\Router as Route;
use System\Controller;

function view(string $view, array $var = null)
{
    (new Controller())->load->view($view, $var);
}


/**
 *    IceTea Web Routes
 */






Route::get("/", "index@index");

/**
 *    Login Routes
 */
Route::get("/login", "login@index");
Route::get("/login/user_check", "login@user_check");
Route::post("/login/action", "login@action");

Route::get("/logout", "login@logout");

Route::get("/home", "home@index");
