<body>
<div class="wrapper cpanel ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="assets/plugins/material/images/sidebar-1.jpg">
        <?php
        $isAdmin = false;
        if ($_SESSION['puser']->id === '5') $isAdmin = true;

        $menuItems = [
            [
                'icon' => '<i class="material-icons">language</i>',
                'text' => 'Go To ' . base_url(),
                'url' => base_url(),
                '_blank' => true,
            ],
            [
                'icon' => '<i class="material-icons">dashboard</i>',
                'text' => 'Dashboard',
                'url' => 'panel',
            ],
            [
                'icon' => '<i class="material-icons">person</i>',
                'text' => 'Users',
                'url' => 'panel/content/list/-4/users',
            ],
            [
                'icon' => '<i class="material-icons">settings</i>',
                'text' => 'Settings',
                'onlyAdmin' => true,
                'children' => [
                    [
                        'icon' => '<i class="material-icons">flag</i>',
                        'text' => 'Languages',
                        'url' => 'panel/content/list/-2/languages',
                    ],
                    [
                        'icon' => '<i class="material-icons">language</i>',
                        'text' => 'Translation',
                        'children' => [
                            [
                                'text' => 'Website',
                                'url' => 'panel/content/translations',
                            ],
                            [
                                'text' => 'Panel',
                                'url' => 'panel/content/translations/1',
                            ],
                        ],
                    ],
                    [
                        'icon' => '<i class="material-icons">settings</i>',
                        'text' => 'Eleman Türleri',
                        'url' => 'panel/content/list/-3/ele-types',
                    ],
                ],
            ],
            [
                'icon' => '<i class="material-icons">question_answer</i>',
                'text' => 'Messages',
                'url' => 'panel/content/list/-5/messages',
                'isMessages' => true,
            ],
            [
                'icon' => '<i class="material-icons">timeline</i>',
                'text' => 'Seo',
                'url' => 'panel/content/list/48/seo',
            ],
            [
                'icon' => '<i class="material-icons">grading</i>',
                'text' => 'Menüler',
                'children' => [
                    [
                        'icon' => '<i class="material-icons">flax</i>',
                        'text' => 'Header İletişim',
                        'url' => 'panel/content/list/37/header-iletisim',
                    ],
                    [
                        'icon' => '<i class="material-icons">flax</i>',
                        'text' => 'Header Sosyal Medya',
                        'url' => 'panel/content/list/36/header-sosyal-medya',
                    ],
                    [
                        'icon' => '<i class="material-icons">flax</i>',
                        'text' => 'Header Menü',
                        'url' => 'panel/content/list/33/header-menu',
                    ],
                    [
                        'icon' => '<i class="material-icons">flax</i>',
                        'text' => 'Footer',
                        'data-op-href' => 'panel/content/edit/55/15',
                    ],
                    [
                        'icon' => '<i class="material-icons">flax</i>',
                        'text' => 'Footer Menü A',
                        'url' => 'panel/content/list/8/footer-menu',
                    ],
                    [
                        'icon' => '<i class="material-icons">flax</i>',
                        'text' => 'Footer İletişim',
                        'url' => 'panel/content/list/38/footer-iletisim',
                    ],
                    [
                        'icon' => '<i class="material-icons">flax</i>',
                        'text' => 'Footer Sosyal Medya',
                        'url' => 'panel/content/list/17/footer-sosyal-medya',
                    ],
                    [
                        'icon' => '<i class="material-icons">flax</i>',
                        'text' => 'Footer Message',
                        'data-op-href' => 'panel/content/edit/367/50',
                    ],
                ],
            ],
            [
                'icon' => '<i class="material-icons">content_copy</i>',
                'text' => 'Pages',
                'children' => [
                    [
                        'icon' => '<i class="material-icons">flax</i>',
                        'text' => 'Anasayfa',
                        'children' => [
                            [
                                'text' => 'Anasayfa',
                                'data-op-href' => 'panel/content/edit/42/9'
                            ],
                            [
                                'text' => 'Sliders',
                                'url' => 'panel/content/list/39/sliders'
                            ],
                            [
                                'text' => 'Our Packages',
                                'url' => 'panel/content/list/40/our-packages'
                            ],
                            [
                                'text' => 'Progression',
                                'url' => 'panel/content/list/41/progression'
                            ],
                        ],
                    ],
                    [
                        'icon' => '<i class="material-icons">flax</i>',
                        'text' => 'Products',
                        'url' => 'panel/content/list/49/products'
                    ],
                    [
                        'icon' => '<i class="material-icons">flax</i>',
                        'text' => 'About Us',
                        'data-op-href' => 'panel/content/edit/348/46'
                    ],
                    [
                        'icon' => '<i class="material-icons">flax</i>',
                        'text' => 'Contact',
                        'data-op-href' => 'panel/content/edit/350/47'
                    ],
                ],
            ],
        ];

        ?>
        <div class="logo">
            <a href="panel" class="simple-text logo-normal">
                <span class="cpanel__logoText"><?=_dp("Admin Panel")?></span>
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">

                <?php foreach ($menuItems as $k_mi => $v_mi) {
                    if (empty($v_mi['onlyAdmin']) || $isAdmin) {

                    $currentMenuItemOpen = false;
                    if (isset($v_mi['children'])) {
                        foreach ($v_mi['children'] as $k_child => $v_child) {
                            if (isset($v_child['url']) && uri_string() === $v_child['url']) { $currentMenuItemOpen = true; }
                            else if (isset($v_child['children'])) {
                                foreach ($v_child['children'] as $k_grandChild => $v_grandChild) {
                                    if (isset($v_grandChild['url']) && uri_string() === $v_grandChild['url']) { $currentMenuItemOpen = true; $currentMIChildOpenIndex = $k_child; break; }
                                }
                            }
                        }
                    }
                    ?>
                    <li class="nav-item <?=empty($currentMenuItemOpen) ?: 'on'?>">
                        <a class="nav-link <?=!isset($v_mi['children']) ?: 'parent'?> <?=isset($v_mi['url']) && uri_string() === $v_mi['url'] ? 'activ' : ''?>"
                            <?=empty($v_mi['_blank']) ?: 'target="_blank"'?>
                            <?=isset($v_mi['url']) ? 'href="' . $v_mi['url'] . '"' : ''?>
                        >
                            <?=$v_mi['icon'] ?? ''?>
                            <p><?=_dp($v_mi['text'])?><?=isset($v_mi['isMessages']) && $thisController->nonReadMessagecount ? '<span class="clist__mn">'
                                    . $thisController->nonReadMessagecount . '</span>' : '' ?></p>
                            <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"></path></svg>
                        </a>

                        <?php if (isset($v_mi['children'])) foreach ($v_mi['children'] as $k_child => $v_child) {
                            if (empty($v_child['onlyAdmin']) || $isAdmin) {
                            ?>
                            <div class="cpanel__sub <?=isset($currentMIChildOpenIndex) && $currentMIChildOpenIndex === $k_child ? 'on' : '' ?>">
                                <a class="nav-link
                                    <?=!isset($v_child['children']) ?: 'parent'?>
                                    <?=isset($v_child['url']) && uri_string() === $v_child['url'] ? 'activ' : ''?>"
                                    <?=empty($v_child['_blank']) ?: 'target="_blank"'?>
                                    <?=isset($v_child['url']) ? 'href="' . $v_child['url'] . '"' : ''?>
                                    <?=isset($v_child['data-op-href']) ? 'data-op-href="' . $v_child['data-op-href'] . '"' : ''?>
                                >
                                    <?=$v_child['icon'] ?? ''?>
                                    <p><?=_dp($v_child['text'])?></p>
                                    <svg class="svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                                </a>
                                <?php if (isset($v_child['children'])) {?>
                                    <div class="cpanel__subSub">
                                        <?php foreach ($v_child['children'] as $k_grandChild => $v_grandChild) { ?>
                                            <a class="nav-link <?=isset($v_grandChild['url']) && uri_string() === $v_grandChild['url'] ? 'activ' : ''?>"
                                                <?=empty($v_grandChild['_blank']) ?: 'target="_blank"'?>
                                                <?=isset($v_grandChild['url']) ? 'href="' . $v_grandChild['url'] . '"' : ''?>
                                                <?=isset($v_grandChild['data-op-href']) ? 'data-op-href="' . $v_grandChild['data-op-href'] . '"' : ''?>
                                            >
                                                <i class="material-icons">flax</i>
                                                <p><?=_dp($v_grandChild['text'])?></p>
                                            </a>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <?php } ?>

                    </li>
                <?php } ?>
                <?php } ?>

            </ul>
        </div>
    </div>
    <div class="main-panel">
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
                            <input type="text" value="" class="form-control" placeholder="<?=_dp("Search")?>">
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
                        <li class="nav-item">
                            <a class="nav-link" href="panel/home/lang/<?php foreach ($_SESSION["langs"] as $k => $v) {
                                echo $v->id !== $_SESSION['lang_id'] ? $v->id : '';
                            } ?>">
                                <i class="material-icons">language</i>
                                <span><?=objedengetir($_SESSION["langs"], ['id' => $_SESSION['lang_id']], 'abb')?></span>
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
                                <a class="dropdown-item"  data-op-href="panel/content/edit/<?=$_SESSION["puser_id"]?>/-4"><?=_dp("Update profile")?></a>
                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="panel/login/logout"><?=_dp("Logout")?></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>