<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <form class="" method="get" data-savemode="" data-new="0"
                          onsubmit="return fova_cedit(this)"
                          action="panel/content/edit_save"
                    >
                        <input type="hidden" name="typeId" value="<?=$typeId?>">

                        <div class="card-body">
                            <h4 class="card-body-title"><?=$cts["eleTitle"]?></h4>
                            <div class="table-responsive clist js-clist" data-mode="saving">

                            <div>
                                    <?php if(!strstr($_SERVER['REQUEST_URI'], '/-4/users') && (empty($showMode))){?>
                                        <button type="button" class="btn btn-primary pull-right float-right js-clist_newbtn">
                                            <span><?=_dp("NEW")?></span>
                                        </button>
                                    <?php } ?>

                                </div>

                                <div class="input-group no-border clist__search">
                                    <input type="text" value="" class="form-control js-clist__searchItext" placeholder="<?=_dp("Search")?>">
                                    <button type="submit" class="btn btn-white btn-round btn-just-icon js-clist__searchBtn">
                                        <i class="material-icons">search</i>
                                        <div class="ripple-container"></div>
                                    </button>
                                </div>


                                <?php if(0){?>
                                    <div class="pagi">

                                        <div class="pagi__numbers js-pagi__numbers">
                                            <a class="pagi__numbersFl -first">
                                                <svg class="pagi__numbersSvg -first" xmlns="http://www.w3.org/2000/svg" width="75" height="85.737" viewBox="0 0 75 85.737">
                                                    <g id="Group_1" data-name="Group 1" transform="translate(-552.382 -427.81)">
                                                        <g id="angle-arrow-down" transform="translate(445.999 517.547) rotate(-90)">
                                                            <path id="Path_1" data-name="Path 1" d="M84.88,64.536l-4.3-4.295a2.7,2.7,0,0,0-3.952,0L42.869,94,9.106,60.242a2.7,2.7,0,0,0-3.952,0l-4.295,4.3a2.7,2.7,0,0,0,0,3.951l40.033,40.034a2.7,2.7,0,0,0,3.951,0L84.88,68.489a2.708,2.708,0,0,0,0-3.953Z" transform="translate(4 72)" fill="#ccc"/>
                                                            <path id="Path_2" data-name="Path 2" d="M84.88,64.536l-4.3-4.295a2.7,2.7,0,0,0-3.952,0L42.869,94,9.106,60.242a2.7,2.7,0,0,0-3.952,0l-4.295,4.3a2.7,2.7,0,0,0,0,3.951l40.033,40.034a2.7,2.7,0,0,0,3.951,0L84.88,68.489a2.708,2.708,0,0,0,0-3.953Z" transform="translate(4 47)" fill="#ccc"/>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </a>
                                            <a class="pagi__numbersFl -prev">
                                                <svg class="pagi__numbersSvg -prev" xmlns="http://www.w3.org/2000/svg" width="50" height="85.737" viewBox="0 0 50 85.737">
                                                    <g id="angle-arrow-down" transform="translate(-59.382 85.737) rotate(-90)">
                                                        <path id="Path_1" data-name="Path 1" d="M84.88,64.536l-4.3-4.295a2.7,2.7,0,0,0-3.952,0L42.869,94,9.106,60.242a2.7,2.7,0,0,0-3.952,0l-4.295,4.3a2.7,2.7,0,0,0,0,3.951l40.033,40.034a2.7,2.7,0,0,0,3.951,0L84.88,68.489a2.708,2.708,0,0,0,0-3.953Z" fill="#ccc"/>
                                                    </g>
                                                </svg>
                                            </a>
                                            <a class="pagi__numbersNum -a">1</a>
                                            <a class="pagi__numbersNum -b">2</a>
                                            <a class="pagi__numbersNum -c">3</a>
                                            <a class="pagi__numbersFl -next">
                                                <svg class="pagi__numbersSvg -next" xmlns="http://www.w3.org/2000/svg" width="50" height="85.737" viewBox="0 0 50 85.737">
                                                    <g id="angle-arrow-down" transform="translate(-59.382 85.737) rotate(-90)">
                                                        <path id="Path_1" data-name="Path 1" d="M84.88,64.536l-4.3-4.295a2.7,2.7,0,0,0-3.952,0L42.869,94,9.106,60.242a2.7,2.7,0,0,0-3.952,0l-4.295,4.3a2.7,2.7,0,0,0,0,3.951l40.033,40.034a2.7,2.7,0,0,0,3.951,0L84.88,68.489a2.708,2.708,0,0,0,0-3.953Z" fill="#ccc"/>
                                                    </g>
                                                </svg>
                                            </a>
                                            <a class="pagi__numbersFl -last">
                                                <svg class="pagi__numbersSvg -last" xmlns="http://www.w3.org/2000/svg" width="75" height="85.737" viewBox="0 0 75 85.737">
                                                    <g id="Group_1" data-name="Group 1" transform="translate(-552.382 -427.81)">
                                                        <g id="angle-arrow-down" transform="translate(445.999 517.547) rotate(-90)">
                                                            <path id="Path_1" data-name="Path 1" d="M84.88,64.536l-4.3-4.295a2.7,2.7,0,0,0-3.952,0L42.869,94,9.106,60.242a2.7,2.7,0,0,0-3.952,0l-4.295,4.3a2.7,2.7,0,0,0,0,3.951l40.033,40.034a2.7,2.7,0,0,0,3.951,0L84.88,68.489a2.708,2.708,0,0,0,0-3.953Z" transform="translate(4 72)" fill="#ccc"/>
                                                            <path id="Path_2" data-name="Path 2" d="M84.88,64.536l-4.3-4.295a2.7,2.7,0,0,0-3.952,0L42.869,94,9.106,60.242a2.7,2.7,0,0,0-3.952,0l-4.295,4.3a2.7,2.7,0,0,0,0,3.951l40.033,40.034a2.7,2.7,0,0,0,3.951,0L84.88,68.489a2.708,2.708,0,0,0,0-3.953Z" transform="translate(4 47)" fill="#ccc"/>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </a>
                                        </div>

                                        <div class="pagi__shinp">
                                            <div class="pagi__shinpLabel">Show in page</div>
                                            <select name="" class="pagi__shinpSelect">
                                                <option value="10">10</option>
                                                <option value="20">20</option>
                                            </select>
                                        </div>
                                    </div>
                                <?php } ?>

                                <script>
                                    const fetchTableDataObj = {
                                        titleFieldContent: JSON.stringify(<?=isset($fetchTableDataObj) ? $fetchTableDataObj : '' ?>)
                                    };
                                </script>

                                <table class="table clist__table js-clist__table<?=$isAdmin ? ' -adminOn' : ''?>" data-typeid="<?=$typeId?>">
                                    <thead class=" text-primary">
                                        <th><?=_dp("Title")?></th>
                                        <th class="text-right"><?=_dp("Operations")?></th>
                                    </thead>
                                    <tbody class="js-sortable" data-itemstr="clistit"  data-dataidstr="data-itemid">
                                    <tr class="clist__tablePrel">
                                        <td colspan="5">
                                            <div class="prel">
                                                <div class="lds-ring">
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="clist__tableNotfound js-clist__tableNotfound">
                                        <td colspan="5">
                                            <div class="clist__tableNotfoundText"><?=_dp("Hiç eleman bulunamadı")?></div>
                                        </td>
                                    </tr>

                                    <tr class="js-clist__trToBeCopied dn" data-itemid="" data-typeid="">
                                        <td class="js-clist__title"></td>
                                        <td class="td-actions text-right">
                                            <?php if (empty($showMode)) { ?>
                                                <div class="clist__orderbtnsec" title="<?=_dp("Order")?>">
                                                    <a class="eltypeadd__acontItemOrderbtn clist__orderbtnsecLink js-order">
                                                        <svg class="eltypeadd__acontItemOrderbtnSvg clist__orderbtnsecLinkSvg" height="384pt" viewBox="0 -53 384 384" width="384pt" xmlns="http://www.w3.org/2000/svg"><path d="m368 154.667969h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"/><path d="m368 32h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"/><path d="m368 277.332031h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"/></svg>
                                                    </a>
                                                    <input type="hidden" name="clistit[0][orderNumber]" value="<?=0?>">
                                                </div>
                                                <div class="clist__switch js-clist__switch" data-mode="">
                                                    <div class="clist__switchBg1"></div>
                                                    <div class="clist__switchBall">on</div>
                                                </div>
                                                <button type="button" rel="tooltip" title="<?=_dp("Edit")?>"
                                                        class="btn btn-primary btn-link btn-sm js-clist_editbtn">
                                                    <i class="material-icons">edit</i>
                                                </button>
                                            <?php } ?>


                                            <?php if(0||!strstr($_SERVER['REQUEST_URI'], '/-4/users')){?>
                                                <button type="button" rel="tooltip" title="<?=_dp("Delete")?>"
                                                        class="btn btn-danger btn-link btn-sm js-clist__deletebtn">
                                                    <i class="material-icons">close</i>
                                                </button>
                                            <?php } ?>
                                        </td>

                                    </tr>

                                    <?php foreach ([] as $k => $d) { ?>
                                        <tr data-itemid="<?=$d->id?>" data-typeid="<?=1?>">
                                            <td>
                                                <?=$d->title?>
                                            </td>
                                            <td class="td-actions text-right">
                                                <div class="clist__switch js-clist__switch" data-mode="<?=$d->active === "1" ? "on" : "0" ?>">
                                                    <div class="clist__switchBg1"></div>
                                                    <div class="clist__switchBall">on</div>
                                                </div>
                                                <button type="button" rel="tooltip" title="<?=_dp("Düzenle")?>"
                                                        class="btn btn-primary btn-link btn-sm js-clist_editbtn">
                                                    <i class="material-icons">edit</i>
                                                </button>
                                                <button type="button" rel="tooltip" title="<?=_dp("Sil")?>"
                                                        class="btn btn-danger btn-link btn-sm js-clist__deletebtn">
                                                    <i class="material-icons">close</i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php if(0){?>
                            <button type="submit">sab</button>
                        <?php } ?>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script><?php
    if ($sortType === 'desc') echo 'const clistSortTypeDesc = true;';
    else echo 'const clistSortTypeDesc = false;';
    ?></script>