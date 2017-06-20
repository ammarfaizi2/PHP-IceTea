<?php

namespace System;

/**
 * @author    Ammar Faizi    <ammarfaizi2@gmail.com>
 */

class Loader
{
    /**
     * Load view.
     *
     * @param string $view
     * @param string $__variables
     */
    public function view(string $___view, array $___variables = null, bool $___realpath = false)
    {
        $___file = __DIR__ . '/../App/Views/' . ($___realpath ? $___view : $___view . '.tpl.php');
        if (!file_exists($___file)) {
            throw new \Exception("View not found ! File : {$view}", 400);
        }
        if (is_array($___variables)) {
            foreach ($___variables as $___key => $___value) {
                $$___key = $___value;
            }
        }
        unset($___variables, $___key, $___value, $___realpath, $___view);
        include $___file;
    }

    /**
     * Load error page.
     *
     * @param int $code
     */
    public function error(int $code)
    {
        http_response_code($code);
        $this->helper("url");
        $this->view("errors/{$code}");
        die;
    }

    /**
     * Load helper file.
     *
     * @param string $helper
     * @param bool   $realpath
     */
    public function helper(string $helper, bool $realpath = false)
    {
        include __DIR__ . '/Crayner/Helper/'. ($realpath ? $helper : $helper .'.php');
    }
}
