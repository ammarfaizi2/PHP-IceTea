<?php

namespace App\Controllers;

use System\Controller;


class siswa extends Controller
{
	/**
	 * Constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->helper("assets");
	}

	/**
	 * Default method.
	 */
	public function index()
	{
		if (isset($_GET['cache'])) {
			$this->app();
			die;
		}
		$this->load->view("daftar_nilai");
	}

	public function data()
	{
		$this->set->header("Content-type","application/json");
		print json_encode((new \App\Models\Siswa())->getDataSiswa(), 128);
	}

	public function input(){
		
	}

	public function app(){
		$this->set->header("Content-type","text/cache-manifest");
		echo <<<qq
CACHE MANIFEST
CACHE:
#siswa
#data_siswa

NETWORK:
#data_siswa
http://*
https://*
*
qq;
	}
}