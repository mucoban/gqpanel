<?php

namespace App\Controllers;

class About extends BaseController
{

	public function index($a = "")
	{
        $page = $this->eleModel->getAll([
            "type_id" => 46,
            "lang_id" => $this->current_lang_id,
            "where" => [["eles", "active", "=", 1], ["eles", "id", "=", 348],],
            "orderby" => "eles.orderNumber",
        ]);

        $data = [
            "thisController" => $this,
            "page" => $page,
        ];

        loadpage("about", $data);
    }
}
