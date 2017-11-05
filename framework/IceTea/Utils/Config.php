<?php

namespace IceTea\Utils;

use IceTea\Hub\Singleton;

final class Config
{
	use Singleton;

	public function __construct()
	{
		$cfg = ___viewIsolator(basepath("config/main.php", 
			[
				"that" => $this
			]
		));
		$this->cfg = $cfg;
	}


	public static function get($key, $def = null)
	{
		$ins = self::getInstance();
		return isset($ins->cfg[$key]) ? $ins->cfg[$key] : $def;
	}
}