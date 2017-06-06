<?php

namespace System;

use System\Loader;

/**
 * @author	Ammar Faizi	<ammarfaizi2@gmail.com>
 */

class Controller
{
	public function __construct()
	{
		$this->load = new Loader();
	}
}