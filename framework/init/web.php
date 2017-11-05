<?php

require __DIR__."/error_handler/web.php";

set_error_handler("___IceTeaErrorHandler");

$app = new IceTea\Web\Web();
$app->routeHandle();

return $app;
