<?php

namespace App\Controllers;

class F404 extends BaseController
{
	public function index($a = "")
	{

        $data = [
            "thisController" => $this,
        ];


        loadpage("f404", $data);
    }

}
