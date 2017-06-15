<?php

namespace App\Controllers;

use System\Controller;

use App\Models\Register as RegisterModel;

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
		$this->load->helper("teacrypt");
	}

	/**
	 * Default method.
	 */
	public function index()
	{
		$dyn = (new RegisterModel())->tokenizer();
		$this->load->view("register", array("dyn"=>$dyn));
	}

	public function action()
	{
		if ($this->validation()) {
			$json = array(
					"status"=>true,
					"redirect"=>router_url()."/register_success",
					"alert"=>""
				);
		} else {
			$json = array(
					"status"=>false,
					"redirect"=>"",
					"alert"=>$this->alert
				);
		}
		$this->set->header("Content-type","application/json");
		$a = new RegisterModel();
		if ($json['status']) {
			if($a->validDB($this->u)){
				$a->store();
				$json = array(
					"status"=>true,
					"redirect"=>"/register/success",
					"alert"=>(isset($a->alert) ? $a->alert : "")
				);
			} else {
				$json = array(
					"status"=>false,
					"redirect"=>(isset($a->redirect) ? $a->redirect : ""),
					"alert"=>$a->alert
				);
			}
		}
		$a->record($this->u, ($json['status'] ? "true" : "false"));
		die(json_encode($json));
	}


	private $alert;
	private $u;
	private function validation()
	{
		$input = json_decode($this->input->post("register_data"), true);
		$this->u = $input;
		if (!is_array($input)) {
			$this->load->error(404);
			die;
		}
		if (strlen($input['nama'])<4) {
			$this->alert = "Nama terlalu pendek!";
			return false;	
		}
		if (strlen($input['tempat_lahir'])<5) {
			$this->alert = "Tempat lahir terlalu pendek!";
			return false;
		}
		$d = explode("-", $input['tanggal_lahir']);
		if (!checkdate($d[1], $d[2], $d[0])) {
			$this->alert = "Tanggal lahir tidak valid!";
			return false;
		}
		if (strlen($input['phone'])<10 || preg_match("#[^0-9\+]#", $input['phone'])) {
			$this->alert = "Nomor hp tidak valid!~";
			return false;
		}
		if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
			$this->alert = "E-Mail tidak valid!";
			return false;
		}
		if (strlen($input['alamat'])<10) {
			$this->alert = "Alamat kurang lengkap!";
			return false;
		}
		if (strlen($input['username'])<4) {
			$this->alert = "Username terlalu pendek!\nMinimal 4 karakter.";
			return false;
		}
		if (strlen($input['username'])>20) {
			$this->alert = "Username terlalu panjang!\nMaksimal 20 karakter.";
			return false;
		}
		if (strlen($input['password'])<6) {
			$this->alert = "Password terlalu pendek!\nMinimal 6 karakter.";
			return false;
		}
		if (strlen($input['password'])>64) {
			$this->alert = "Password terlalu panjang!\nMaksimal 64 karakter.";
			return false;
		}
		if ($input['password']!==$input['cpassword']) {
			$this->alert = "Konfirmasi Password tidak sama!";
			return false;
		}
		return true;
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