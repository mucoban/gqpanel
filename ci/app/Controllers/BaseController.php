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


        $this->current_lang_id = $this->session->lang_id ?: $this->langs[0]->id;

        $this->eleModel = new \App\Models\EleModel($this->db, null, $this->langs, $this->allCts);
        $this->bindingsModel = new \App\Models\BindingsModel();

        /*********************************************/

        $seos = $this->eleModel->getAll([
            "type_id" => 48,
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

        $this->headerMenu = $this->eleModel->getAll([
            "type_id" => 33,
            "lang_id" => $this->current_lang_id,
            "where" => [["eles", "active", "=", 1,]],
            "orderby" => "eles.orderNumber",
        ]);

        $deleteds = 0;
        foreach ($this->headerMenu as $k => $v) {
            if (isset($v->ct_titles[2]->title) && strstr($v->ct_titles[2]->title, 'parent-')) {
                array_splice($this->headerMenu, $k - $deleteds, 1); $deleteds++;
                $parent_list_item_id = str_replace('parent-', '', $v->ct_titles[2]->title);
                foreach ($this->headerMenu as $k_b => $v_b) {
                    if ($v_b->id === $parent_list_item_id) {
                        if (isset($this->headerMenu[$k_b]->children)) $this->headerMenu[$k_b]->children[] = $v;
                        else $this->headerMenu[$k_b]->children = [$v];
                        break;
                    }
                }
            }
        }

        $this->footer = $this->eleModel->getAll([
            "type_id" => 15,
            "lang_id" => $this->current_lang_id,
            "where" => [["eles", "active", "=", 1,]],
            "orderby" => "eles.orderNumber",
        ]);

        $this->footerMenu = $this->eleModel->getAll([
            "type_id" => 8,
            "lang_id" => $this->current_lang_id,
            "where" => [["eles", "active", "=", 1,]],
            "orderby" => "eles.orderNumber",
        ]);

        $this->footerContact = $this->eleModel->getAll([
            "type_id" => 38,
            "lang_id" => $this->current_lang_id,
            "where" => [["eles", "active", "=", 1,]],
            "orderby" => "eles.orderNumber",
        ]);
        $this->footerContact = assignWhFiles($this, $this->footerContact);

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
            $languages = $this->db->table('langs')
                ->where('id', $this->session->lang_id)
                ->get()->getResult();
            $this->session->set("lang_abb", $languages[0]->abb);
        }
    }

}
