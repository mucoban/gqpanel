<div class="details">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php if ($page[0]->ct_files[0]->fileName[0]) { ?>
                    <img src="uploads/files/<?=$page[0]->ct_files[0]->fileName[0]?>" class="dp-main-image" alt="dp-main-image">
                <?php } ?>
                <h3 class="details-headline v-2"><?=$page[0]->ct_titles[0]->title?></h3>
                <p><?=$page[0]->ct_txteditor[0]->value?></p>
            </div>
        </div>
    </div>
</div>