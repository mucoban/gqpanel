<div class="container">
    <h3 class="detail-headline">Driveways</h3>
    <div class="detail-ibanner">
        <img src="assets/images/inner-banner.png" alt="inner-banner">
    </div>
    <div class="detail-text">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
    </div>
    <div class="palbum">
        <div class="palbum-row">
            <?php foreach ([
                    [ 'i' => 'assets/images/hf-0', ],
                    [ 'i' => 'assets/images/hf-0', ],
                    [ 'i' => 'assets/images/hf-0', ],
                    [ 'i' => 'assets/images/hf-0', ],
                    [ 'i' => 'assets/images/hf-0', ],
                    [ 'i' => 'assets/images/hf-0', ],
                    [ 'i' => 'assets/images/hf-0', ],
                    [ 'i' => 'assets/images/hf-0', ],
                    [ 'i' => 'assets/images/hf-0', ],
                    [ 'i' => 'assets/images/hf-0', ],
                           ]
            as $k => $v) { ?>
                <div class="palbum-col">
                    <div class="palbum-item js-palbum-item" data-image-index="<?=($k % 3)?>">
                        <div class="bg">
                            <img src="<?=$v['i'] . ($k % 3 + 1) . '.png'?>" alt="img">
                        </div>
                        <img class="hidden" src="<?=$v['i'] . ($k % 3 + 1) . '.png'?>" alt="img">
                        <div class="overlay"></div>
                        <div class="content">
                            <img class="expand-sign" src="assets/images/expand-sign-2.svg" >
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="detail-pbottom-ph"></div>
