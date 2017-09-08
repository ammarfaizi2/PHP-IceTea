<?php

require __DIR__."/../autoload.php";

try {
    IceTea::run();
} catch (Exception $e) {
    var_dump($e->getMessage());
}
