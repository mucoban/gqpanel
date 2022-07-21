<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$thisController->seo->ct_titles[2]->title?></title>
    <meta name="description" content="<?=$thisController->seo->ct_txtbox[0]->value?>">
    <meta name="keywords" content="<?=$thisController->seo->ct_txtbox[1]->value?>">

    <base href="<?=base_url()?>/">

    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/images/favicon/site.webmanifest">

    <link href="assets/css/style.css?v=<?=CJ_VERSION?>" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css" href="assets/plugins/slick/slick.css"/>

    <link rel="stylesheet" type="text/css" href="assets/plugins/slick/slick-theme.css"/>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-LH06C30Q1H"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-LH06C30Q1H');
    </script>

</head>

