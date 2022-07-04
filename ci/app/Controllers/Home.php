<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function session($a = "") {
        echo '<pre>';
        print_r($_SESSION);
        echo '</pre>';
        die;
    }

	public function index($a = "")
	{

        $sliders = $this->eleModel->getAll([
            "type_id" => 39,
            "lang_id" => $this->current_lang_id,
            "where" => [["eles", "active", "=", 1,]],
            "orderby" => "eles.orderNumber",
        ]);
        $sliders = assignWhFiles($this, $sliders);

        $packages = $this->eleModel->getAll([
            "type_id" => 40,
            "lang_id" => $this->current_lang_id,
            "where" => [["eles", "active", "=", 1,]],
            "orderby" => "eles.orderNumber",
        ]);
        $packages = assignWhFiles($this, $packages);

        $proggression = $this->eleModel->getAll([
            "type_id" => 41,
            "lang_id" => $this->current_lang_id,
            "where" => [["eles", "active", "=", 1,]],
            "orderby" => "eles.orderNumber",
        ]);

        $page = $this->eleModel->getAll([
            "type_id" => 9,
            "lang_id" => $this->current_lang_id,
            "where" => [["eles", "active", "=", 1,]],
            "orderby" => "eles.orderNumber",
        ]);

        $data = [
            "thisController" => $this,
            "sliders" => $sliders,
            "packages" => $packages,
            "proggression" => $proggression,
            "page" => $page,
        ];

        loadpage("home", $data);
    }

    public function language($id) {
        $languages = $this->db->table('langs')
            ->where('id', $id)
            ->get()->getResult();
	    $this->session->set("lang_id", $id);
	    $this->session->set("lang_abb", $languages[0]->abb);
        return redirect()->to($_SERVER["HTTP_REFERER"]);
    }

}
