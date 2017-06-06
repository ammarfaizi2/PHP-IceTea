<?php

namespace Console\Commands;

use System\Crayner\Contracts\Console\Command;

/**
 * @author	Ammar Faizi	<ammarfaizi2@gmail.com>
 */

class Make implements Command
{
    /**
     *
     *
     */
    public function prepare($command)
    {
        $this->command = $command;
    }
}
