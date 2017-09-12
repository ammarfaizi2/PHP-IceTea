<?php

namespace Console;

abstract class ConsoleCommand
{
	/**
	 * @var array
	 */
	private $param = [];

	/**
	 * @param array $param
	 */
	abstract public function input($param);

	/**
	 * Execute command.
	 */
	abstract public function execute();

	/**
	 * Command result.
	 */	 
	abstract public function result();
}