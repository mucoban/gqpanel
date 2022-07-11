<div class="hp-bg">
    <div class="c-1"></div>
    <div class="c-2"></div>
    <div class="c-3">
        <img src="assets/images/bg-triangle.svg" alt="bg-triangle">
    </div>
</div>
<div class="container tc hp-section">
    <div class="wsslides">
        <div class="wsslides-row">
            <?php foreach ($sliders[0]->ct_files[0]->fileName as $k => $v) { ?>
                <div class="wsslides-col">
                    <div class="wsslides-item">
                        <img src="uploads/files/<?=$v?>" alt="wsslides-item">
                    </div>
                </div>
            <?php }?>
        </div>
        <div class="wsslides-text">
            <div class="wsslides-text-inner">
                <?=$sliders[0]->ct_txtbox[0]->value?>
            </div>
            <p class="wsslides-text-btn">
                <a class="qm-trigger" <?=$sliders[0]->ct_titles[2]->title ? 'href="' . $sliders[0]->ct_titles[2]->title . '"' : '' ?>>
                    <img src="assets/images/mail-white.svg" alt="msg"><?=$sliders[0]->ct_titles[1]->title?></a>
            </p>
        </div>
    </div>
</div>

<div class="hpackages hp-section">
    <div class="container">
        <div class="hpackages-headline"><?=$page[0]->ct_titles[1]->title?></div>
        <div class="hpackages-pwrapper">
            <?php foreach ($packages as $k => $v) { ?>
                <div class="hpackages-pitem">
                    <img src="uploads/files/<?=$v->ct_files[0]->fileName[0]?>" alt="wsslides-item">
                    <div class="title"><?=$v->ct_titles[0]->title?></div>
                    <div class="desc"><?=$v->ct_txtbox[0]->value?></div>
                </div>
            <?php }?>
        </div>
    </div>
</div>

<div class="hpprocess hp-section">
    <div class="container">
        <div class="hpprocess-headline"><?=$page[0]->ct_titles[2]->title?></div>
        <?php foreach ($proggression as $k => $v) { ?>
            <div class="hpprocess-article">
                <div class="hpprocess-title"><?=$v->ct_titles[0]->title?></div>
                <div class="hpprocess-desc"><?=$v->ct_txtbox[0]->value?></div>
            </div>
        <?php } ?>
    </div>
</div>

