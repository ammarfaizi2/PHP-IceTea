<?php

namespace System\Crayner\Contracts\Input;

interface InputBinding
{
    /**
     * @param	int	$cat
     */
    public function escape(int $cat);
}
