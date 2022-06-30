<?php

namespace App\Controllers\panel;

use CodeIgniter\HTTP\IncomingRequest;

class Login extends BaseController
{

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

//        $request->getGet('abc');
//        $uname = $request->getGet('uname');
        $uname = $request->getPost('uname');
//        $pass = $request->getGet('pass');
        $pass = $request->getPost('pass');

        $resar = [];


        if (!empty($uname) && !empty($pass)) {



            $db = $this->db;

            $query = $db->query("SELECT * FROM users where username='" . $uname . "'");
            $row = $query->getRow();

            if ($db->affectedRows() > 0) {
//                echo $pass;
//                echo '-----';
//                echo $row->pass;
                if (password_verify($pass, $row->pass)) {

                    $ar = ["last_login" => date("Y-m-d H:i:s")];

                    $db->table("users")->where("username", $uname)->set($ar)->update();

                    $resar = [
                        "success" => 1,
                        "username" => $row->username,
//                        "pass" => $passHashed,
                    ];


                    $this->session->set("puser_id", 1);
                    $this->session->set("puser", $row);

//                    return redirect()->to(base_url('/panel'));

                } else {
                    $resar = [
                        "success" => 0,
                        "err" => "Invalid username or password-3",
//                        "pass" => $passHashed,
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
            ];
        }



        echo json_encode($resar);
	}

	//--------------------------------------------------------------------

}
