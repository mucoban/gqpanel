<div class="details contact" style="background-image: url(uploads/files/<?=$page[0]->ct_files[0]->fileName[0]?>)">
    <div class="container" >
        <div class="row">
            <?php if (isset($_SESSION['form_is_successfull'])) { ?>
                <div class="col-12 col-sm-12">
                    <p class="flash-message positive"><?=$page[0]->ct_txtbox[1]->value?></p>
                </div>
            <?php } ?>
            <?php if (isset($_SESSION['form_is_unsuccessfull'])) { ?>
                <div class="col-12 col-sm-12">
                    <p class="flash-message negative"><?=$page[0]->ct_txtbox[2]->value?></p>
                </div>
            <?php } ?>
            <div class="col-6 col-sm-12 contact-col-2">
                <h3 class="details-headline v-2"><?=$page[0]->ct_titles[0]->title?></h3>
                <div class="art-contact">
                    <div class="bold">
                        <img class="icon" src="assets/images/mail-3.svg" alt="mail">
                        E-mail:</div>
                    <a class="text" href=""><?=$page[0]->ct_titles[1]->title?></a>
                </div>
                <div class="art-contact">
                    <div class="bold">
                        <img class="icon" src="assets/images/phone-3.svg" alt="mail">
                        Phone:</div>
                    <a class="text"><?=$page[0]->ct_titles[2]->title?></a>
                </div>
                <div class="art-contact dn">
                    <div class="bold">
                        <img class="icon icon-3" src="assets/images/marker.svg" alt="mail">
                        Address:</div>
                    <div class="text">
                        The Willow Rise
                        House Lane
                        St. Albans
                        Hertfordshire
                        AL4 9HE
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-12">
                <h3 class="details-headline v-2"><?=$page[0]->ct_titles[3]->title?></h3>
                <form action="contact/send" class="contact-form" method="post">
                    <div class="row">
                        <div class="col-12 col-sm-12 form-group">
                            <input type="text" name="name" class="form-control" placeholder="<?=$page[0]->ct_titles[4]->title?>">
                        </div>
                        <div class="col-12 form-group">
                            <input type="text" name="email" class="form-control" placeholder="<?=$page[0]->ct_titles[5]->title?>">
                        </div>
                        <div class="col-12 form-group">
                            <input type="text" name="subject" class="form-control" placeholder="<?=$page[0]->ct_titles[6]->title?>">
                        </div>
                        <div class="col-12 form-group">
                            <textarea class="form-control" name="message" rows="5" placeholder="<?=$page[0]->ct_titles[7]->title?>"></textarea>
                        </div>
                        <div class="col-12 form-group tr">
                            <button class="form-submit"><?=$page[0]->ct_titles[8]->title?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="contact-maps dn">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3125.4662007655465!2d27.168480265194408!3d38.43069927964539!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14bbd8784ca31a59%3A0x231078525c61cc71!2zSGFsa2FwxLFuYXIsIDEyMDEvOC4gU2suIE5vOiAxMSwgMzUxMDAgS29uYWsvxLB6bWly!5e0!3m2!1str!2str!4v1645131664021!5m2!1str!2str"
                width="100%" height="450"
                style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
</div>

