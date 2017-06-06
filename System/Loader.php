<?php

namespace System;

/**
 * @author	Ammar Faizi	<ammarfaizi2@gmail.com>
 */

class Loader
{
	/**
	 *
	 * Load view.
	 *
	 * @param	string	$view
	 * @param	string	$__variables
	 */
	public function view($view, array $__variables = null)
	{
		$file = __DIR__ . '/../App/Views/' . $view . '.tpl.php';
		if (is_array($__variables)) {
			foreach ($__variables as $key => $value) {
				$$key = $value;
			}
		}
		require realpath($file);
	}

	/**
	 *
	 * Load error page. 
	 *
	 * @param	int	$code
	 */
	public function error($code)
	{
		http_response_code($code);
		$this->view("errors/{$code}");
		die;
	}

}