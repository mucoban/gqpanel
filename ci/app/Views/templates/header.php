<body><div class="header mmenu-onx">    <div class="container">        <a class="header-logo" href="">            mucoban.com        </a>        <div class="mmenu-icon">            <img src="assets/images/mmenu-01.svg" alt="mmenu">        </div>        <div class="nav">            <div class="mmenu-close">                <img src="assets/images/close-sign-black.svg" alt="home">            </div>            <?php foreach ($thisController->headerMenu as $k => $v) { ?>                <div class="nav-link-outer">                    <a class="nav-link" <?=$v->ct_titles[1]->title ? 'href="' . $v->ct_titles[1]->title . '"' : ''?>                        ><?=$v->ct_titles[0]->title?></a>                    <?php if (isset($v->children)) { ?>                        <div class="nav-sub">                            <div class="nav-sub-inner">                                <?php foreach ($v->children as $k_b => $v_b) {?>                                    <a <?=$v_b->ct_titles[1]->title ? 'href="' . $v_b->ct_titles[1]->title . '"' : ''?>                                            class="nav-sub-link"><?=$v_b->ct_titles[0]->title?></a>                                <?php } ?>                            </div>                        </div>                    <?php } ?>                </div>            <?php } ?>            <div class="nav-link-outer">                <?php foreach ($thisController->langs as $k => $v) {                    if ($v->id !== $_SESSION['lang_id']) { ?>                        <a href="language/<?=$v->id?>" class="nav-link language">                            <img src="assets/images/earth.svg" alt="earth">                            <span><?=ucfirst($v->abb)?></span>                        </a>                    <?php break; }                } ?>            </div>        </div>    </div></div><div class="header-placeholder"></div>