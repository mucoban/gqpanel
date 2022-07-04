<div class="cedit">
    <div class="card">
        <div class="card-header card-header-primary">
            <?php
                $duzenlemeStr = 'Edit';
                if (!empty($showMode)) { $duzenlemeStr = ''; }
            ?>
            <h4 class="card-title"><?=!isset($new) ? _dp($duzenlemeStr) : _dp("New") . " " . $cts["eleTitle"] ?></h4>
        </div>
        <div class="card-body">
            <form class="cedit__form" method="post" data-savemode="" data-new="<?=!isset($new) ? "0" : "1" ?>"
                  onsubmit="return fova_cedit(this)"
                action="panel/content/<?=!isset($new) ? "edit_save" : "edit_save/1" ?>"
            >

                <input type="hidden" name="id" value="<?=!isset($new) ? $items[0]->id : "" ?>">
                <input type="hidden" name="typeId" value="<?=$typeId?>">

                <div class="card">
                    <?php if($typeId !== "-2" && $typeId !== "-3" && $typeId !== "-4"){?>
                        <?php if (empty($showMode)) { ?>
                            <div class="card-header card-header-tabs card-header-primary cedit__langbar">
                                <div class="nav-tabs-navigation">
                                    <div class="nav-tabs-wrapper">
                                        <span class="nav-tabs-title"><?=_dp("Languages")?>:</span>
                                        <ul class="nav nav-tabs" data-tabs="tabs">
                                            <?php foreach ($langs as $k => $d) { ?>
                                                <li class="nav-item">
                                                    <a class="nav-link<?=$k === 0 ? " active" : "" ?>" href="#tab-pane-<?=$d->abb?>" data-toggle="tab">
                                                        <?=$d->abb?>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>

                    <div class="card-body">
                        <div class="tab-content js-tab-content">

                            <?php foreach ($langs as $k => $d) { ?>
                                    <div class="tab-pane js-tab-pane<?=$k === 0 ? " active" : "" ?>" id="tab-pane-<?=$d->abb?>">

                                        <?php if(0){?>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group bmd-form-group">
                                                        <label class="bmd-label-floating">Company (disabled)</label>
                                                        <input type="text" class="form-control" disabled="">
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php foreach ($cts["tables"] as $k_b => $d_b) { ?>
                                            <?php
                                            $tableStr = $d_b["table"];
                                            if($tableStr === "ct_titles" && isset($d_b["labelb"]) && $d_b["labelb"] === 'colorpicker'){?>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group bmd-form-group">
                                                            <label class="bmd-label-floating"><?=_dp($d_b["label"])?></label>
                                                            <input type="text" class="form-control js-colorpickerItext"
                                                                   name="<?=$tableStr?>[<?=$d->id?>][<?=$d_b["order"]?>]"
                                                                   value="<?=!isset($new)
                                                                        &&
                                                                       objedengetir($items[0]->{$tableStr}, ["lang_id" => $d->id, "order" => $d_b["order"],], "title") !== null
                                                                       ?
                                                                       objedengetir($items[0]->{$tableStr}, ["lang_id" => $d->id, "order" => $d_b["order"],], "title")
                                                                       : " " ?>">
                                                            <div class="js-colorpicker colpick__rect"
                                                                 style="background-color: <?=!isset($new) ? objedengetir($items[0]->{$tableStr}, ["lang_id" => $d->id, "order" => $d_b["order"],], "title") : "white" ?>"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                                else if($tableStr === "ct_titles"){?>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group bmd-form-group">
                                                            <label class="bmd-label-floating"><?=_dp($d_b["label"])?></label>
                                                            <input type="text" name="<?=$tableStr?>[<?=$d->id?>][<?=$d_b["order"]?>]"
                                                                   value="<?=!isset($new) ? objedengetir($items[0]->{$tableStr}, ["lang_id" => $d->id, "order" => $d_b["order"],], "title") : "" ?>"
                                                                   class="form-control"
                                                                <?=isset($d_b["disabled"]) ? "disabled" : "" ?> >
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                                else if($tableStr === "ct_txtbox"){?>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label><?=_dp($d_b["label"])?></label>
                                                            <div class="form-group bmd-form-group">
                                                                <label class="bmd-label-floating"><?=_dp($d_b["labelb"])?></label>
                                                                <textarea class="form-control" rows="5"  name="<?=$tableStr?>[<?=$d->id?>][<?=$d_b["order"]?>]"
                                                                          <?=isset($d_b["disabled"]) ? "disabled" : "" ?>
                                                                    ><?=!isset($new) ? objedengetir($items[0]->{$tableStr}, ["lang_id" => $d->id, "order" => $d_b["order"],], "value") : "" ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } else if ($tableStr === "ct_categories"){?>
                                                <div class="row js-cedit__selcatsRow row_<?=$tableStr?>">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label><?=_dp($d_b["label"])?></label>
                                                            <br>
                                                            <div class="cedit__selcatsSelectLine">
                                                                <div class="cedit__selcatsSelectOuter">
                                                                    <select class="cedit__selcatsSelect js-cedit__selcatsSelect js-select2">
                                                                        <?php foreach ($d_b["content"] as $k_cat => $d_cat) { ?>
                                                                            <option value="<?=$d_cat->id?>"><?=$d_cat->title?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                                <div class="cedit__selcatsAddbtn js-cedit__selcatsAddbtn">+</div>
                                                            </div>
                                                            <input class="js-cedit__selcatsIhidden" type="hidden"
                                                                   name="<?=$tableStr?>[<?=$d->id?>][<?=$d_b["order"]?>]"
                                                                   value="<?=!isset($new) ? $catValue = objedengetir($items[0]->{$tableStr}, ["order" => $d_b["order"],], "value") : "" ?>">
                                                            <div class="cedit__selcats js-cedit__selcats">
                                                                <div class="cedit__selcatsItem js-cedit__selcatsItem -toBeCopied">
                                                                    <span class="cedit__selcatsItemText">Category A</span>
                                                                    <span class="cedit__selcatsItemRemove js-cedit__selcatsItemRemove">
                                                                        <svg class="cedit__selcatsItemRemoveSvg" xmlns="http://www.w3.org/2000/svg" width="17.456" height="18.371" viewBox="0 0 17.456 18.371">
                                                                            <g id="Group_960" data-name="Group 960" transform="translate(22190.392 12545.919)">
                                                                                <line id="Line_120" data-name="Line 120" y1="17" x2="16" transform="translate(-22189.664 -12545.233)" fill="none" stroke="#120f4a" stroke-width="2"></line>
                                                                                <line id="Line_121" data-name="Line 121" x1="16" y1="17" transform="translate(-22189.664 -12545.233)" fill="none" stroke="#120f4a" stroke-width="2"></line>
                                                                            </g>
                                                                        </svg>
                                                                    </span>
                                                                </div>
                                                                <?php
                                                                if (!isset($new)) {

                                                                    $catValAr = explode("," ,$catValue);

                                                                    if (!(count($catValAr) === 1 && $catValAr[0] === "")) {
                                                                        foreach ($catValAr as $k_catVal => $d_catVal) {
                                                                            $catValItem = objedengetir($d_b["content"], ["id" => $d_catVal,], "title");
                                                                            ?>
                                                                            <div class="cedit__selcatsItem js-cedit__selcatsItem -added" data-index="<?=$d_catVal?>">
                                                                                <span class="cedit__selcatsItemText"><?=$catValItem?></span>
                                                                                <span class="cedit__selcatsItemRemove js-cedit__selcatsItemRemove">
                                                                                <svg class="cedit__selcatsItemRemoveSvg" xmlns="http://www.w3.org/2000/svg" width="17.456" height="18.371" viewBox="0 0 17.456 18.371">
                                                                                    <g id="Group_960" data-name="Group 960" transform="translate(22190.392 12545.919)">
                                                                                        <line id="Line_120" data-name="Line 120" y1="17" x2="16" transform="translate(-22189.664 -12545.233)" fill="none" stroke="#120f4a" stroke-width="2"></line>
                                                                                        <line id="Line_121" data-name="Line 121" x1="16" y1="17" transform="translate(-22189.664 -12545.233)" fill="none" stroke="#120f4a" stroke-width="2"></line>
                                                                                    </g>
                                                                                </svg>
                                                                            </span>
                                                                            </div>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                            else if ($tableStr === "ct_txteditor"){?>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label><?=_dp($d_b["label"])?></label>
                                                            <div>
                                                                <textarea class="js-tinymce" rows="5"
                                                                          name="<?=$tableStr?>[<?=$d->id?>][<?=$d_b["order"]?>]"
                                                                ><?=!isset($new) ? objedengetir($items[0]->{$tableStr}, ["lang_id" => $d->id, "order" => $d_b["order"],], "value") : "" ?></textarea>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                            else if($tableStr === "ct_files") { ?>
                                                <div class="row cedit__imupcRow js-cedit__imupcRow" data-langid="<?=$d->id?>" data-order="<?=$d_b["order"]?>"  data-maxfile="<?=$d_b["labelc"]?>">
                                                    <input type="hidden" name="<?=$tableStr?>[<?=$d->id?>][<?=$d_b["order"]?>]" value="<?=1 && !isset($new) ? objedengetir($items[0]->{$tableStr}, ["lang_id" => $d->id, "order" => $d_b["order"],], "value") : "" ?>">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label><?=_dp($d_b["label"])?></label>
                                                            <div class="cedit__imupcOuter ">
                                                                <div class="cedit__imupc js-cedit__imupc js-sortableImg" data-type="<?=$d_b["labelb"]?>">

                                                                    <?php foreach ([0] as $k_a => $d_a) { ?>
                                                                        <div class="cedit__imupcBox js-cedit__imupcBox <?=$k_a === 0 ? "-toBeCopied" : "-added" ?> <?=$k_a === 1 ? "-mainImg" : "" ?>"
                                                                             data-id="" data-mode="<?=$k_a === 0 ? "1" : "" ?>" data-type="<?=($k_a % 3) + 1?>">
                                                                            <div class="cedit__imupcMiindi">main image</div>
                                                                            <div class="cedit__imupcHlda">
                                                                                <span class="cedit__imupcSbtn -makemain js-makemain">m</span>
                                                                                <span class="cedit__imupcSbtn -order js-order">
                                                                                    <svg class="cedit__imupcSbtnSvg clist__orderbtnsecLinkSvg" height="384pt" viewBox="0 -53 384 384" width="384pt" xmlns="http://www.w3.org/2000/svg"><path d="m368 154.667969h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"/><path d="m368 32h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"/><path d="m368 277.332031h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"/></svg>
                                                                                </span>
                                                                                <span class="cedit__imupcSbtn -change js-change">
                                                                                    <svg class="cedit__imupcSbtnSvg"
                                                                                         version="1.1" id="Capa_1"
                                                                                         xmlns="http://www.w3.org/2000/svg"
                                                                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                         x="0px" y="0px"
                                                                                         viewBox="0 0 341.333 341.333"
                                                                                         style="enable-background:new 0 0 341.333 341.333;"
                                                                                         xml:space="preserve">
<g>
	<g>
		<path d="M341.227,149.333V0l-50.133,50.133C260.267,19.2,217.707,0,170.56,0C76.267,0,0.107,76.373,0.107,170.667
			s76.16,170.667,170.453,170.667c79.467,0,146.027-54.4,164.907-128h-44.373c-17.6,49.707-64.747,85.333-120.533,85.333
			c-70.72,0-128-57.28-128-128s57.28-128,128-128c35.307,0,66.987,14.72,90.133,37.867l-68.8,68.8H341.227z"/>
	</g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
</svg>
                                                                                </span>
                                                                                <span class="cedit__imupcSbtn -remove js-remove">
                                                                                    <svg class="cedit__imupcSbtnSvg" xmlns="http://www.w3.org/2000/svg" width="17.456" height="18.371" viewBox="0 0 17.456 18.371">
                    <g id="Group_960" data-name="Group 960" transform="translate(22190.392 12545.919)">
                        <line id="Line_120" data-name="Line 120" y1="17" x2="16" transform="translate(-22189.664 -12545.233)" fill="none" stroke="#120f4a" stroke-width="2"></line>
                        <line id="Line_121" data-name="Line 121" x1="16" y1="17" transform="translate(-22189.664 -12545.233)" fill="none" stroke="#120f4a" stroke-width="2"></line>
                    </g>
                </svg>
                                                                                </span>
                                                                            </div>
                                                                            <div class="cedit__imupcHldb">
                                                                                <img class="cedit__imupcBimg js-bimg" src="http://piktuscreative.com/zincus/uploads/homeproducts/1601972669f2ba.png" alt="img">
                                                                                <div class="cedit__imupcFdirect">
                                                                                    <img class="cedit__imupcFdirectFicon" src="assets/images/file-icon.svg" alt="icon">
                                                                                    <div class="cedit__imupcFdirectSep"></div>
                                                                                    <a href="" target="_blank" class="cedit__imupcFdirectButona js-view">View</a>
                                                                                    <a href="" target="_blank" class="cedit__imupcFdirectButonb js-download" download>Download</a>
                                                                                </div>
                                                                                <div class="cedit__imupcVideo">
                                                                                    <video class="cedit__imupcVideoIs" controls>
                                                                                        <source class=" js-video" src="" type="video/mp4">
                                                                                        <source class=" js-video" src="" type="video/ogg">
                                                                                        Your browser does not support the video tag.
                                                                                    </video>
                                                                                </div>
                                                                                <div class="cedit__imupcVideo -emv">
                                                                                    <div class="cedit__imupcVideoEminner"></div>
                                                                                    <iframe class="cedit__imupcVideoEmiframe js-emv" width="100" height="100"
                                                                                            src="https://www.youtube.com/embed/x6HZpYpTrEY"
                                                                                            frameborder="0"
                                                                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                                                            allowfullscreen></iframe>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>

                                                                </div>

                                                                <div class="cedit__imupcAdd">
                                                                    <div class="cedit__imupcAddInner">
                                                                        <span class="cedit__imupcAddBtn js-add">
                                                                            <svg class="cedit__imupcAddBtnSvg" xmlns="http://www.w3.org/2000/svg" width="17.456" height="18.371" viewBox="0 0 17.456 18.371">
                                <g id="Group_960" data-name="Group 960" transform="translate(22190.392 12545.919)">
                                    <line id="Line_120" data-name="Line 120" y1="17" x2="16" transform="translate(-22189.664 -12545.233)" fill="none" stroke="#120f4a" stroke-width="2"></line>
                                    <line id="Line_121" data-name="Line 121" x1="16" y1="17" transform="translate(-22189.664 -12545.233)" fill="none" stroke="#120f4a" stroke-width="2"></line>
                                </g>
                            </svg>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                            else if($tableStr === "ct_password"){?>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group bmd-form-group">
                                                            <label class="bmd-label-floating"><?=_dp($d_b["label"])?></label>
                                                            <input type="password"
                                                                   name="<?=$d_b["name"]?>"
                                                                   value="" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>



                                            <?php if($typeId === "-3") { ?>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Ele Bindings</label>
                                                                <div class="eltypeadd js-eltypeadd">
                                                                    <div class="eltypeadd__addline js-eltypeadd__addline">
                                                                        <div class="eltypeadd__addlineInner">
                                                                            <div class="eltypeadd__addlineCol">
                                                                                <div class="eltypeadd__addlineSelectOuter">
                                                                                    <select name="tableName" data-minimum-results-for-search="Infinity" class="eltypeadd__addlineSelect js-select2">
                                                                                        <?php foreach ($allCts as $k => $d) { ?>
                                                                                            <option value="<?=$d["tn"]?>"><?=$d["n"]?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="eltypeadd__addlineCol">
                                                                                <input type="text" class="eltypeadd__addlineItext" name="label" data-name="labela" placeholder="Label">
                                                                            </div>
                                                                            <div class="eltypeadd__addlineCol">
                                                                                <input type="text" class="eltypeadd__addlineItext"  data-name="labelb1" placeholder="labelb">
                                                                                <!-- emir select start BLUE CONTAINER -->
                                                                                <div class="eltypeadd__addlineSelectOuter">
                                                                                    <select class="eltypeadd__addlineSelect js-select2" name="labelb" data-name="labelb2"></select>
                                                                                </div>
                                                                                <!-- emir select end -->
                                                                            </div>
                                                                            <div class="eltypeadd__addlineCol">
                                                                                <input type="text" class="eltypeadd__addlineItext" name="labelc" data-name="labelc" placeholder="labelc">
                                                                            </div>
                                                                        </div>
                                                                        <a class="eltypeadd__addlineAddbtn js-eltypeadd__addlineAddbtn">+</a>
                                                                    </div>
                                                                    <table class="eltypeadd__acont">
                                                                        <thead class="eltypeadd__acont__thead">
                                                                            <tr>
                                                                                <td>Type</td>
                                                                                <td>Label</td>
                                                                                <td>Labelb</td>
                                                                                <td>Labelc</td>
                                                                                <td>Actions</td>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="js-sortable" data-itemstr="eltypeadd" data-dataidstr="data-id">

                                                                            <tr class="eltypeadd__acontItem js-eltypeadd__acontItem -toBeCopied" data-id="<?=0?>">
                                                                                <td class="eltypeadd__acontItemTd -tablenameTd">
                                                                                    <div class="eltypeadd__acontItemIdiv Inlinelabel">a</div>
                                                                                    <input type="text" name="eltypeadd[<?=0?>][tableName]" value="<?=$k?>">
                                                                                </td>
                                                                                <td class="eltypeadd__acontItemTd -labelTd">
                                                                                    <label class="eltypeadd__acontItemTd__mobileLabel Inlinelabel">Label a: </label>
                                                                                    <div class="eltypeadd__acontItemIdiv Inlinelabel js-eltypeadd__acontItemIdiv"></div>
                                                                                    <input type="text" name="eltypeadd[<?=0?>][label]" value="5">
                                                                                    <a class="btn btn-primary btn-link btn-sm eltypeadd__acontItemIdiv js-eltypeadd__acontItemTdEditbtn">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="purple" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                                                                                    </a>
                                                                                </td>
                                                                                <td class="eltypeadd__acontItemTd -labelbTd">
                                                                                    <label class="eltypeadd__acontItemTd__mobileLabel Inlinelabel">Label b: </label>
                                                                                    <div class="eltypeadd__acontItemIdiv Inlinelabel js-eltypeadd__acontItemIdiv"></div>
                                                                                    <input type="text" name="eltypeadd[<?=0?>][labelb]" value="5">
                                                                                    <!-- emir select start COPIED ROW -->
                                                                                    <div class="eltypeadd__addlineSelectOuter labelbHidden">
                                                                                        <select class="eltypeadd__addlineSelect js-select2x" data-minimum-results-for-search="Infinity"></select>
                                                                                    </div>
                                                                                    <!-- emir select end -->
                                                                                    <a class="btn btn-primary btn-link btn-sm eltypeadd__acontItemIdiv js-eltypeadd__acontItemTdEditbtn">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="purple" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                                                                                    </a>
                                                                                </td>
                                                                                <td class="eltypeadd__acontItemTd -labelcTd">
                                                                                    <label class="eltypeadd__acontItemTd__mobileLabel Inlinelabel">Label c: </label>
                                                                                    <div class="eltypeadd__acontItemIdiv Inlinelabel js-eltypeadd__acontItemIdiv"></div>
                                                                                    <input type="text" name="eltypeadd[<?=0?>][labelc]" value="5">
                                                                                    <a class="btn btn-primary btn-link btn-sm eltypeadd__acontItemIdiv js-eltypeadd__acontItemTdEditbtn">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="purple" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                                                                                    </a>
                                                                                </td>
                                                                                <td class="eltypeadd__acontItemTd -acbtn -orderTd">
                                                                                    <a class="eltypeadd__acontItemOrderbtn js-order">
                                                                                        <svg class="eltypeadd__acontItemOrderbtnSvg" height="384pt" viewBox="0 -53 384 384" width="384pt" xmlns="http://www.w3.org/2000/svg"><path d="m368 154.667969h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"/><path d="m368 32h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"/><path d="m368 277.332031h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"/></svg>
                                                                                    </a>
                                                                                    <input type="text" name="eltypeadd[0][orderNumber]" value="<?=0?>">
                                                                                </td>
                                                                                <td class="eltypeadd__acontItemTd -acbtn">
                                                                                    <a class="eltypeadd__acontItemRemovebtn js-eltypeadd__acontItemRemovebtn">
                                                                                        <svg class="eltypeadd__acontItemRemovebtnSvg" height="329pt" viewBox="0 0 329.26933 329" width="329pt" xmlns="http://www.w3.org/2000/svg"><path d="m194.800781 164.769531 128.210938-128.214843c8.34375-8.339844 8.34375-21.824219 0-30.164063-8.339844-8.339844-21.824219-8.339844-30.164063 0l-128.214844 128.214844-128.210937-128.214844c-8.34375-8.339844-21.824219-8.339844-30.164063 0-8.34375 8.339844-8.34375 21.824219 0 30.164063l128.210938 128.214843-128.210938 128.214844c-8.34375 8.339844-8.34375 21.824219 0 30.164063 4.15625 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921875-2.089844 15.082031-6.25l128.210937-128.214844 128.214844 128.214844c4.160156 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921874-2.089844 15.082031-6.25 8.34375-8.339844 8.34375-21.824219 0-30.164063zm0 0"/></svg>
                                                                                    </a>
                                                                                </td>
                                                                            </tr>

                                                                            <?php if (!isset($new)) { ?>
                                                                                <?php foreach ($items[0]->eltypeadd as $k => $d) { ?>
                                                                                    <tr class="eltypeadd__acontItem js-eltypeadd__acontItem -added" data-id="<?=$d->id?>">
                                                                                        <td class="eltypeadd__acontItemTd -tablenameTd">
                                                                                            <label class="eltypeadd__acontItemTd__mobileLabel Inlinelabel">Type: </label>
                                                                                            <div class="eltypeadd__acontItemIdiv Inlinelabel"><?=objedengetirArray($allCts, ["tn" => $d->tableName], "n")?></div>
                                                                                            <input type="text" name="eltypeadd[<?=$d->id?>][tableName]" value="<?=$d->tableName?>">
                                                                                        </td>
                                                                                        <td class="eltypeadd__acontItemTd -labelTd -editOnx">
                                                                                            <label class="eltypeadd__acontItemTd__mobileLabel Inlinelabel">Label a: </label>
                                                                                            <div class="eltypeadd__acontItemIdiv Inlinelabel js-eltypeadd__acontItemIdiv"><?=$d->label?></div>
                                                                                            <input type="text" name="eltypeadd[<?=$d->id?>][label]" value="<?=$d->label?>">
                                                                                            <a class="btn btn-primary btn-link btn-sm eltypeadd__acontItemIdiv js-eltypeadd__acontItemTdEditbtn">
                                                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="purple" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                                                                                            </a>

                                                                                        </td>
                                                                                        <td class="eltypeadd__acontItemTd -labelbTd">
                                                                                            <label class="eltypeadd__acontItemTd__mobileLabel Inlinelabel">Label b: </label>
                                                                                            <!-- <div class="eltypeadd__acontItemIdiv Inlinelabel js-eltypeadd__acontItemIdiv"><?=$d->labelb?></div>   PREV CODE -->
                                                                                            <div class="eltypeadd__acontItemIdiv Inlinelabel js-eltypeadd__acontItemIdiv"><?php
                                                                                                if ($d->tableName !== "ct_files") {echo $d->labelb;}
                                                                                                else if ($d->labelb == "0") { echo "All";  }
                                                                                                else if ($d->labelb == "1") { echo "Images";  }
                                                                                                else if ($d->labelb == "2") { echo "Files";  }
                                                                                                else if ($d->labelb == "3") { echo "Videos";  } ?></div>
                                                                                            <input type="text" name="eltypeadd[<?=$d->id?>][labelb]" value="<?=$d->labelb?>">
                                                                                            <!-- emir select start INITIAL ROW -->
                                                                                            <div class="eltypeadd__addlineSelectOuter labelbHidden">
                                                                                            <select class="eltypeadd__addlineSelect js-select2" data-minimum-results-for-search="Infinity" value="<?=$d->labelb?>"></select>
                                                                                            </div>
                                                                                            <!-- emir select end -->

                                                                                            <a class="btn btn-primary btn-link btn-sm eltypeadd__acontItemIdiv js-eltypeadd__acontItemTdEditbtn">
                                                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="purple" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                                                                                            </a>
                                                                                        </td>
                                                                                        <td class="eltypeadd__acontItemTd -labelcTd">
                                                                                            <label class="eltypeadd__acontItemTd__mobileLabel Inlinelabel">Label c: </label>
                                                                                            <div class="eltypeadd__acontItemIdiv Inlinelabel js-eltypeadd__acontItemIdiv"><?=$d->labelc?></div>
                                                                                            <input type="text" name="eltypeadd[<?=$d->id?>][labelc]" value="<?=$d->labelc?>">
                                                                                            <a class="btn btn-primary btn-link btn-sm eltypeadd__acontItemIdiv js-eltypeadd__acontItemTdEditbtn">
                                                                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="purple" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                                                                                            </a>
                                                                                        </td>
                                                                                            <td class="eltypeadd__acontItemTd -acbtn -orderTd">
                                                                                                <a class="eltypeadd__acontItemOrderbtn js-order">
                                                                                                    <svg class="eltypeadd__acontItemOrderbtnSvg" height="384pt" viewBox="0 -53 384 384" width="384pt" xmlns="http://www.w3.org/2000/svg"><path d="m368 154.667969h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"/><path d="m368 32h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"/><path d="m368 277.332031h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"/></svg>
                                                                                                </a>
                                                                                                <input type="text" name="eltypeadd[<?=$d->id?>][orderNumber]" value="<?=$d->orderNumber?>">
                                                                                            </td>
                                                                                            <td class="eltypeadd__acontItemTd -acbtn">
                                                                                                <a class="eltypeadd__acontItemRemovebtn js-eltypeadd__acontItemRemovebtn">
                                                                                                    <svg class="eltypeadd__acontItemRemovebtnSvg" height="329pt" viewBox="0 0 329.26933 329" width="329pt" xmlns="http://www.w3.org/2000/svg"><path d="m194.800781 164.769531 128.210938-128.214843c8.34375-8.339844 8.34375-21.824219 0-30.164063-8.339844-8.339844-21.824219-8.339844-30.164063 0l-128.214844 128.214844-128.210937-128.214844c-8.34375-8.339844-21.824219-8.339844-30.164063 0-8.34375 8.339844-8.34375 21.824219 0 30.164063l128.210938 128.214843-128.210938 128.214844c-8.34375 8.339844-8.34375 21.824219 0 30.164063 4.15625 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921875-2.089844 15.082031-6.25l128.210937-128.214844 128.214844 128.214844c4.160156 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921874-2.089844 15.082031-6.25 8.34375-8.339844 8.34375-21.824219 0-30.164063zm0 0"/></svg>
                                                                                                </a>
                                                                                            </td>
                                                                                    </tr>
                                                                                <?php } ?>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <?php }  ?>

                                        <?php } ?>
                                    </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>



                <?php if (empty($showMode)) { ?>
                    <button type="submit" class="btn btn-primary pull-right float-right cedit__submitbtn">
                        <span class="cedit__submitbtnNormal"><?=!isset($new) ? _dp("SAVE") : _dp("OLUŞTUR") ?></span>
                        <span class="cedit__submitbtnOngoing">
                         <div class="prelO">
                                    <div class="prel">
                                        <div class="lds-ring">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                    </div>
                        </div>
                     </span>
                        <span class="cedit__submitbtnDone">Ok</span>
                    </button>
                <?php } ?>

                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>
<script>

    var langs = [<?php
        foreach ($langs as $k => $d) { ?>{<?php
        foreach ($d as $k_b => $d_b) { ?><?="" . $k_b . ": '" . $d_b . "',"?><?php
        } ?>},<?php
        } ?>];

</script>
