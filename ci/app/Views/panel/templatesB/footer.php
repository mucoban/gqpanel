<div class="popup js-popup" data-mode="">
    <div class="popup__bg"></div>
    <div class="popup__content js-popup__content">
        <div class="popup__box">
            <a class="popup__boxClose js-popup__boxClose">
                <svg class="popup__boxCloseSvg" xmlns="http://www.w3.org/2000/svg" width="17.456" height="18.371" viewBox="0 0 17.456 18.371">
                    <g id="Group_960" data-name="Group 960" transform="translate(22190.392 12545.919)">
                        <line id="Line_120" data-name="Line 120" y1="17" x2="16" transform="translate(-22189.664 -12545.233)" fill="none" stroke="#120f4a" stroke-width="2"></line>
                        <line id="Line_121" data-name="Line 121" x1="16" y1="17" transform="translate(-22189.664 -12545.233)" fill="none" stroke="#120f4a" stroke-width="2"></line>
                    </g>
                </svg>
            </a>
            <iframe class="popup__boxIframe js-popup__boxIframe" src=""></iframe>

            <div class="fiuploder js-fiuploder">
                <div class="fiuploder__up js-fiuploder__up" data-type>
                    <form class="fiuploder__upForm" onsubmit="return fova_uploadFile(this)" data-mode=""
                          action="<?=base_url()?>/panel/content/uploadfiles"
                          enctype="multipart/form-data">
                        <div class="fiuploder__upBar">
                            <div class="fiuploder__upD"></div>
                        </div>
                        <div class="fiuploder__upInner">
                            <input type="hidden" name="type" value="0">
                            <input class="fiuploder__upIfile" type="file" name="file">
                            <button class="fiuploder__upSubmit" type="submit">
                                <span class="fiuploder__upSubmitSpan js-submit -va">Upload A Picture</span>
                                <span class="fiuploder__upSubmitSpanres">Successfully Uploaded</span>
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
                            </button>
                            <div class="fiuploder__upWarin">
                                <div class="fiuploder__upWarinItem">
                                    <span class="fiuploder__upWarinLabel">Allowed extensions:</span>
                                    <span class="fiuploder__upWarinTxt js-allowedExt">png, jpg, jpeg</span>
                                </div>
                                <div class="fiuploder__upWarinItem">
                                    <span class="fiuploder__upWarinLabel">Maximum file size:</span>
                                    <span class="fiuploder__upWarinTxt">50 MB</span>
                                </div>
                            </div>
                        </div>

                    </form>
                    <form class="fiuploder__upForm -emv" onsubmit="return fova_uploadFile(this)" data-mode=""
                          action="<?=base_url()?>/panel/content/uploadfiles"
                          enctype="multipart/form-data">
                        <div class="fiuploder__upFormSep">Or</div>
                        <div class="fiuploder__upInner">

                            <input class="fiuploder__upFormEvitext" type="text" name="eviurl" placeholder="Video embed url">

                            <button class="fiuploder__upSubmit" type="submit">
                                <span class="fiuploder__upSubmitSpan js-submit">Upload the video</span>
                                <span class="fiuploder__upSubmitSpanres">Successfully Uploaded</span>
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
                            </button>
                        </div>

                    </form>
                </div>
                <div class="fiuploder__files">
                    <div class="fiuploder__filesFilter">
                        <div class="fiuploder__filesFilterItem">
                            <div class="fiuploder__filesFilterLabel">Type</div>
                            <div class="fiuploder__filesFilterSelect">
                                <select class="fiuploder__filesFilterSelectIs js-typeSelect js-select2x" data-minimum-results-for-search="Infinity">
                                    <option value="0">All</option>
                                    <option value="1">Pictures</option>
                                    <option value="2">Files</option>
                                    <option value="3">Videos</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="fiuploder__filesBoxes js-fiuploder__filesBoxes">
                        <?php foreach ([0] as $k => $d) { ?>
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
                            <div class="fiuploder__filesBoxO js-fiuploder__filesBoxO -toBeCopied -notEntered" data-type="">
                                <div class="fiuploder__filesBox js-fiuploder__filesBox">
                                    <div class="fiuploder__filesBoxMedia js-media">
                                        <img class="fiuploder__filesBoxMediaImg js-bimg"
                                             src="" alt="img">
                                        <div class="fiuploder__filesBoxMediaFdirect">
                                            <img class="fiuploder__filesBoxMediaFdirectFicon" src="assets/images/file-icon.svg" alt="icon">
                                            <div class="fiuploder__filesBoxMediaFdirectSep"></div>
                                            <a href="" target="_blank" class="fiuploder__filesBoxMediaFdirectButona js-view">View</a>
                                            <a href="" target="_blank" class="fiuploder__filesBoxMediaFdirectButonb js-download" download>Download</a>
                                        </div>
                                        <div class="fiuploder__filesBoxMediaVideo">
                                            <video class="fiuploder__filesBoxMediaVideoIs" controls>
                                                <source class=" js-video" src="" type="video/mp4">
                                                <source class=" js-video" src="" type="video/ogg">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                        <div class="fiuploder__filesBoxMediaVideo -emv">
                                            <div class="fiuploder__filesBoxMediaVideoEminner"></div>
                                            <iframe class="fiuploder__filesBoxMediaVideoEmiframe js-emv" width="100" height="100" src=""
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen></iframe>
                                        </div>
                                    </div>
                                    <div class="fiuploder__filesBoxInfo">
                                        <div class="fiuploder__filesBoxInfoLine">
                                            <span class="fiuploder__filesBoxInfoLabel">File Name:</span>
                                            <span class="fiuploder__filesBoxInfoTxt js-filename">5135.jpg</span>
                                        </div>
                                        <div class="fiuploder__filesBoxInfoLine">
                                            <span class="fiuploder__filesBoxInfoLabel">Upload Date:</span>
                                            <span class="fiuploder__filesBoxInfoTxt js-uploaddate">20/20/2020</span>
                                        </div>
                                        <div class="fiuploder__filesBoxInfoLine">
                                            <span class="fiuploder__filesBoxInfoLabel">Dimensions:</span>
                                            <span class="fiuploder__filesBoxInfoTxt  js-dimensions">1920x1080</span>
                                        </div>
                                        <div class="fiuploder__filesBoxInfoLine">
                                            <span class="fiuploder__filesBoxInfoLabel">Size:</span>
                                            <span class="fiuploder__filesBoxInfoTxt  js-size">1920x1080</span>
                                        </div>
                                        <div class="fiuploder__filesBoxInfoLine -vB">
                                            <span class="fiuploder__filesBoxInfoAcbtn js-selectBtn">Select</span>
                                            |
                                            <span class="fiuploder__filesBoxInfoAcbtn js-delBtn">Remove</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <?php if(0){?>
                        <div class="fiuploder__filesBottom">
                            <a class="fiuploder__filesChoose js-choose">Choose</a>
                        </div>
                    <?php } ?>

                </div>
            </div>

        </div>
    </div>
</div>


<div class="flamsg js-flamsg" data-type="error" data-mode="0">
    <div class="flamsg__box">
        <svg class="flamsg__boxSvg -error" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/><path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/></svg>
        <div class="flamsg__boxText js-text">
            Kullanıcı adı veya şifre yanlış
        </div>
    </div>
</div>