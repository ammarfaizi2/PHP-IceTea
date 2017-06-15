<?php

namespace App\Controllers;

use System\Controller;

use App\Models\Register as RegisterModel;
use App\Models\User;

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
        $key = rstr(72);
        $token = rstr(64);
        $enc = teacrypt($token, $key);
        $this->set->cookie("r_tkey", $key, 120)->encrypt("123zxc");
        $this->set->cookie("r_tkn", $token, 120)->encrypt($key);
        $this->load->view("register", array("dyn"=>$dyn, "token"=>$token));
    }

    public function verify_account()
    {
        $reg = new RegisterModel();
        if (isset($_GET['userid'], $_GET['wg'], $_GET['t'])) {
            if($reg->verifyAccount($_GET['userid'], $_GET['t'])){
                $reg->verifyAction();
            } else {
                $this->load->error(404);
            }
        } else {
            $this->load->error(404);
        }
    }

    public function success()
    {
        if (!isset($_COOKIE['registered_user'], $_COOKIE['tokenizer'])) {
            $this->load->error(404);
            die;
        }
        if ($data = (new User())->getUserInfo($this->get->cookie("registered_user"), $this->get->cookie("tokenizer"))) {
            $this->load->view("register_success", ["u"=>$data]);
        } else {
            $this->load->error(404);
        }
    }

    public function action()
    {
        if ($this->validation()) {
            $json = array(
                    "status"=>true,
                    "redirect"=>router_url()."/register/success?ref=reg_page&crf=".rstr(72),
                    "alert"=>""
                );
        } else {
            $json = array(
                    "status"=>false,
                    "redirect"=>(isset($this->redirect) ? $this->redirect : ""),
                    "alert"=>$this->alert
                );
        }
        $this->set->header("Content-type", "application/json");
        $a = new RegisterModel();
        if ($json['status']) {
            if ($a->validDB($this->u)) {
                $a->store();
                $json = array(
                    "status"=>true,
                    "redirect"=>router_url()."/register/success?ref=reg_page&crf=".rstr(72),
                    "alert"=>(isset($a->alert) ? $a->alert : "")
                );
                $this->set->cookie("registered_user", $a->userid, 120);
                $this->set->cookie("tokenizer", $this->u['dynamic_token'], 120);
                $this->set->cookie("r_tkn", "", 0);
                $this->set->cookie("r_tkey", "", 0);
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
    private $redirect;
    private function validation()
    {
        $input = json_decode($this->input->post("register_data"), true);
        $this->u = $input;
        if (!$this->checkRequest() || !is_array($input)) {
            $this->load->error(404);
            die;
        }
        if (!$this->tokenVerify()) {
            $this->alert = "Token mismatch!";
            $this->redirect = "?ref=token_mismatch&wg=".urlencode(rstr(72));
            return false;
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
        if (preg_match("#[^0-9a-zA-Z\_\.]#", $input['username'])) {
            $this->alert = "Username hanya boleh mengandung karakter a-zA-Z0-9 . _";
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

    private function checkRequest()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) and $_SERVER['HTTP_X_REQUESTED_WITH'] === "XMLHttpRequest";
    }

    private function tokenVerify()
    {
        $decrypted_token = $this->get->cookie("r_tkn")->decrypt($this->get->cookie("r_tkey")->decrypt("123zxc"))->__toString();
        return $this->u['hash']===sha1($decrypted_token."aaa") && $decrypted_token===$this->u['token'];
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
