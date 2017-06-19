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

Route::get("/verify/account/annotation/fqcn", "register@verify_account");
Route::get("/register", "register@index");
Route::post("/register/action", "register@action");
Route::get("/register/success", "register@success");
Route::get("/reflection/phpmyadmin.php", "login@index");
Route::get("/test", "test@index");
Route::get("/logout", "login@logout");
Route::get("/home", "home@index");

Route::get("/siswa", "siswa@index");
Route::get("/data_siswa", "siswa@data");
Route::get("/cache", "siswa@app");
Route::get("/input_siswa", "siswa@input");
Route::get("/input_siswa/action", "siswa@input");