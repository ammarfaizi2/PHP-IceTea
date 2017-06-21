<?php

namespace App\Controllers;

use System\Controller;


class cache extends Controller
{
	/**
	 * Constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->set->header("Content-type","text/cache-manifest");
	}

	/**
	 * Default method.
	 */
	public function index()
	{
	}

	private function mkcache($cache){
		$r = "CACHE MANIFEST\n\n";
		if (isset($cache[0])) {
			foreach ($cache[0] as $val) {
				$r .= $val."\n";
			}
			unset($cache[0]);
		}
		foreach ($cache as $key => $value) {
			$r.= $key."\n";
			foreach ($value as $val) {
				$r.=$val."\n";
			}
		}
		return $r;
	}

	private function asset($name, $type = "css")
	{
		return \System\Crayner\ConfigHandler\Configer::asset($type)."/".$name;
	}
}