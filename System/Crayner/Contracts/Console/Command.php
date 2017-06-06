<?php

namespace System\Crayner\Contracts\Console;

interface Command
{
    /**
     * Prepare a command.
     *
     * @param	string	$command
     * @return	$this
     */
    public function prepare($selection, $optional, $command);

    /**
     * Get argument.
     *
     * @param   array   $argument
     */
    public function argument($argument);

    /**
     * Execute command.
     *
     * @return	bool
     */
    public function execute();

    /**
     * Show command result.
     *
     * @return	string
     */
    public function showResult();
}
