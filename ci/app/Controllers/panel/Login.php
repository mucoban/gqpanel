<?php

namespace App\Controllers\panel;

use CodeIgniter\HTTP\IncomingRequest;

class Login extends BaseController {

    public function givehash($str) {
        echo $str. '<br>';
        echo password_hash($str, PASSWORD_BCRYPT);
    }

    public function index($a = "")
	{
        $data = [
            "login" => 1,
        ];
		loadpage("login", $data, 1);
	}


	public function logout() {
	    $this->session->remove("puser_id", 1);
        header('location: ' . base_url('/panel/login/index'));
        exit();
    }


	public function attempt() {

	    $request = service('request');
        $uname = $request->getPost('uname');
        $pass = $request->getPost('pass');
        $resar = [];

        if (!empty($uname) && !empty($pass)) {
            $db = $this->db;

            $query = $db->query("SELECT * FROM users where username='" . $uname . "'");
            $row = $query->getRow();

            if ($db->affectedRows() > 0) {
                if (password_verify($pass, $row->pass)) {
                    $ar = ["last_login" => date("Y-m-d H:i:s")];

                    $db->table("users")->where("username", $uname)->set($ar)->update();

                    $resar = [
                        "success" => 1,
                        "username" => $row->username,
                    ];

                    $this->session->set("puser_id", 1);
                    $this->session->set("puser", $row);
                } else {
                    $resar = [
                        "success" => 0,
                        "err" => "Invalid username or password-3",
                    ];
                }
            } else {
                $resar = [
                    "success" => 0,
                    "err" => "Invalid username or password",
                ];
            }
        } else {
            $resar = [
                "success" => 0,
                "err" => "Invalid username or password-2",
                "post" => $_POST,
            ];
        }

        echo json_encode($resar);
	}

}
