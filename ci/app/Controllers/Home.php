<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index($a = "")
	{

        $page = $this->eleModel->getAll([
            "type_id" => 39,
            "lang_id" => $this->current_lang_id,
            "where" => [["eles", "active", "=", 1,]],
            "orderby" => "eles.orderNumber",
        ]);
        $page = assignWhFiles($this, $page);

        $data = [
            "thisController" => $this,
            "page" => $page,
        ];

        loadpage("home", $data);
    }

    public function language($id) {

	    $this->session->set("lang_id", $id);

        return redirect()->to($_SERVER["HTTP_REFERER"]);

    }

}
