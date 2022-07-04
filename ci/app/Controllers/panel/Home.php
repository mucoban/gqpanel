<?php

namespace App\Controllers\panel;

class Home extends BaseController
{
	public function index()
	{

	    $data = [
            "thisController" => $this,
        ];

        $footerMenu = $this->eleModel->getAll([
            "type_id" => 8,
            "lang_id" => $this->session->lang_id,
            "orderby" => "eles.orderNumber",
        ]);
        $data['countfooterMenu'] = count($footerMenu);

        $headerMenu = $this->eleModel->getAll([
            "type_id" => 33,
            "lang_id" => $this->session->lang_id,
            "orderby" => "eles.orderNumber",
        ]);
        $data['countheaderMenu'] = count($headerMenu);

        loadpage("home", $data, 1);
	}


    public function lang($id) {

        $this->session->set("lang_id", $id);

        return redirect()->to($_SERVER["HTTP_REFERER"]);

    }

	//--------------------------------------------------------------------

}
