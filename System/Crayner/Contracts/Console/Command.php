<?php

namespace System\Crayner\Contracts\Console;


interface Command
{
	/**
	 *
	 * @var	string
	 */
	private $command;

	/**
	 *
	 * @var	string
	 */
	private $commandResult;

	/**
	 * Prepare a command.
	 *
	 * @param	string	$command
	 * @return	$this
	 */
	public function prepare($command);

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