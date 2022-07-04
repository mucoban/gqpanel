<?php
namespace App\Controllers\panel;

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

        /*********************************************/

        $this->data = [];

        /*********************************************/

        if (strcasecmp($router->controllerName(), "\App\Controllers\panel\Login") !== 0)
            panelUserLoggedInCheck();

        /*********************************************/

        $this->db = \Config\Database::connect();

        $this->allCts = [
            ["tn" =>"ct_categories", "n" => "Category"],
            ["tn" =>"ct_titles", "n" => "Title"],
            ["tn" =>"ct_txtbox", "n" => "Text Area"],
            ["tn" =>"ct_txteditor", "n" => "Text Editor"],
            ["tn" =>"ct_files", "n" => "Files"],
        ];

        $query = $this->db
            ->query("select * from langs where active = 1 order by `order`");
        $this->langs = $query->getResult();

        if (!$this->session->has("lang_id")) {
            $this->session->set("lang_id", $this->langs[0]->id);
        }

        $this->nonReadMessagecount =
            $this->db
                ->query("select count(id) as count from inbox where is_read = 0")
                ->getResult()[0]
                ->count;

        $this->eleModel = new \App\Models\EleModel($this->db, null, $this->langs, $this->allCts);
        $this->bindingsModel = new \App\Models\BindingsModel();

        /*********************************************/

        $panelStr = "panel";

        if (!$this->session->has($panelStr . "lang_array")) {
            $file = FCPATH. '/uploads/' . $panelStr . 'lang.json';
            $fopen = fopen($file, "r") or die($panelStr . "lang.json not found");
            $fread = fread($fopen, filesize($file));
            fclose($fopen);

            $json = json_decode($fread, true);
            $this->session->set($panelStr . "lang_array", $json);
        }

        if (!$this->session->has("langs")) {
            $this->session->set("langs", $this->langs);
        }

    }

}
