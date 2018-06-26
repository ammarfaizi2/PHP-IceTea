<?php

$web = require __DIR__."/../init/web.php";

$web->captureRequest();
$web->run();
$web->sendResponse();
