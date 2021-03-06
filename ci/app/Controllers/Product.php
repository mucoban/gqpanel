<?php

namespace App\Controllers;

class Product extends BaseController
{
	public function index() { }

	public function get($id) {
        $page = $this->eleModel->getAll([
            "type_id" => 49,
            "lang_id" => $this->current_lang_id,
            "where" => [["eles", "active", "=", 1,], ["eles", "id", "=", $id,]],
            "orderby" => "eles.orderNumber",
        ]);
        $page = assignWhFiles($this, $page);

        $data = [
            "thisController" => $this,
            "page" => $page,
        ];

	    loadpage("product", $data);
    }

}
