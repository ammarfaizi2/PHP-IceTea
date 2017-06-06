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
    public function view(string $view, array $__variables = null, bool $realpath = false)
    {
        $file = __DIR__ . '/../App/Views/' . ($realpath ? $view : $view . '.tpl.php');
        if (!file_exists($file)) {
            throw new \Exception("View not found ! File : {$view}", 400);
        }
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
    public function error(int $code)
    {
        http_response_code($code);
        $this->view("errors/{$code}");
        die;
    }

    /**
     *
     * Load helper file.
     *
     * @param	string	$helper
     * @param	bool	$realpath
     */
    public function helper(string $helper, $realpath = false)
    {
        require __DIR__ . '/Crayner/Helper/'. ($realpath ? $helper : $helper .'.php');
    }
}
