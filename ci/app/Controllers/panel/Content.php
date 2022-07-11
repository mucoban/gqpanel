<?phpnamespace App\Controllers\panel;class Content extends BaseController {    private $adminId = '5';	public function ses($typeId = "", $n = "") {        echo " ses:<pre>"; print_r($_SESSION); echo "</pre>";    }	public function list($typeId = "", $n = "") {        $sortType = '';	    if ($typeId === "-2") {            $cts = [                "eleTitle" => "Languages",            ];        } else if ($typeId === "-4") {            $cts = [                "eleTitle" => "Users",            ];        } else if ($typeId === "-3") {            $cts = [                "eleTitle" => "Element Types",            ];        } else if ($typeId === "-5") {            $cts = [                "eleTitle" => "Mesaj",            ];        } else {            $cts = $this->bindingsModel->typeBindings($typeId, false);            $ele_types = $this->db                ->table('ele_types')                ->where('id', $typeId)                ->get()                ->getResult();            if (!empty($ele_types[0]->sortType)) {                $sortType = $ele_types[0]->sortType;            }        }        if ($typeId === '32') {            $fetchTableDataObj = json_encode([['ct_categories', 0, 'title'],['ct_categories', 1, 'title']], true); }        else { $fetchTableDataObj = ''; }	    $data = [            "typeId" => $typeId,            "cts" => $cts,            "allCts" => $this->allCts,            "fetchTableDataObj" => $fetchTableDataObj,            "sortType" => $sortType,            "isAdmin" => ($_SESSION['puser']->id === $this->adminId),            "thisController" => $this,        ];        if ($typeId === '-5') { $data['showMode'] = true; }        loadpage("content/list", $data, 1);	}    public function fetchTableData() {        $reqData = $_REQUEST;        $selectCtsLangid = 0;        if ($this->session->has("lang_id")) { $selectCtsLangid = $this->session->lang_id; }        else if (isset($this->langs[0])) { $selectCtsLangid = $this->langs[0]->id; }        $ele_types = $this->db            ->table('ele_types')            ->where('id', $reqData["typeId"])            ->get()            ->getResult();        $sortType = '';        if (!empty($ele_types[0]->sortType)) {            $sortType = ' ' . $ele_types[0]->sortType;        }	    $sqlData = [            "type_id" => $reqData["typeId"],            "lang_id" => $selectCtsLangid,            "onlyTitle" => 1,            "orderby" => "eles.orderNumber" . $sortType,            "groupby" => 1,        ];        if (!empty($reqData["titleFieldContent"])) {            unset($sqlData['onlyTitle']);        }	    if (!empty($reqData["search"])) {            $sqlData["where"][] =  ["ct_titles", "title", "like", "'%" . $reqData["search"] . "%'"];        }	    if ($reqData["typeId"] === "-3") {            $items = $this->db->query("select * from ele_types order by orderNumber")->getResult();            $count = $this->db->query("select count(id) as count from ele_types order by orderNumber")->getResult();            $countAll = $count[0]->count;        } else if ($reqData["typeId"] === "-4") {            $where = '';            if ($_SESSION['puser']->id !== $this->adminId) {                $where = ' where id != ' . $this->adminId;            }            $items = $this->db->query("select * from users" . $where . " order by `id`")->getResult();            $count = $this->db->query("select count(id) as count from users" . $where )->getResult();            $countAll = $count[0]->count;        } else if ($reqData["typeId"] === "-2") {            $items = $this->db->query("select * from langs order by `order`")->getResult();            $count = $this->db->query("select count(id) as count from langs order by `order`")->getResult();            $countAll = $count[0]->count;        } else if ($reqData["typeId"] === "-5") {            $items = $this->db->query("select * from inbox order by id desc")->getResult();            $count = $this->db->query("select count(id) as count from inbox order by id desc")->getResult();            $countAll = $count[0]->count;            foreach ($items as $k => $d) {                $bTagA = '<div class="clist__seemsg js-clist_editbtn">';                $bTagB = '<div>';                if ($d->is_read === '0') { $bTagA .= '<b>'; $bTagB .= '</b>'; }                $items[$k]->title = $bTagA . (date('d-m-Y H:i', strtotime($d->datetime))) . ' / ' . ($d->name)                    . ' / ' . (substr( $d->message, 0, 50)) . $bTagB;            }        } else {            $items = $this->eleModel->getAll($sqlData);            $sqlData["count"] = 1;            $countAll = $this->eleModel->getAll($sqlData);            $countAll = count($countAll);        }	    if (!empty($reqData["titleFieldContent"])) {            $items = assignCats($this, $items);            $titleFieldContent = json_decode($reqData["titleFieldContent"], true);            foreach($items as $k => $d) {                $newTitle = '';                foreach($titleFieldContent as $k_b => $d_b) {                    $v0 = $d_b[0];                    $v1 = $d_b[1];                    $v2 = $d_b[2];                    if ($k_b !== 0) $newTitle .= ' - ';                    $newTitle .= !empty($items[$k]->{$v0}[$v1]->{$v2}) ? $items[$k]->{$v0}[$v1]->{$v2} : '';                }                $items[$k]->ct_titles[0]->title = $newTitle;            }        }        $data = [            "success" => true,            "items" => $items,            "countAll" => $countAll,        ];        echo json_encode($data);	}	public function countAll() {        $sqlData = [            "type_id" => 1,            "lang_id" => 1,            "where" => [["ct_titles.order", "=", 0]],            "groupby" => 1        ];        $sqlData["count"] = 1;        $countAll = $this->eleModel->getAll($sqlData);        echo "<pre>"; print_r($countAll); echo "</pre>"; die;    }	public function edit($id = "", $typeId = "", $n = "") {        define("CEDITBODY", 1);        if ($typeId === "-5") {            $items = $this->db->query("select * from inbox where id = " . $id)->getResult();            $this->db->query("update inbox set is_read = 1 where id = " . $id);            if (isset($items[0])) {                $items[0]->{"ct_titles"} = [                    (object) [                        "id" => 0,                        "lang_id" => $this->langs[0]->id,                        "title" => $items[0]->name,                        "order" => "0",                        "active" => 1,                    ],                    (object) [                        "id" => 0,                        "lang_id" => $this->langs[0]->id,                        "title" => date("d/m/Y H:i:s", strtotime($items[0]->datetime)),                        "order" => "1",                        "active" => 1,                    ],                    (object) [                        "id" => 0,                        "lang_id" => $this->langs[0]->id,                        "title" => $items[0]->phone,                        "order" => "2",                        "active" => 1,                    ],                    (object) [                        "id" => 0,                        "lang_id" => $this->langs[0]->id,                        "title" => $items[0]->email,                        "order" => "3",                        "active" => 1,                    ],                ];                $items[0]->{"ct_txtbox"} = [                    (object) [                        "id" => 0,                        "lang_id" => $this->langs[0]->id,                        "value" => $items[0]->message,                        "order" => "0",                        "active" => 1,                    ],                ];            }            $cts = [                "tables" => [                    ["table" => "ct_titles", "order" => "0", "label" => "Name Surname", "disabled" => 1],                    ["table" => "ct_titles", "order" => "1", "label" => "Date and Time", "disabled" => 1],                    ["table" => "ct_titles", "order" => "3", "label" => "E-mail", "disabled" => 1],                    ["table" => "ct_titles", "order" => "2", "label" => "Phone", "disabled" => 1],                    ["table" => "ct_txtbox", "order" => "0", "label" => "Message", "labelb" => "", "disabled" => 1],                ]            ];            $langs = [$this->langs[0]];        } else if ($typeId === "-4") {            $items = $this->db->query("select * from users where id = " . $id)->getResult();            if (isset($items[0])) {                $items[0]->{"ct_titles"} = [                    (object) [                        "id" => 0,                        "lang_id" => $this->langs[0]->id,                        "title" => $items[0]->username,                        "order" => "0",                        "active" => 1,                    ],                    (object) [                        "id" => 0,                        "lang_id" => $this->langs[0]->id,                        "title" => date("d/m/Y H:i:s", strtotime($items[0]->last_login)),                        "order" => "1",                        "active" => 1,                    ],                ];            }            $cts = [                "tables" => [                    ["table" => "ct_titles", "order" => "0", "label" => "Title"],                    ["table" => "ct_titles", "order" => "1", "label" => "Last Login", "disabled" => 1],                    ["table" => "ct_password", "order" => "0", "label" => "New Password", "name" => "new-password-1"],                    ["table" => "ct_password", "order" => "0", "label" => "Repeat New Password", "name" => "new-password-2"],                ]            ];            $langs = [$this->langs[0]];        } else if ($typeId === "-3") {            $items = $this->db->query("select * from ele_types where id = " . $id . " order by orderNumber")->getResult();            foreach($items as $k => $d) {                $items[$k]->{"ct_titles"} = [                    (object) [                        "id" => 1,                        "parent_id" => $items[$k]->id,                        "lang_id" => $this->langs[0]->id,                        "title" => $items[$k]->title,                        "order" => "0",                        "active" => 1,                    ],                ];                /*********************************************/                $items[$k]->{"eltypeadd"} = $this->db                    ->query("select * from ele_typesbindingtables where type_id = "                        . $d->id . " and active = 1 order by orderNumber")                    ->getResult();            }            $cts = [                "tables" => [                    ["table" => "ct_titles", "order" => "0", "label" => "Title"],                ]            ];            $langs = [$this->langs[0]];        } else if ($typeId === "-2") {            $items = [objedengetir($this->langs, ["id" => $id], "self")];            foreach($items as $k => $d) {                $items[$k]->{"ct_titles"} = [                    (object) [                        "id" => 1,                        "parent_id" => $items[$k]->id,                        "lang_id" => $this->langs[0]->id,                        "title" => $items[$k]->title,                        "order" => "0",                        "active" => 1,                    ],                    (object) [                        "id" => 1,                        "parent_id" => $items[$k]->id,                        "lang_id" => $this->langs[0]->id,                        "title" => $items[$k]->abb,                        "order" => "1",                        "active" => 1,                    ],                ];            }            $cts = [                "tables" => [                    ["table" => "ct_titles", "order" => "0", "label" => "Title"],                    ["table" => "ct_titles", "order" => "1", "label" => "Abbreviation"],                ]            ];            $langs = [$this->langs[0]];        } else {            $items = $this->eleModel->getAll([                "type_id" => $typeId,    //            "lang_id" => 1,    //            "row" => 1,                "where" => [["eles", "id", "=", $id]]            ]);            $cts = $this->bindingsModel->typeBindings($typeId, false, $this->langs[0]->id);            $langs = $this->langs;        }        $data = [            "cedit" => 1,            "items" => $items,            "typeId" => $typeId,            "cts" => $cts,            "allCts" => $this->allCts,            "langs" => $langs,            "thisController" => $this,        ];        if ($typeId === '-5') { $data['showMode'] = true; }        loadpage("content/edit", $data, 1, 1);	}	public function new($typeId = "", $n = "") {        define("CEDITBODY", 1);        $type_id = $typeId;        if ($typeId === "-4") {            $cts = [                "eleTitle" => "Users",                "tables" => [                    ["table" => "ct_titles", "order" => "0", "label" => "Username"],                    ["table" => "ct_password", "order" => "0", "label" => "Password", "name" => "new-password-1"],                    ["table" => "ct_password", "order" => "0", "label" => "Repeat Password", "name" => "new-password-2"],                ]            ];            $langs = [$this->langs[0]];        } else if ($typeId === "-3") {            $cts = [                "eleTitle" => "Ele Types",                "tables" => [                    ["table" => "ct_titles", "order" => "0", "label" => "Title"],                ]            ];            $langs = [$this->langs[0]];        } else if ($typeId === "-2") {            $cts = [                "eleTitle" => "Languages",                "tables" => [                    ["table" => "ct_titles", "order" => "0", "label" => "Title"],                    ["table" => "ct_titles", "order" => "1", "label" => "Abbreviation"],                ]            ];            if (isset($this->langs[0])) $langs = [$this->langs[0]];            else {                $nO = new \stdClass();                $nO->id = 3;                $nO->abb = "tr";                $langs = [$nO];            }        } else {            $cts = $this->bindingsModel->typeBindings($type_id, false);            $langs = $this->langs;        }        $data = [//            "cedit" => 1,            "new" => true,            "typeId" => $typeId,            "cts" => $cts,            "langs" => $langs,            "allCts" => $this->allCts,            "thisController" => $this,        ];        loadpage("content/edit", $data, 1, 1);	}	public function edit_save($new = false) {        $data = $_REQUEST;        if (isset($data["new"])) $new = true;        $ret = $this->eleModel->save_cedit([            "type_id" => $data["typeId"],            "data" => $data,        ], $new);        return json_encode($ret);    }	public function delete() {        $data = $_REQUEST;        $ret = $this->eleModel->delete_content([            "type_id" => $data["typeid"],            "data" => $data,        ]);        return json_encode($ret);    }	public function uploadFiles() {        $req = $_REQUEST;        $file = $this->request->getFile('file');        echo $this->eleModel->uploadFiles($req, $file);    }    public function deleteFile() {        $req = $_REQUEST;        echo $this->eleModel->deleteFile($req);    }    public function fetchFiles() {        $req = $_REQUEST;        $where = ["type" => $req["type"]];        if ($req["type"] === "0") $where = [];        $whereIn = [];        if (isset($req["whereIn"])) $whereIn = $req["whereIn"];        $files = $this->db->table("wh_files")            ->where($where);//            ->orderby("id", "desc")                if (count($whereIn) > 0) {            $files->whereIn("id", $whereIn);            $order = sprintf('FIELD(id, %s)', implode(', ', $whereIn));//            echo $order;            if ($whereIn[0] !== "") $files->orderBy($order);//            $files->orderBy("FIELD(id, 97, 95, 90)");        }        $files = $files->get()            ->getResult();        $ret = [];        $ret["success"] = true;        $ret["items"] = $files;        return json_encode($ret);    }    public function translations($ispanel = null) {        $panelStr = ""; if (!empty($ispanel)) { $panelStr = "panel"; }        $file = FCPATH. '/uploads/' . $panelStr . 'lang.json';        $fopen = fopen($file, "r") or die($panelStr . "lang.json not found");        $fread = fread($fopen, filesize($file));        fclose($fopen);        $json = json_decode($fread, true);        $data = [            "lang_array" => $json,            "langs" => $this->langs,            "ispanel" => $ispanel,            "thisController" => $this,        ];        loadpage("content/translations", $data, 1);    }    public function getArrayValueByIndex($index, $ar)    {        $i = -1;        foreach($ar as $k => $d) {            $i++;            if ($index === $i) { return $d; break; }        }    }    public function translations_save() {        $ld = $_REQUEST["ld"];        unset($ld[-1]);        ksort($ld);        $jsonEncoded = json_encode($ld);        $panelStr = ""; if (!empty($_REQUEST["ispanel"])) { $panelStr = "panel"; }        $this->session->set($panelStr . "lang_array", $ld);        $file = FCPATH. '/uploads/' . $panelStr . 'lang.json';        $fopen = fopen($file, "w") or die($panelStr . "lang.json not found");        $fread = fwrite($fopen, $jsonEncoded);        fclose($fopen);        $ret = [          "success" => true        ];        $ret = json_encode($ret);        return $ret;    }    public function catitems_json() {        echo view("panel/content/catItemsJSON.php");    }    public function searchbox_json() {        echo view("panel/content/searchboxJSON.php");    }}