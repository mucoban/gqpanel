<?php

namespace App\Controllers;

class Product extends BaseController
{
	public function index($a = "")
	{
	    $data = [
            "thisController" => $this,
        ];

        if ($a == 2) loadpage("product-2", $data);
        else loadpage("product", $data);
    }

}
