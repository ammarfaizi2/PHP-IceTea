<?php

$app = new IceTea\Web\Web();

try {
	$app->routeHandle();	
} catch (Exception $e) {
	$app = new \IceTea\Exceptions\Handler($e);
} finally {
}

return $app;