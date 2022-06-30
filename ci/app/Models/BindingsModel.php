<?php namespace App\Models;

use CodeIgniter\Model;

class BindingsModel extends Model
{

    public function __construct(ConnectionInterface &$db = null, ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);

//        $this->eleModel = new EleModel();
    }

    public function typeBindings($type_id, $eI = true, $lang_id = 1) {

        $bindingTables = [];

        if ((int) $type_id === 1) { //Normal ele

            $content = [];

            if (!$eI){


                $content =  $this->db->query("select *, eles.id from eles"
                    . " left join ct_titles on eles.id = ct_titles.parent_id and lang_id = " . $lang_id
                    . " where eles.type_id = 2 and eles.active = 1")
                    ->getResult();

                foreach($content as $k => $d) {
//                    $content["ct_titles"] = $this->db->query("select * from ct_titles where parent_id = " . $d->id)->getResult();
                }
            }

            $bindingTables = [
                ["table" => "ct_categories", "order" => "1", "label" => "Category", "content" => $content],
                ["table" => "ct_titles", "order" => "0", "label" => "Titlea"],
                ["table" => "ct_titles", "order" => "1", "label" => "Titleb"],
                ["table" => "ct_txtbox", "order" => "2", "label" => "Titlec", "labelb" => "heyhey"],
            ];

            /*$bindingTables = $this->db
                ->query("select * from ele_typesbindingtables"
                    ." where type_id = " . $type_id . " and active = 1 order by orderNumber")
                ->getResult();

            echo "<pre>"; print_r($bindingTables); echo "</pre>"; die;*/

            $typeProps = [
                "tables" => $bindingTables,
                "eleTitle" => "Menus",
            ];

        }
        else {

            $bindingTables = [
//                ["table" => "ct_titles", "order" => "0", "label" => "Titlea"],
            ];

            $ele_types_db = $this->db
                ->query("select * from ele_types"
                    ." where id = " . $type_id . " and active = 1")
                ->getResult();

            $bindingTables_db = $this->db
                ->query("select * from ele_typesbindingtables"
                    ." where type_id = " . $type_id . " and active = 1 order by orderNumber")
                ->getResult();

            foreach($bindingTables_db as $k => $d) {

                $curBindingTables = [
                    "table" => $d->tableName,
                    "order" => $d->orderNumber,
                    "label" => $d->label,
                    "labelb" => $d->labelb,
                    "labelc" => $d->labelc,
                ];

                if ($d->tableName === "ct_categories") {

                    $content =  $this->db->query("select *, eles.id from eles"
                        . " left join ct_titles on eles.id = ct_titles.parent_id and lang_id = 8"
                        . " where eles.type_id = " . $d->labelb . " and eles.active = 1"
                        ." group by ct_titles.parent_id order by ct_titles.order")
                        ->getResult();

                    $curBindingTables["content"] = $content;

                }

                $bindingTables[] = $curBindingTables;

            }


            $typeProps = [
                "tables" => $bindingTables,
                "eleTitle" => $ele_types_db[0]->title,
            ];

//            if (defined("NOW")) {
//                echo "<pre>"; print_r($typeProps); echo "</pre>"; die;
//            }

        }

        if ($eI) return $this->eliminateIdenticals($bindingTables);
        else return ($typeProps);
    }

    public function eliminateIdenticals($bindingTables) {

        $eCount = 0;
        $newBindingTables = [];

        foreach($bindingTables as $k => $d) {

            $newBindingTables[] = $d["table"];
        }

        foreach($newBindingTables as $k => $d) {
            $cnt = count(array_keys($newBindingTables, $d));
            if ($cnt > 1) {

                array_splice($newBindingTables, ($k - $eCount), 1);
                $eCount++;
            }
        }

        return $newBindingTables;
    }

}
