<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title"><?=!empty($ispanel) ? _dp("Panel Çeviri") : _dp("Website Çeviri") ?></h4>
                        <p class="card-category"> <?=_dp("Çeviri düzenleme")?></p>
                    </div>
                    <div class="card-body -vB">
                        <form onsubmit="return fova_ldAdd(this)">
                            <div class="row">
                                <?php foreach ($langs as $k_l => $d_l) { ?>
                                    <div class="col-md-3">
                                        <div class="form-group bmd-form-group is-filled">
                                            <label class="bmd-label-floating"><?=$d_l->abb?></label>
                                            <input type="text" name="<?=$d_l->id?>" class="form-control">
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary pull-right float-right">
                                        <?=_dp("EKLE")?>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <button form="ldform" type="submit" class="btn btn-primary pull-right float-right ldFormSubmit js-ldFormSubmit" data-mode="">
                            <span class="cedit__submitbtnNormal ldFormSubmitNormal"><?=_dp("KAYDET")?></span>
                            <span class="cedit__submitbtnOngoing ldFormSubmitOngoing">
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
                            <span class="cedit__submitbtnDone ldFormSubmitDone">Ok</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="navbar-form" onsubmit="return fova_ldSearch(this)">
                                    <span class="bmd-form-group">
                                        <div class="input-group no-border">
                                            <input type="text" name="search" value="" class="form-control" placeholder="<?=_dp("Ara...")?>">
                                            <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                                <i class="material-icons">search</i>
                                                <div class="ripple-container"></div>
                                            </button>
                                        </div>
                                    </span>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12"></div>

            <form id="ldform" class="ldForm"
                  action="panel/content/translations_save"
                  onsubmit="return fova_ld(this)"
            >
                <input name="ispanel" type="hidden" value="<?=$ispanel?>">

                <div class="ldBox js-ldBox">

                    <div class="col-md-3 ldParent js-ldparent -toBeCopied">
                        <input type="hidden" name="ld[-1][0]"
                               value="ab<?=$d_l->id?>" class="">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <?php foreach ($langs as $k_l => $d_l) { ?>
                                        <div class="col-md-12">
                                            <div class="form-group bmd-form-group is-filled">
                                                <label class="bmd-label-floating"><?=$d_l->abb?></label>
                                                <input type="text" name="ld[-1][<?=$d_l->id?>]"
                                                       data-langid="<?=$d_l->id?>"
                                                       value="ab<?=$d_l->id?>" class="form-control js-ldItext">
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="col-md-12">
                                            <span class="btn btn-outline-danger pull-right float-right js-remove">
                                                <span class="material-icons">delete</span>
                                            </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php foreach ($lang_array as $k => $d) { ?>
                        <div class="col-md-3 ldParent js-ldparent on">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <input type="hidden" name="ld[<?=$k?>][0]" value="<?=$k?>"
                                               class="">
                                        <?php foreach ($langs as $k_l => $d_l) { ?>
                                            <div class="col-md-12">
                                                <div class="form-group bmd-form-group is-filled">
                                                    <label class="bmd-label-floating"><?=$d_l->abb?></label>
                                                    <input type="text" data-order="<?=$k?>" name="ld[<?=$k?>][<?=$d_l->id?>]" value="<?=$d[$d_l->id]?>"
                                                           class="form-control js-ldItext">
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="col-md-12">
                                            <span class="btn btn-outline-danger pull-right float-right js-remove">
                                                <span class="material-icons">delete</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </form>


        </div>
    </div>
</div>