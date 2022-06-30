<?php

namespace App\Controllers\panel;

class Users extends BaseController
{
	public function index()
	{

//	    echo base_url();

        $db = \Config\Database::connect();

        $query = $db->query('SELECT * FROM eles');
        $row = $query->getRow();

        $lc = panelUserLoggedInCheck();
        if ($lc)  return $lc;

        loadpage("users", [], 1);
	}

	//--------------------------------------------------------------------

}
