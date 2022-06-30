<?php
namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
    protected $helpers = ["my_helper"];

    public $headerMenu;

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();

        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        $router = service('router');
        $this->db = \Config\Database::connect();

        $this->allCts = [
            ["tn" =>"ct_categories", "n" => "Category"],
            ["tn" =>"ct_titles", "n" => "Title"],
            ["tn" =>"ct_txtbox", "n" => "Text Area"],
            ["tn" =>"ct_txteditor", "n" => "Text Editor"],
            ["tn" =>"ct_files", "n" => "Files"],
        ];

        /*********************************************/

        $query = $this->db->query("select * from langs where active = 1 order by `order`");
        $this->langs = $query->getResult();

        $this->current_lang_id = $this->langs[0]->id;

        $this->eleModel = new \App\Models\EleModel($this->db, null, $this->langs, $this->allCts);
        $this->bindingsModel = new \App\Models\BindingsModel();

        /*********************************************/

        $seos = $this->eleModel->getAll([
            "type_id" => 48,
            "lang_id" => $this->current_lang_id,
            "where" => [["eles", "active", "=", 1,]],
            "orderby" => "eles.orderNumber",
        ]);

        $this->headerMenu = $this->eleModel->getAll([
            "type_id" => 33,
            "lang_id" => $this->current_lang_id,
            "where" => [["eles", "active", "=", 1,]],
            "orderby" => "eles.orderNumber",
        ]);

        $foundSeo = null;
        foreach ($seos as $k => $d) {
            if (strlen($d->ct_titles[1]->title) > 2 && strstr($_SERVER['REQUEST_URI'], $d->ct_titles[1]->title)) {
                $foundSeo = $d;
                break;
            }
        }
        if ($foundSeo === null) $foundSeo = $seos[0];
        $this->seo = $foundSeo;

        /*********************************************/

        $panelStr = "";

        if (!$this->session->has($panelStr . "lang_array")) {

            $file = FCPATH. '/uploads/' . $panelStr . 'lang.json';
            $fopen = fopen($file, "r") or die($panelStr . "lang.json not found");
            $fread = fread($fopen, filesize($file));
            fclose($fopen);

            $json = json_decode($fread, true);

            $this->session->set($panelStr . "lang_array", $json);

        }

        if (!$this->session->has("lang_id")) {

            $ar = array_values($this->langs);

            $this->session->set("lang_id", array_shift($ar)->id);

        }

        if (!$this->session->has("langs")) {

            $this->session->set("langs", $this->langs);

        }

//        $this->session->set("lang_id", 8);

    }

}
