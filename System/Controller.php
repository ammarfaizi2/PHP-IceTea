<?php

namespace System;

use System\Loader;
use Crayner\Hub\Singleton;

/**
 * @author	Ammar Faizi	<ammarfaizi2@gmail.com>
 */

class Controller
{
	use Singleton;
	
	public function __construct()
	{
		$this->load = new Loader();
	}
}