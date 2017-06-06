<?php

namespace System\Crayner\Contracts\Input;

interface InputBinding
{
    /**
     * @param int	$cat
     */
    public function escape(int $cat);

    /**
     * @param string	$key
     */
    public function encrypt(string $key);

    /**
     * @param string	$ley
     */
    public function decrypt(string $key);
}
