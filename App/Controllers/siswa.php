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
	}

	/**
	 * Default method.
	 */
	public function index()
	{
		$a = (new \App\Models\Siswa())->getDataSiswa();
		var_dump($a);
		$this->load->view("daftar_nilai");
	}
}