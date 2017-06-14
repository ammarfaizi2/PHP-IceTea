<?php

namespace App\Controllers;

use System\Controller;


class register extends Controller
{
	/**
	 * Constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->helper("assets");
		$this->load->helper("rstr");
	}

	/**
	 * Default method.
	 */
	public function index()
	{
		$this->load->view("register", array("dyn"=>rstr(72)));
	}

	/*private function tanggal_lahir()
    {
        $a = '<select required name="tanggal"><option></option>';
        if (isset($this->saved_post['tanggal'])) {
            for ($i=1; $i <= 31; $i++) {
                $a.='<option '.($this->saved_post['tanggal']==$i?'selected':'').'>'.$i.'</option>';
            }
        } else {
            for ($i=1; $i <= 31; $i++) {
                $a.='<option>'.$i.'</option>';
            }
        }
        $a .= '</select>';
        $a.= '<select required name="bulan"><option></option>';
        $bln = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
        $i = 1;
        if (isset($this->saved_post['bulan'])) {
            foreach ($bln as $val) {
                $a.='<option value="'.($i).'" '.($this->saved_post['bulan']==$i++?'selected':'').'>'.$val.'</option>';
            }
        } else {
            foreach ($bln as $val) {
                $a.='<option value="'.($i++).'">'.$val.'</option>';
            }
        }
        
        $a.='</select>';
        $a.= '<select required name="tahun"><option></option>';
        if (isset($this->saved_post['tahun'])) {
            for ($i=(int)date('Y');$i>=1965;$i--) {
                $a.='<option'.($this->saved_post['tahun']==$i?' selected':'').'>'.($i).'</option>';
            }
        } else {
            for ($i=(int)date('Y');$i>=1965;$i--) {
                $a.='<option>'.($i).'</option>';
            }
        }
        return $a.'</select>';
    }*/
}