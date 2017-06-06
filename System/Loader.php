<?php

namespace System;

/**
 * @author	Ammar Faizi	<ammarfaizi2@gmail.com>
 */

class Loader
{
	/**
	 *
	 * Load View.
	 *
	 * @param	string	$view
	 * @param	string	$__variables
	 */
	public function view($view, $__variables)
	{
		$file = __DIR__ . '/../App/Views/' . $view . '.tpl.php';
		if (is_array($__variables)) {
			foreach ($__variables as $key => $value) {
				$$key = $value;
			}
		}
		require realpath($file);
	}

}