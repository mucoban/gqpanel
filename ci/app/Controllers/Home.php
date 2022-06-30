<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index($a = "")
	{

        $data = [
            "thisController" => $this,
        ];

        loadpage("home", $data);
    }

    public function lang($id) {

	    $this->session->set("lang_id", $id);

        return redirect()->to($_SERVER["HTTP_REFERER"]);

    }

}
