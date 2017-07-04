<?php

namespace App\Controllers;

use App\Models\Login as loginmodel;
use System\Controller;

class login extends Controller
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->helper("rstr");
        $this->load->helper("assets");
        $this->load->helper("teacrypt");
        $this->login = new loginmodel();
    }

    /**
     * Default method.
     */
    public function index()
    {
        if (isset($_COOKIE['verified_account'])) {
            $ver = true;
            $this->set->cookie("verified_account", "", 0);
        } else {
            $ver = false;
        }
        if (isset($_COOKIE['registered_user'], $_COOKIE['tokenizer'])) {
            $this->set->cookie("registered_user", "", 0);
            $this->set->cookie("tokenizer", "", 0);
        }
        if ($this->checkLoginCookie()) {
            $this->set->cookie("lt", "", 0);
            $this->set->cookie("tk", "", 0);
            header("Location: ".router_url()."/home");
            die("~");
        }
        $token_key = rstr(32);
        $this->set->cookie("lt", $token = rstr(72), 120)->encrypt($token_key);
        $this->set->cookie("tk", $token_key, 120);
        $this->load->view("auth/login_page", array("token"=>$token, "ver"=>$ver));
    }

    public function logout()
    {
        try {
            if ($uk                = $this->get->cookie("uk")->__toString()
                and $userid            = $this->get->cookie("uid")->decrypt($uk)->__toString()
                and $udata             = $this->login->getUserCredentials($userid, "userid")
                and $sessid            = $this->get->cookie("sessid")->decrypt($udata['ukey'])
            ) {
                if ($this->checkLoginCookie($userid, $sessid)) {
                    $this->login->logout($userid, $sessid);
                    $rem        = array("sessid", "uid", "uk", "mt", "tl", "wg");
                    $exp_time    = -100;
                    foreach ($rem as $val) {
                        $this->set->cookie($val, '', $exp_time);
                    }
                }
            }
        } catch (\Error $e) {
            $rem        = array("sessid", "uid", "uk", "mt", "tl", "wg");
            $exp_time    = -100;
            foreach ($rem as $val) {
                $this->set->cookie($val, '', $exp_time);
            }
        }
        header("location: ".router_url()."/login?ref=logout&cr=".rstr(72));
        die("~");
    }

    public function user_check()
    {
        if ($this->checkRequest()) {
            $this->set->header("Content-type", "application/json");
            if ($this->checkLoginCookie()) {
                print json_encode(array(router_url()."/home?ref=login"));
            }
        } else {
            $this->load->error(404);
        }
    }
    public function checkLoginCookie($userid = false, $sessid = false)
    {
        if (isset($_COOKIE['sessid'], $_COOKIE['uid'], $_COOKIE['uk'], $_COOKIE['mt'])) {
            try {
                if (($userid and $sessid) or ($uk                = $this->get->cookie("uk")->__toString()
                    and $userid            = $this->get->cookie("uid")->decrypt($uk)->__toString()
                    and $udata            = $this->login->getUserCredentials($userid, "userid")
                    and $sessid            = $this->get->cookie("sessid")->decrypt($udata['ukey']))
                ) {
                    if ($this->login->checkUserSession($userid, $sessid)) {
                        return true;
                    } else {
                        $rem        = array("sessid", "uid", "uk", "mt", "tl", "wg");
                        $exp_time    = -100;
                        foreach ($rem as $val) {
                            $this->set->cookie($val, '', $exp_time);
                        }
                        return false;
                    }
                }
            } catch (\Error $e) {
                $rem        = array("sessid", "uid", "uk", "mt", "tl", "wg");
                $exp_time    = -100;
                foreach ($rem as $val) {
                    $this->set->cookie($val, '', $exp_time);
                }
                header("Location:". router_url()."/logout?ref=server_error&cr=".rstr(72));
            }
        }
        return false;
    }

    public function action()
    {
        header("Content-type:text/plain");
        if ($this->checkRequest()) {
            $this->set->header("Content-type", "application/json");
            $ip                    = $_SERVER['REMOTE_ADDR'];
            $deviceInfo            = json_encode(array("useragent" => $_SERVER['HTTP_USER_AGENT']));
            $username            = $this->input->post("username");
            $password            = $this->input->post("password");
            if ($token_match    = $this->tokenVerify()) {
                if ($login        = $this->login->action($username, $password)) {
                    $udata        = $this->login->getUserCredentials($username);
                    $sessid    = $this->login->createSession(
                        $udata['userid'],
                        $ip,
                        $deviceInfo
                    );
                    $expired    = 60*24*7;
                    $uidkey        = rstr(32);
                    $this->set->cookie("lt", "", 0);
                    $this->set->cookie("tk", "", 0);
                    $this->set->cookie("sessid", $sessid, $expired)->encrypt($udata['ukey']);
                    $this->set->cookie("uid", $udata['userid'], $expired)->encrypt($uidkey);
                    $this->set->cookie("uk", $uidkey, $expired);
                    $this->set->cookie("mt", rstr(72), $expired);
                    $this->set->cookie("tl", rstr(32), $expired);
                    $this->set->cookie("wg", rstr(32), $expired)->encrypt($uidkey);
                    $login        = true;
                    $alert        = "";
                    $r            = router_url()."/home";
                } else {
                    $login        = false;
                    $alert        = "Username atau password salah!";
                    $r             = "";
                }
            } else {
                $login            = false;
                $alert            = "Token mismatch !";
                $r                 = router_url()."/login?ref=login&err=token_mismatch";
            }
            $mkey                = $this->get->cookie("mkey");
            $mkey                = $this->login->saveLoginAction($login, $username, $password, $ip, $deviceInfo, $mkey);
            $this->set->cookie("mkey", $mkey, 60*24);
            print json_encode(
                array(
                    "login"    => $login,
                    "alert"    => $alert,
                    "r"            => $r
                )
            );
        } else {
            $this->load->error(404);
        }
    }

    private function tokenVerify()
    {
        return (string) $this->get->cookie("lt")->decrypt($this->get->cookie("tk")) === (string) $this->input->post("_token");
    }

    private function checkRequest()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) and $_SERVER['HTTP_X_REQUESTED_WITH'] === "XMLHttpRequest";
    }
}
