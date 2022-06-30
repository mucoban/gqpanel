<body>
<!-- End Google Tag Manager (noscript) -->
<div class="wrapper cpanel ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="assets/plugins/material/images/sidebar-1.jpg">
        <?php
        $isAdmin = false;
        if ($_SESSION['puser']->id === '5') $isAdmin = true;

        $m_site_settings =
          $m_seo =
          $m_menu =
          $m_pages =
          $m_dashboardIs =
          $m_usersIs =
          $sub_languages =
          $sub_translation__open =
          $sub_sub_websiteTranslation =
          $sub_sub_panelTranslation =
          $sub_eletypes =
          $sub_headerContacts =
          $sub_headersocial =
          $sub_headermenu =
          $sub_footermenu =
          $sub_footermenu2 =
          $sub_footerContacts =
          $sub_footersocial =
          $sub_homepage =
          $sub_homepage__open =
          $sub_homeSlider =
          $sub_homeBusinessFields =
          $sub_homePartners =
          $sub_bfields__open =
          $sub_bfieldsBFs =
          $sub_partners__open =
          $sub_partnersPartners =
          $sub_partnersPartnersItems =
              false;

          if (uri_string() === "panel/content/list/-4/users") {
              $m_usersIs = true;
          } else if (uri_string() === "panel/home/index") {
              $m_dashboardIs = true;
          }
          else if (uri_string() === "panel/content/list/-2/languages") {
              $m_site_settings = $sub_languages = true;
          }
          else if (uri_string() === "panel/content/list/-3/ele-types") {
              $m_site_settings = $sub_eletypes = true;
          }


          else if (uri_string() === "panel/content/list/37/header-iletisim") {
              $m_menu = $sub_headerContacts = true;
          }
          else if (uri_string() === "panel/content/list/36/header-sosyal-medya") {
              $m_menu = $sub_headersocial = true;
          }
          else if (uri_string() === "panel/content/list/33/header-menu") {
              $m_menu = $sub_headermenu = true;
          }
          else if (uri_string() === "panel/content/list/8/footer-menu") {
              $m_menu = $sub_footermenu = true;
          }
          else if (uri_string() === "panel/content/list/16/footer-menu-2") {
              $m_menu = $sub_footermenu2 = true;
          }
          else if (uri_string() === "panel/content/list/17/footer-sosyal-medya") {
              $m_menu = $sub_footersocial = true;
          }
          else if (uri_string() === "panel/content/list/38/footer-iletisim") {
              $m_menu = $sub_footerContacts = true;
          }

          else if (uri_string() === "panel/content/list/39/anasayfa-slider") {
              $m_pages = $sub_homepage__open = $sub_homeSlider = true;
          }
          else if (uri_string() === "panel/content/list/40/business-fields") {
              $m_pages = $sub_homepage__open = $sub_homeBusinessFields = true;
          }
          else if (uri_string() === "panel/content/list/41/partners") {
              $m_pages = $sub_homepage__open = $sub_homePartners = true;
          }
          else if (uri_string() === "panel/content/list/42/business-fields") {
              $m_pages = $sub_bfields__open = $sub_bfieldsBFs = true;
          }
          else if (uri_string() === "panel/content/list/45/partners-items") {
              $m_pages = $sub_partners__open = $sub_partnersPartnersItems = true;
          }

          else if (uri_string() === "panel/content/list/48/seo-ayarlari") {
              $m_seo = true;
          }

        ?>
        <div class="logo">
            <a href="panel" class="simple-text logo-normal">
