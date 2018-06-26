<?php

namespace IceTea\Routing;

class RouteMatching
{	
	/**
	 * @var \IceTea\Routing\RoutesContainer
	 */
	private $container;

	/**
	 * @var \IceTea\Foundation\Application\Web
	 */
	private $web;

	/**
	 * Constructor
	 *
	 * @param \IceTea\Routing\RoutesContainer		$container
	 * @param \IceTea\Foundation\Application\Web	$web
	 * @return void
	 */
	public function __construct(RoutesContainer $container, Web $web)
	{
		$this->web = $web;
		$this->container = $container;
	}

	/**
	 * @return mixed
	 */
	public function run()
	{
		
	}
}
