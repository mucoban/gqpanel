<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-3  col-sm-12">
                <a href="<?=$thisController->footer[0]->ct_titles[1]->title?>"
                   class="footer-logo"><?=$thisController->footer[0]->ct_titles[0]->title?></a>
            </div>
            <div class="col-3">
            </div>
            <div class="col-3  col-sm-12">
               <div class="footer-block">
                   <div class="title"></div>
                   <?php foreach ($thisController->footerMenu as $k => $v) { ?>
                       <div class="art"><a <?=$v->ct_titles[1]->title ? 'href="' . $v->ct_titles[1]->title . '"' : '' ?>><?=$v->ct_titles[0]->title?></a></div>
                   <?php } ?>
               </div>
            </div>
            <div class="col-3  col-sm-12">
               <div class="footer-block footer-block-contact">
                   <div class="title dn">Contact</div>
                   <?php foreach ($thisController->footerContact as $k => $v) { ?>
                       <div class="art">
                           <img class="footer-cicon" src="uploads/files/<?php echo $v->ct_files[0]->fileName[0] ?? ''?>" alt="phone">
                           <label><?=$v->ct_titles[0]->title?>:</label> <a <?=$v->ct_titles[2]->title ? 'href="' . $v->ct_titles[2]->title . '"' : '' ?>><?=$v->ct_titles[1]->title?></a>
                       </div>
                   <?php } ?>
                   <div class="art dn">
                       <img class="footer-cicon v-3" src="assets/images/marker-white.svg" alt="phone">
                       <label>Address:</label> <span>The Willow Rise House Lane St. Albans Hertfordshire AL4 9HE</span>
                   </div>
               </div>
            </div>
            <div class="col-12">
                <div class="copyright">
                    <?=$thisController->footer[0]->ct_txtbox[0]->value?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="go-top">
    <img src="assets/images/chevron-up.svg" alt="chevron-up">
</div>

<div class="modal js-modal" style="display: none">
    <div class="modal-bg"></div>
    <div class="modal-content">
        <div class="modal-box">
            <div class="modal-image-slider js-modal-image-slider">
                <div class="slider-item">
                    <img src="assets/images/slider-01.png" alt="slider-image">
                </div>
                <div class="slider-item">
                    <img src="assets/images/slider-02.png" alt="slider-image">
                </div>
                <div class="slider-item">
                    <img src="assets/images/slider-03.png" alt="slider-image">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-close-sign">
        <img src="assets/images/close-sign.svg" alt="close-sign">
    </div>
</div>

<div class="quick-message" mode="">
    <div class="bg"></div>
    <div class="content">
        <div class="icon qm-trigger">
            <img src="assets/images/mail.svg" alt="img">
        </div>
        <form action="contact" onsubmit="return quickMessageSend(this)">
            <div class="close"><img src="assets/images/close-sign-black.svg" alt="close"></div>
            <div class="title"><?=$thisController->footerMessage[0]->ct_titles[0]->title?></div>
            <div class="flash-message-holder">
                <p class="flash-message positive">Mesajınız başarıyla gönderildi</p>
            </div>
            <div class="cbox">
                <div class="line">
                    <input type="text" name="name" class="itext" placeholder="<?=$thisController->footerMessage[0]->ct_titles[1]->title?>">
                </div>
                <div class="line">
                    <input type="text" name="email" class="itext" placeholder="<?=$thisController->footerMessage[0]->ct_titles[3]->title?>">
                </div>
                <div class="line">
                    <input type="text" name="phone" class="itext" placeholder="<?=$thisController->footerMessage[0]->ct_titles[5]->title?>">
                </div>
                <div class="line">
                    <textarea name="message" class="itext" rows="5" placeholder="<?=$thisController->footerMessage[0]->ct_titles[7]->title?>"></textarea>
                </div>
                <div class="line">
                    <button class="btn submit">Send</button>
                </div>
            </div>
            <div class="loader">
                <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            </div>
        </form>
    </div>
</div>


