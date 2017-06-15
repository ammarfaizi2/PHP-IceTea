<?php

namespace App\Models;

use System\Model;
use System\Crayner\Database\DB;

class Register extends Model
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->pdo = DB::pdoInstance();
    }
    private $pdo;

    private function genUserId()
    {
        $st = $this->pdo->prepare("SELECT `userid` FROM `account_data` WHERE `userid`=:userid LIMIT 1;");
        do {
            $userid = rstr(10, "1234567890", 1);
            ;
            $st->execute([":userid"=>$userid]);
        } while ($st->fetch(\PDO::FETCH_NUM));
        return $userid;
    }
    public $userid;
    public function store()
    {
        $data = $this->dt;
        $userid = $this->genUserId();
        $time_reg = date("Y-m-d H:i:s");
        $this->userid = $userid;
        $key = rstr(72-strlen($userid)).$userid;
        DB::table("account_data")->insert([
                "userid"        => $userid,
                "email"            => $data['email'],
                "username"        => $data['username'],
                "password"        => teacrypt($data['password'], strrev($key)."\x63\x72\x61\x79\x6e\x65\x72"),
                "ukey"            => $key,
                "authority"    => "user",
                "status"        => "active",
                "verified"        => "false",
                "tokenizer"        => $data['dynamic_token'],
                "created_at"    => $time_reg
            ]);
        DB::table("account_info")->insert([
                "userid"        => $userid,
                "nama"            => $data['nama'],
                "tempat_lahir"    => $data['tempat_lahir'],
                "tanggal_lahir"    => $data['tanggal_lahir'],
                "alamat"        => $data['alamat'],
                "phone"            => $data['phone'],
                "last_login"    => null,
                "hid"            => null
            ]);
        $token = rstr(144);
        $tkey  = rstr(72);
        DB::table("pending_account")->insert([
                "userid"        => $userid,
                "token"            => teacrypt($token, $tkey),
                "tkey"            => $tkey,
                "expired"        => $time_reg
            ]);
        DB::close();
    }

    public function record($data, $status = "false")
    {
        $ip = isset($_SERVER['HTTP_CF_CONNECTING_IP']) ? $_SERVER['HTTP_CF_CONNECTING_IP'] : $_SERVER['REMOTE_ADDR'];
        $country = isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? $_SERVER['HTTP_CF_IPCOUNTRY'] : null;
        $ua = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null;
        $ukey = rstr(72);
        $pass = teacrypt($data['password'], $ukey);
        unset($data['password'], $data['cpassword'], $data['token'], $data['dynamic_token']);
        $strdata = json_encode($data);
        $hash = sha1($ip.$ua.$data['username']);
        DB::table("register_history")->insert([
                "id"            => null,
                "data"            => $strdata,
                "password"        => $pass,
                "ukey"            => $ukey,
                "useragent"        => $ua,
                "ip_address"    => $ip,
                "country_id"    => $country,
                "hash"            => $hash,
                "status"        => $status,
                "created_at"    => date("Y-m-d H:i:s"),
                "updated_at"    => null
            ]);
        DB::close();
    }

    public $alert;

    public function validDB($data)
    {
        $this->dt = $data;
        if ($a = DB::table("account_data")->select("username")->where("tokenizer", $data['dynamic_token'])->limit(1)->first()) {
            $this->alert = "Harap periksa kembali, anda sudah terdaftar baru-baru ini dengan username {$a->username}";
            DB::close();
            return false;
        }
        if (DB::table("account_info")->select("userid")->where("phone", $data['phone'])->limit(1)->first()) {
            $this->alert = "Nomor HP sudah digunakan!";
            DB::close();
            return false;
        }
        if (DB::table("account_data")->select("userid")->where("email", $data['email'])->limit(1)->first()) {
            $this->alert = "E-Mail sudah digunakan!";
            DB::close();
            return false;
        }
        if (DB::table("account_data")->select("userid")->where("username", $data['username'])->limit(1)->first()) {
            $this->alert = "Username sudah digunakan!";
            DB::close();
            return false;
        }
        return true;
    }

    public function tokenizer()
    {
        do {
            $tokenizer = rstr(144);
        } while (DB::table("account_data")->select("userid")->where("tokenizer", $tokenizer)->limit(1)->first());
        DB::close();
        return $tokenizer;
    }
}