<!--                <img src="assets/images/header-logo.png" alt="img">-->
<!--                <br>-->
                <span class="cpanel__logoText"><?=_dp("Nesibeli Ojak")?></span>
                <br>
                <span class="cpanel__logoText"><?=_dp("Yönetim Paneli")?></span>
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="nav-item activex">
                    <a class="nav-link" target="_blank" href="<?=base_url()?>">
                        <i class="material-icons">language</i>
                        <p><?=_dp("Websiteye Git")?></p>
                    </a>
                </li>
                <li class="nav-item activex">
                    <a class="nav-link <?=$m_dashboardIs ? "activ0" : "" ?>" href="panel/home/index">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?=$m_usersIs ? "activ" : "" ?>" href="panel/content/list/-4/users">
                        <i class="material-icons">person</i>
                        <p><?=_dp("Kullanıcılar")?></p>
                        <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                    </a>
                </li>
                <?php if($isAdmin){?>
                    <li class="nav-item <?=$m_site_settings ? "on" : "" ?>">
                        <a class="nav-link parent">
                            <i class="material-icons">settings</i>
                            <p><?=_dp("Site Ayarları")?></p>
                            <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                        </a>


                        <?php if($isAdmin){?>
                            <div class="cpanel__sub">
                                <a class="nav-link <?=$sub_languages ? "activ" : "" ?>" href="panel/content/list/-2/languages">
                                    <i class="material-icons">flag</i>
                                    <p><?=_dp("Diller")?></p>
                                    <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                                </a>
                            </div>
                            <div class="cpanel__sub <?=$sub_translation__open ? "on" : "" ?>">
                                <a class="nav-link parent">
                                    <i class="material-icons">language</i>
                                    <p><?=_dp("Çeviri")?></p>
                                    <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                                </a>
                                <div class="cpanel__subSub">
                                    <a class="nav-link <?=$sub_sub_websiteTranslation ? "activ" : "" ?>" href="panel/content/translations">
                                        <i class="material-icons">flax</i>
                                        <p><?=_dp("Website")?></p>
                                    </a>
                                    <a class="nav-link  <?=$sub_sub_panelTranslation ? "activ" : "" ?>" href="panel/content/translations/1">
                                        <i class="material-icons">flax</i>
                                        <p>Panel</p>
                                    </a>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="cpanel__sub">
                            <a class="nav-link <?=$sub_eletypes ? "activ" : "" ?>" href="panel/content/list/-3/ele-types">
                                <i class="material-icons">settings</i>
                                <p><?=_dp("Eleman Türleri")?></p>
                                <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                            </a>
                        </div>

                    </li>
                <?php } ?>

                <?php if(1){?>
                    <li class="nav-item">
                        <a class="nav-link <?=$m_seo ? "activ" : "" ?>" href="panel/content/list/-5/users">
                            <i class="material-icons">question_answer</i>
                            <p><?=_dp("Mesajlar")?><?=$thisController->nonReadMessagecount ? '<span class="clist__mn">'
                                    . $thisController->nonReadMessagecount . '</span>' : '' ?></p>
                            <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?=$m_seo ? "activ" : "" ?>" href="panel/content/list/48/seo-ayarlari">
                            <i class="material-icons">timeline</i>
                            <p><?=_dp("Seo Ayarları")?></p>
                            <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                        </a>
                    </li>
                    <li class="nav-item <?=$m_menu ? "on" : "" ?>">
                        <a class="nav-link parent">
                            <i class="material-icons">grading</i>
                            <p><?=_dp("Menüler")?></p>
                            <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                        </a>
                        <div class="cpanel__sub">
                            <a class="nav-link <?=$sub_headerContacts ? "activ" : "" ?>" href="panel/content/list/37/header-iletisim">
                                <i class="material-icons">flax</i>
                                <p>Header İletişim</p>
                                <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                            </a>
                            <a class="nav-link <?=$sub_headersocial ? "activ" : "" ?>" href="panel/content/list/36/header-sosyal-medya">
                                <i class="material-icons">flax</i>
                                <p>Header Sosyal Medya</p>
                                <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                            </a>
                            <a class="nav-link <?=$sub_headermenu ? "activ" : "" ?>" href="panel/content/list/33/header-menu">
                                <i class="material-icons">flax</i>
                                <p>Header Menü</p>
                                <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                            </a>
                            <a class="nav-link" data-op-href="panel/content/edit/55/15">
                                <i class="material-icons">flax</i>
                                <p><?=_dp("Footer")?></p>
                            </a>
                            <a class="nav-link <?=$sub_footermenu ? "activ" : "" ?>" href="panel/content/list/8/footer-menu">
                                <i class="material-icons">flax</i>
                                <p>Footer Menü A</p>
                                <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                            </a>
                            <a class="nav-link <?=$sub_footermenu2 ? "activ" : "" ?>" href="panel/content/list/16/footer-menu-2">
                                <i class="material-icons">flax</i>
                                <p>Footer Menü B</p>
                                <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                            </a>
                            <a class="nav-link <?=$sub_footerContacts ? "activ" : "" ?>" href="panel/content/list/38/footer-iletisim">
                                <i class="material-icons">flax</i>
                                <p>Footer İletişim</p>
                                <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                            </a>
                            <a class="nav-link <?=$sub_footersocial ? "activ" : "" ?>" href="panel/content/list/17/footer-sosyal-medya">
                                <i class="material-icons">flax</i>
                                <p>Footer Sosyal Medya</p>
                                <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                            </a>
                        </div>
                    </li>
                <?php } ?>


                <li class="nav-item <?=$m_pages ? "on" : "" ?>">
                    <a class="nav-link parent" hrefx="panel/content/list/6/pages">
                        <i class="material-icons">content_copy</i>
                        <p><?=_dp("Sayfalar")?></p>
                        <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                    </a>
                    <div class="cpanel__sub  <?=$sub_homepage__open ? "on" : "" ?>">
                        <a class="nav-link parent">
                            <i class="material-icons">flax</i>
                            <p><?=_dp("Anasayfa")?></p>
                            <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                        </a>
                        <div class="cpanel__subSub">
                            <a class="nav-link" data-op-href="panel/content/edit/42/9">
                                <i class="material-icons">flax</i>
                                <p><?=_dp("Anasayfa")?></p>
                            </a>
                            <a class="nav-link <?=$sub_homeSlider ? "activ" : "" ?>" href="panel/content/list/39/anasayfa-slider">
                                <i class="material-icons">flax</i>
                                <p><?=_dp("Anasayfa Slider")?></p>
                            </a>
                            <a class="nav-link <?=$sub_homeBusinessFields ? "activ" : "" ?>" href="panel/content/list/40/business-fields">
                                <i class="material-icons">flax</i>
                                <p><?=_dp("Business Fields")?></p>
                            </a>
                            <a class="nav-link <?=$sub_homePartners ? "activ" : "" ?>" href="panel/content/list/41/partners">
                                <i class="material-icons">flax</i>
                                <p><?=_dp("Partners")?></p>
                            </a>
                        </div>
                    </div>
                    <div class="cpanel__sub  <?=$sub_bfields__open ? "on" : "" ?>">
                        <a class="nav-link parent">
                            <i class="material-icons">flax</i>
                            <p><?=_dp("Business Fields")?></p>
                            <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                        </a>
                        <div class="cpanel__subSub">
                            <a class="nav-link" data-op-href="panel/content/edit/341/43">
                                <i class="material-icons">flax</i>
                                <p><?=_dp("Business Fields Sayfası")?></p>
                            </a>
                            <a class="nav-link <?=$sub_bfieldsBFs ? "activ" : "" ?>" href="panel/content/list/42/business-fields">
                                <i class="material-icons">flax</i>
                                <p><?=_dp("Business Fields Items")?></p>
                            </a>
                        </div>
                    </div>
                    <div class="cpanel__sub  <?=$sub_partners__open ? "on" : "" ?>">
                        <a class="nav-link parent">
                            <i class="material-icons">flax</i>
                            <p><?=_dp("Partners")?></p>
                            <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                        </a>
                        <div class="cpanel__subSub">
                            <a class="nav-link" data-op-href="panel/content/edit/342/44">
                                <i class="material-icons">flax</i>
                                <p><?=_dp("Partners Sayfası")?></p>
                            </a>
                            <a class="nav-link <?=$sub_partnersPartnersItems ? "activ" : "" ?>" href="panel/content/list/45/partners-items">
                                <i class="material-icons">flax</i>
                                <p><?=_dp("Partners Items")?></p>
                            </a>
                        </div>
                    </div>
                    <div class="cpanel__sub">
                        <a class="nav-link " data-op-href="panel/content/edit/348/46">
                            <i class="material-icons">flax</i>
                            <p><?=_dp("About Us")?></p>
                            <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                        </a>
                    </div>
                    <div class="cpanel__sub">
                        <a class="nav-link " data-op-href="panel/content/edit/350/47">
                            <i class="material-icons">flax</i>
                            <p><?=_dp("Contact")?></p>
                            <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                        </a>
                    </div>
                </li>

            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <a class="navbar-brand" href="javascript:;">Dashboard</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">
                    <form class="navbar-form js-navbar-form" >
                        <div class="navbar-form__dropdown js-navbar-form__dropdown"></div>
                        <div class="input-group no-border">
                            <input type="text" value="" class="form-control" placeholder="<?=_dp("Ara...")?>">
                            <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                <i class="material-icons">search</i>
                                <div class="ripple-container"></div>
                            </button>
                        </div>
                    </form>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:;">
                                <i class="material-icons">dashboard</i>
                                <p class="d-lg-none d-md-block">
                                    Stats
                                </p>
                            </a>
                        </li>
                        <?php if(0){?>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">notifications</i>
                                    <span class="notification">5</span>
                                    <p class="d-lg-none d-md-block">
                                        Some Actions
                                    </p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="#">Mike John responded to your email</a>
                                    <a class="dropdown-item" href="#">You have 5 new tasks</a>
                                    <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                                    <a class="dropdown-item" href="#">Another Notification</a>
                                    <a class="dropdown-item" href="#">Another One</a>
                                </div>
                            </li>
                        <?php } ?>

                        <li class="nav-item dropdown">
                            <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">language</i>
                                <p class="d-lg-none d-md-block">
                                    Account
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                <?php foreach ($_SESSION["langs"] as $k => $d) { ?>
                                    <a class="dropdown-item" href="panel/home/lang/<?=$d->id?>"><?=$d->abb?></a>
                                <?php } ?>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">person</i>
                                <p class="d-lg-none d-md-block">
                                    Account
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                <?php if(0){?>
                                    <a class="dropdown-item" href="#">Profile</a>
                                <?php } ?>
                                <a class="dropdown-item"><?=$_SESSION["puser"]->username?></a>
                                <a class="dropdown-item"  data-op-href="panel/content/edit/<?=$_SESSION["puser_id"]?>/-4"><?=_dp("Profilini düzenle")?></a>
                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="panel/login/logout"><?=_dp("Çıkış yap")?></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
