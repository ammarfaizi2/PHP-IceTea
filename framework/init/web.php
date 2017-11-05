<?php

require __DIR__."/error_handler/web.php";

set_error_handler("___IceTeaErrorHandler");
echo $aaaa;
$app = new IceTea\Web\Web();

try {
    $app->routeHandle();
} catch (Exception $e) {
    $app = new \IceTea\Exceptions\Handler($e);
} finally {
}

return $app;
