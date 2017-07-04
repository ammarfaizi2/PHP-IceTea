<?php
use System\Router as Route;
use System\Controller;

function view(string $view, array $var = null)
{
    (new Controller())->load->view($view, $var);
}






Route::get("/", "index@index");
Route::get("/login", "login@index");
Route::get("/login/user_check", "login@user_check");
Route::post("/login/action", "login@action");

Route::get("/verify/account/annotation/fqcn", "register@verify_account");
Route::get("/register", "register@index");
Route::post("/register/action", "register@action");
Route::get("/register/success", "register@success");
Route::get("/logout", "login@logout");
Route::get("/home", "home@index");
Route::get("/profile", "user@userpage");
Route::get("/search", "user@search");
Route::get("/siswa", "siswa@index");



Route::get("/cache/login", "cache@login");
Route::get("/user/ajax", "user@ajax");
