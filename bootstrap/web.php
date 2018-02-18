<?php

define("BASEPATH", realpath(__DIR__."/.."), true);

$app = new EsTeh\Foundation\Application(
    [
        "basepath" => BASEPATH,
        "apppath" => BASEPATH."/app",
        "initpath" => BASEPATH."/bootstrap",
        "publicpath" => BASEPATH."/public",
        "configpath" => BASEPATH."/config",
        "storagepath" => BASEPATH."/storage"
    ]
);

$app->init();

$app->addProvider(
    EsTeh\Support\Config::get("app.providers")
);

return $app;
