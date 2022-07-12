<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class EleModel extends Model
{
    protected $type_id;
    protected $lang_id;
    protected $bindingTables;
    protected $sql;
    protected $langs;
    protected $allCts;

    public function __construct(ConnectionInterface &$db = null, ValidationInterface $validation = null,
                                $langs, $allCts)
    {

        parent::__construct($db, $validation);

        $this->bindiginsModel = new BindingsModel();

        $this->langs = $langs;
        $this->allCts = $allCts;

    }

    public function getAll($ar = null) {

        $this->type_id = $ar["type_id"];

        $selectCtsLangid = false;
        $onlyTitle = false;

        if (isset($ar["lang_id"])) {
            $selectCtsLangid = $this->lang_id = $ar["lang_id"];
        }

        if (isset($ar["onlyTitle"])) {
            $onlyTitle = true;
        }

        $this->bindingTables = $this->bindiginsModel->typeBindings($this->type_id);

        $this->sql = 'SELECT';

        if (!isset($ar["count"])) { $this->sql .= " *, eles.id, eles.active"; }
        else { $this->sql .= " COUNT(eles.id)"; }

        $this->sql .= ' FROM eles';

        /*********************************************/

        if (isset( $ar["where"])) {
            $car = $ar["where"];
            foreach($car as $k => $d) {
                if ($d[0] !== "eles") { $this->sql .= ", " . $d[0]; }
            }
        }

        $this->sql .= " where eles.type_id = " . $this->type_id;

        if (isset( $ar["where"])) {
            $car = $ar["where"];

            foreach($car as $k => $d) {

                if ($d[0] !== "eles") { $this->sql .= " and eles.id = " .  $d[0] . ".parent_id"; }
                if ($d[0] !== "eles" && isset($d[4])) {
                    $this->sql .= " and " . $d[0] . ".order = " . $d[4];
                }

                $this->sql .= " and " . $d[0] . "." . $d[1] . " " . $d[2] . " " . $d[3] ;
            }
        }

        /*********************************************/

        if (isset($ar["groupby"])) {
            $this->sql .= " group by eles.id";
        }

        /*********************************************/

        if (isset($ar["groupbyB"])) {
            $this->sql .= " group by " . $ar["groupbyB"];
        }

        /*********************************************/

        if (isset($ar["orderby"])) {
            $this->sql .= " order by " . $ar["orderby"];
        }

        /*********************************************/

        if (isset($ar["limit"])) {
            $this->sql .= " limit " . $ar["limit"];
        }

        /*********************************************/

        if (defined("NOW2")) {
            echo "<pre>"; print_r($this->sql); echo "</pre>"; die;
        }

        $query = $this->db->query($this->sql);
        if (!isset($ar["row"])) $eles = $query->getResult();
        else $eles = $query->getRow();

        /*********************************************/

        $orderby = $ar["orderby"] ?? null ;

        $eles = $this->selectCts($eles, $selectCtsLangid, $onlyTitle,
            $orderby);

        /*********************************************/

        return $eles;

    }

    protected function save_cedit_eleTypes($ar = null, $new = false) {

        $ar = $ar["data"];

        $builder = $this->db->table("ele_types");

        $data = [];
        $insertedEltypeadds = [];

        if (isset($ar["active"])) { $data["active"] = $ar["active"]; }
        if (isset($ar["ct_titles"])) {

            $a = array_shift($ar["ct_titles"]);
            foreach($a as $k => $d) {
                if ($k === 0) $data["title"] = $d;
            }
        }

        $type_id = 0;

        if ($new) {

            if (count($data) > 0) {

                $nOrder = $this->db->table("ele_types")
                    ->selectMax("orderNumber")->get()->getResult();

                if (isset($nOrder[0])) {
                    $num = $nOrder[0]->orderNumber;
                    $data["orderNumber"] = $num + 1;
                } else {
                    $data["orderNumber"] = 1;
                }

                $this->db->table("ele_types")->insert($data);
                $insertId = $this->db->insertID();
                $type_id = $insertId;
            }

        } else {

            $type_id = $ar["id"];
            $builder->where(['id' => $ar["id"]]);

            if (count($data) > 0) {

                $builder->update($data);
            }
        }

        /*********************************************/

        $all_eltypeadd_ids = [];

        if (isset($ar["eltypeadd"])) {

            $relatedCtsOrderHandle =
                $this->db
                    ->query(
                        "select"
                        . " etbt.id,"
                        . " etbt.type_id,"
                        . " etbt.tableName,"
                        . " etbt.orderNumber,"
                        . " etbt.active,"
                        . " eles.id as eles_id"
                        . " from ele_typesbindingtables as etbt"
                        . " left join eles on eles.type_id = etbt.type_id"
                        . " where etbt.type_id = " . $type_id
                    )
                    ->getResult();

            foreach($relatedCtsOrderHandle as $k => $d) {

                $relatedCtsOrderHandle[$k]->childs_ids = $this->db
                    ->table($d->tableName)
                    ->select("id")
                    ->where(["parent_id" => $d->eles_id, "order" => $d->orderNumber])
                    ->get()
                    ->getResult();
            }

            foreach($ar["eltypeadd"] as $k => $d) {

                if ($k < 0) {

                    $d["type_id"] = $type_id;

                    $builder = $this->db->table("ele_typesbindingtables");
                    $builder->insert($d);

                    $insertedEltypeadds[$k] = $this->db->insertID();
                    $all_eltypeadd_ids[] = $insertedEltypeadds[$k];

                    /*********************************************/

                    $elesforRoh = $this->db
                        ->table("eles")->where(["type_id" => $type_id])->get()->getResult();

                    foreach($elesforRoh as $k_eroh => $d_eroh) {

                        foreach($this->langs as $k_langs => $d_langs) {
                            $this->db
                                ->table($d["tableName"])->insert([
                                    "lang_id" => $d_langs->id,
                                    "parent_id" => $d_eroh->id,
                                    "order" => $d["orderNumber"],
                                ]);
                        }
                    }

                    /*********************************************/

                } else if ($k > 0) {

                    $d["type_id"] = $type_id;

                    /*********************************************/

                    $builder = $this->db->table("ele_typesbindingtables");
                    $builder->update($d, ["id" => $k]);
                    $all_eltypeadd_ids[] = $k;

                }

            }
            foreach($relatedCtsOrderHandle as $k_roh => $d_roh) {

                if (isset($ar["eltypeadd"][$d_roh->id])) {

                    $newOrder = $ar["eltypeadd"][$d_roh->id]["orderNumber"];

                    $relatedCtsOrderHandle[$k_roh]->newOrder = $newOrder;

                    $childs_ids = [];

                    foreach($d_roh->childs_ids as $k_cids => $d_cids) {
                        $childs_ids[] = $d_cids->id;
                    }

                    $relatedCtsOrderHandle[$k_roh]->childs_ids = $childs_ids;

                    if (!count($childs_ids)) $childs_ids = [-99];

                    $this->db->table($d_roh->tableName)
                        ->whereIn("id", $childs_ids)
                        ->update(["order" => $newOrder]);
                }



            }
        }

        $curBindingTables = [];

        if (count($all_eltypeadd_ids)) {

            $curBindingTables =
            $this->db
                ->table("ele_typesbindingtables")
                ->where("type_id", $type_id)
                ->whereNotIn("id", $all_eltypeadd_ids)
                ->get()
                ->getResult();

            $this->db
                ->table("ele_typesbindingtables")
                ->where("type_id", $type_id)
                ->whereNotIn("id", $all_eltypeadd_ids)
                ->delete();

        } else {

            $curBindingTables[] = "delAll";

            $this->db
                ->table("ele_typesbindingtables")
                ->where("type_id", $type_id)
                ->delete();
        }

        /*********************************************/

        $curEles = $this->db->table("eles")->where(["type_id" => $type_id])->get()->getResult();

        foreach($curEles as $k_cel => $d_cel) {

            if (isset($curBindingTables[0]) && $curBindingTables[0] === "delAll") {

                foreach ($this->allCts as $k_cbt => $d_cbt) {

                    $this->db->table($d_cbt["tn"])
                        ->where([
                            "parent_id" => $d_cel->id,
                        ])
                        ->delete();

                }

            } else {

                foreach($curBindingTables as $k_cbt => $d_cbt) {

                    $this->db->table($d_cbt->tableName)
                        ->where([
                            "parent_id" => $d_cel->id,
                            "order" => $d_cbt->orderNumber,
                        ])
                        ->delete();
                }

            }
        }

        /*********************************************/

        $ret = [
            "success" => true,
            "insertedEltypeadds" => $insertedEltypeadds,
        ];
        if ($new) $ret["id"] = $insertId;

        return $ret;

    }

    protected function save_cedit_users($ar = null, $new = false) {

        $data = [];

        $arData = $ar["data"];

        $lang_id = $this->langs[0]->id;

        if (isset($arData["ct_titles"][$lang_id][0])) {

            $title = $arData["ct_titles"][$lang_id][0];
            $data["username"] = $title;

        }

        if (!empty($arData["new-password-1"]) && !empty($arData["new-password-1"])) {

            if ($arData["new-password-1"] === $arData["new-password-2"]) {

                $passHashed = password_hash($arData["new-password-1"], PASSWORD_BCRYPT);
                $data["pass"] = $passHashed;

            } else {

                $ret["success"] = false;
                $ret["err"] = "Passwords doesn't match";
                return $ret;

            }

        }



        if ($new) {

            $this->db->table("users")
                ->insert($data);
            $insertId = $this->db->insertID();

        } else {

            $this->db->table("users")
                ->where(["id" => $arData["id"]])
                ->update($data);

        }

        $ret["success"] = true;
        if ($new) $ret["id"] = $insertId;
        $ret["data"] = $data;
//        $ret["ar"] = $arData;
        return $ret;


    }

    protected function save_cedit_language($ar = null, $new = false) {

//        echo "<pre>"; print_r($ar); echo "</pre>"; die;

        $ar = $ar["data"];

        $builder = $this->db->table("langs");

        $data = [];

        if (isset($ar["active"])) { $data["active"] = $ar["active"]; }
        if (isset($ar["ct_titles"])) {
            $a = array_shift($ar["ct_titles"]);

            foreach($a as $k => $d) {
                if ($k === 0) $data["title"] = $d;
                else if ($k === 1) $data["abb"] = $d;
            }
        }

        if ($new) {

            if (count($data) > 0) {

                $nOrder = $this->db->table("langs")
                    ->selectMax("order")->get()->getResult();

                if (isset($nOrder[0])) {
                    $num = $nOrder[0]->order;
                    $data["order"] = $num + 1;
                } else {
                    $data["order"] = 1;
                }

//                echo " data:<pre>"; print_r($data); echo "</pre>"; die;

                $builder->insert($data);
                $insertId = $this->db->insertID();

                $lang_id = $insertId;

                /*********************************************/

                $ele_typesbindingtables = $this->db->table("ele_typesbindingtables")->get()->getResult();

                foreach($ele_typesbindingtables as $k => $d) {

                    $eles = $this->db->table("eles")
                        ->where(["type_id" => $d->type_id])
                        ->get()->getResult();

                    foreach($eles as $k_eles => $d_eles) {

                        $car = [
                            "parent_id" => $d_eles->id,
                            "lang_id" => $lang_id,
                            "order" => $d->orderNumber,
                        ];

//                        echo " car:<pre>"; print_r($car); echo "</pre>";

                        $this->db
                            ->table($d->tableName)
                            ->insert($car);

                    }

                }

                /*********************************************/

            }

        } else {

            $builder->where(['id' => $ar["id"]]);

            if (count($data) > 0) {
                $builder->update($data);
            }
        }

        $ret = ["success" => true];
        if ($new) $ret["id"] = $insertId;

        return $ret;


    }

    protected function save_cedit_clistit($ar = null) {

        if (isset($ar["clistit"])) {

            $tableStr = "eles";
            $fieldStr = "orderNumber";
            if ($ar["typeId"] === "-2") { $tableStr = "langs"; $fieldStr = "order"; }
            else if ($ar["typeId"] === "-3") { $tableStr = "ele_types"; $fieldStr = "orderNumber"; }

            foreach($ar["clistit"] as $k => $d) {

//                echo " tableStr: " . $tableStr;
//                echo " fieldStr: " . $fieldStr;
//                echo " " . $k . " d:<pre>"; print_r($d); echo "</pre>";
//                die;

                $this->db->table($tableStr)
                    ->where(["id" => $k])
//                    ->update(["active" => 1]);
                    ->update([$fieldStr => $d["orderNumber"]]);

            }
        }

        $ret = ["success" => true];

        return $ret;
    }

    public function save_cedit($ar = null, $new = false) {

        $this->type_id = $ar["type_id"];
        $ar_data = $ar["data"];

        /*********************************************/

        if (isset($ar_data["clistit"])) return $this->save_cedit_clistit($ar_data);

        /*********************************************/

        if ( $this->type_id === "-4") {
            return $this->save_cedit_users($ar, $new);
        } else if ( $this->type_id === "-3") {
            return $this->save_cedit_eleTypes($ar, $new);
        } else if ( $this->type_id === "-2") {
            return $this->save_cedit_language($ar, $new);
        }

        /*********************************************/


        $builder = $this->db->table("eles");
        $insertId = null;

        if ($new) {

            $insdata = [
                "active" => "1",
                "type_id" => $this->type_id,
            ];

            $nOrder = $this->db->table("eles")
                ->selectMax("orderNumber")
                ->where(["type_id" => $this->type_id,])
                ->get()->getResult();

            if (isset($nOrder[0])) {
                $num = $nOrder[0]->orderNumber;
                $insdata["orderNumber"] = $num + 1;
            } else {
                $insdata["orderNumber"] = 1;
            }

            $this->db->table("eles")->insert($insdata);

            $insertId = $this->db->insertID();

        } else if (isset($ar_data["id"])) {

            $builder->where(['id' => $ar_data["id"]]);
            $data = [];
            if (isset($ar_data["active"])) { $data["active"] = $ar_data["active"]; }

            if (count($data) > 0) {
                $builder->update($data);
            }

        }

        /*********************************************/

        $this->bindingTables = $this->bindiginsModel->typeBindings($this->type_id);

        foreach($this->bindingTables as $k => $d) {

                $langs = $this->langs;

                foreach($langs as $k_b => $d_b) {

                    $clang_id = $d_b->id;

                    $builder = $this->db->table($d);

                    if (isset($ar_data[$d][$clang_id])) {

                        foreach($ar_data[$d][$clang_id] as $k_c => $d_c) {

                            $data = [];

                            $fieldStr = null;
                            if ($d === "ct_titles") $fieldStr = "title"; else $fieldStr = "value";
                            if ($d === "ct_txtbox") { $d_c = str_replace(PHP_EOL, '<br>',$d_c); }

                            $data[$fieldStr] = $d_c;

                            if ($new) {
                                $data["parent_id"] = $insertId;
                                $data["lang_id"] = $clang_id;
                                $data["order"] = $k_c;
                                $builder->insert($data);

                            } else {
                                $builder->where(['parent_id' => $ar_data["id"], 'lang_id' => $clang_id, 'order' => $k_c]);
                                $builder->update($data);

                                if ($d === "ct_files") {
                                }
                            }
                        }

                    }

                }

        }

        $ret = ["success" => true];
        if ($new) $ret["id"] = $insertId;

        return $ret;

    }

    public function delete_content($ar = null) {

        $this->type_id = (int) $ar["type_id"];

        $ar_data = $ar["data"];

        /*********************************************/

        if ($this->type_id === -5) {

            $this->db->table("inbox")
                ->delete(["id" => $ar["data"]["id"]]);

        } else if ($this->type_id === -4) {

            $this->db->table("users")
                ->delete(["id" => $ar["data"]["id"]]);

        } else if ($this->type_id === -3) {

            $type_id = $ar_data["id"];

            /*********************************************/

            $eles = $this->db->table("eles")
                ->where(["type_id" => $type_id])
                ->get()->getResult();

            $ele_typesbindingtables = $this->db->table("ele_typesbindingtables")
                ->where(['type_id' => $type_id])
                ->get()
                ->getResult();

            foreach($eles as $k_e => $d_e) {

                foreach($ele_typesbindingtables as $k_tbt => $d_tbt) {

                    $this->db->table($d_tbt->tableName)
                        ->where(['parent_id' => $d_e->id])
                        ->delete();
//                        ->getResult();

//                    echo "del:" . ($this->db->getLastQuery());
                }

            }

            /*********************************************/

            $this->db->table("eles")
                ->where(["type_id" => $type_id])
                ->delete();

            $builder = $this->db->table("ele_types");
            $builder->delete(['id' => $type_id]);

            $builder = $this->db->table("ele_typesbindingtables");
            $builder->delete(['type_id' => $type_id]);

        } else if ($this->type_id === -2) {

            $builder = $this->db->table("langs");

            $lang_id = $ar_data["id"];

            /*********************************************/

            $ele_typesbindingtables = $this->db->table("ele_typesbindingtables")
                ->get()
                ->getResult();

            foreach($ele_typesbindingtables as $k_tbt => $d_tbt) {

                $eles = $this->db->table("eles")
                    ->where(["type_id" => $d_tbt->type_id])
                    ->get()->getResult();

                foreach($eles as $k_e => $d_e) {

                    $this->db->table($d_tbt->tableName)
                        ->where([
                            'parent_id' => $d_e->id,
                            'lang_id' => $lang_id,
                        ])
                        ->delete();
//                        ->getResult();

//                    echo "del:" . ($this->db->getLastQuery());
                }

            }

            /*********************************************/

            $builder->delete(['id' => $lang_id]);

        } else {

            $builder = $this->db->table("eles");

            $builder->delete(['id' => $ar_data["id"]]);

//        echo ($this->db->getLastQuery()); die;

            /*********************************************/

            $this->bindingTables = $this->bindiginsModel->typeBindings($this->type_id);

            foreach($this->bindingTables as $k => $d) {

                $builder = $this->db->table($d);
                $builder->delete(['parent_id' => $ar_data["id"]]);

            }
        }


        $ret = [
            "success" => true,
            "id" => $ar_data["id"],
        ];

        return $ret;

    }

    /*********************************************/

    protected function addToSqlTypeBindings() {

        foreach($this->bindingTables as $k => $d) {

                $this->sql .= ' LEFT JOIN ' . $d . ' on eles.id = ' .
                    $d . '.parent_id and ' . $d . '.active = 1';

                if (isset($this->lang_id)) {
                    $this->sql .= ' and ' . $d . '.lang_id = ' . $this->lang_id;
                }

        }

    }

    protected function selectCts($eles, $selectCtsLangid, $onlyTitle, $orderby = null) {

        foreach($eles as $k_a => $d_a) {

            $firstCtTitlesSwitch = false;

            foreach($this->bindingTables as $k => $d) {

                if (isset($d_a->id)) {

                    if ($onlyTitle === false || ($onlyTitle === true && $firstCtTitlesSwitch === false && $d === "ct_titles")) {

                        if ($d === "ct_titles") $firstCtTitlesSwitch = true;
                        $sql = "select * from " . $d . " where parent_id = " . $d_a->id;

                        if ($selectCtsLangid !== false) {
                            $sql .= " and lang_id = " . $selectCtsLangid;
                            if ($orderby !== null) $sql  .= " order by `order`";
                        }
                        if ($onlyTitle !== false) {
                            if ($orderby === null) $sql  .= " order by `order`";
                            $sql .= " limit 3";
                        }


                        $query = $this->db->query($sql);
                        $res = $query->getResult();

                        if (isset($res[2]->title) && strstr($res[2]->title, 'parent-')) {
                            $res[0]->parent_list_item = str_replace('parent-', '', $res[2]->title);
                        }

                        if (defined("NOW")) {
                            echo "<pre>"; print_r($res); echo "</pre>"; die;
                        }
                        $eles[$k_a]->{$d} = $res;
                    }

                }
            }
        }

        return $eles;
    }

    /*********************************************/

    public function uploadFiles($req = null, $file = null) {

//        $files = $this->request->getFiles();
//        $file = $this->request->getFile('file.8');

        $ret = [];
        $ret["success"] = true;
        $ret["err"] = "";

//        echo "<pre>"; print_r($file); echo "</pre>"; die;

        /*********************************************/

        if (isset($_REQUEST["eviurl"])) {

            $eviurl = str_replace("youtube.com/watch?v=", "youtube.com/embed/", $_REQUEST["eviurl"]);

            $this->db->table("wh_files")->insert([
                "file_name" => $eviurl,
                "embed_url" => 1,
                "type" => 3,
                "datetime" => date("Y-m-d H:i:s"),
            ]);

            $insertId = $this->db->insertID();

            $insert_data = [
                "id" => $insertId,
                "file_name" => substr($eviurl, -10),
                "size" => "",
                "type" => 3,
                "embed_url" => $eviurl,
                "datetime" => date("Y-m-d H:i:s"),
                "dimension" => "",
            ];

            $ret["success"] = true;
            $ret["err"] = "";
            $ret["insert_data"] = $insert_data;
            return json_encode($ret);
        }

        /*********************************************/



        if (! $file->isValid())
        {
//            throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
            $ret["success"] = false;
            $ret["err"] = $file->getErrorString() . " - " . $file->getError();
            return json_encode($ret);
        }

        $ext = $file->getClientExtension();

        $extentionsPic = [
            "svg",
            "png",
            "jpg",
            "jpeg",
            "PNG",
            "JPG",
            "JPEG",
        ];

        $extentionsFile = [
            "rar",
            "zip",
            "pdf",
            "xls",
            "xlsx",
            "csv",
            "doc",
            "docx",
        ];

        $extentionsVideo = [
            "mp4",
            "ogg",
            "3gp",
        ];

        $type = 0;

        if ($req["type"] === "1" && array_search($ext, $extentionsPic) !== false) { $type = 1; }
        else if ($req["type"] === "2" && array_search($ext, $extentionsFile) !== false) { $type = 2; }
        else if ($req["type"] === "3" && array_search($ext, $extentionsVideo) !== false) { $type = 3; }
        else if ($req["type"] === "0" && array_search($ext, $extentionsPic) !== false) { $type = 1; }
        else if ($req["type"] === "0" && array_search($ext, $extentionsFile) !== false) { $type = 2; }
        else if ($req["type"] === "0" && array_search($ext, $extentionsVideo) !== false) { $type = 3; }
        else {
            $ret["success"] = false;
            $ret["err"] = "Extension \"" . $ext . "\" is not allowed";
            return json_encode($ret);
        }

        $newName = $file->getRandomName();
        $path = (FCPATH.'uploads/files');

        if ($file->isValid() && ! $file->hasMoved())
        {
            $file->move($path, $newName);
        } else {
            $ret["success"] = false;
            $ret["err"] = "dosya yüklenemedi";
            return json_encode($ret);
        }

        $insert_data = [
            "file_name" => $newName,
            "size" => number_format($file->getSizeByUnit('mb'), "2"),
            "type" => $type,
            "datetime" => date("Y-m-d H:i:s"),
            "dimension" => "",
        ];

//        echo " insert_data:<pre>"; print_r($insert_data); echo "</pre>"; die;

        $this->db->table("wh_files")
            ->insert($insert_data);

        $insert_data["id"] = $this->db->insertID();

        $ret["success"] = true;
        $ret["err"] = "";
        $ret["insert_data"] = $insert_data;
        return json_encode($ret);

    }

    public function deleteFile($req = null) {

        $db_data = $this->db->table("wh_files")
            ->where(["id" => $req["id"]])
            ->get()->getResult();

        if (count($db_data) && file_exists(FCPATH . "/uploads/files/" . $db_data[0]->file_name)) {
            unlink(FCPATH . "/uploads/files/" . $db_data[0]->file_name);
        }

        $this->db->table("wh_files")
            ->where(["id" => $req["id"]])
            ->delete();

        $ret = [];
        $ret["success"] = true;
        $ret["err"] = "";
        return json_encode($ret);

    }

}
