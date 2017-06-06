<?php

namespace System\Crayner\Contracts\Input;

interface PostGate
{
    /**
     * @param	string	$key
     */
    public function post(string $key);
}
