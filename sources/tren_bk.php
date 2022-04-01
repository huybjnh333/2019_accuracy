<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="format-detection" content="telephone=no"/>
    <base href="<?= $fullpath ?>/"/>
    <?php include("seo.php"); ?>

    <link rel="stylesheet" type="text/css" href="menu_mb/css.css"/>
    <?php include("css.php"); ?>

    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    <link href="css/owl.carousel.css" rel="stylesheet" type="text/css" media="all">
    <?= $thongtin['js_google_anilatic'] ?>
    <script type="text/javascript">var fullpath = "<?=$fullpath ?>";
        var full_url = "<?=$full_url ?>";</script>

</head>
<body>

<noscript id="deferred-styles">
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/owl.carousel.css" rel="stylesheet" type="text/css">
    <link href="css/shake.css" rel="stylesheet" type="text/css">
    <link href="css/unleash.css" rel="stylesheet" type="text/css">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/animate.css" rel="stylesheet" type="text/css">
    <link href="css/animation.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="images/fancybox/jquery.fancybox.css"/>
</noscript>
<script>
    var loadDeferredStyles = function () {
        var addStylesNode = document.getElementById("deferred-styles");
        var replacement = document.createElement("div");
        replacement.innerHTML = addStylesNode.textContent;
        document.body.appendChild(replacement)
        addStylesNode.parentElement.removeChild(addStylesNode);
    };
    var raf = window.requestAnimationFrame || window.mozRequestAnimationFrame ||
        window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
    if (raf) raf(function () {
        window.setTimeout(loadDeferredStyles, 0);
    });
    else window.addEventListener('load', loadDeferredStyles);
</script>
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/<?=$lang == "vi" ? "vi_VN" : "en_US" ?>/sdk.js#xfbml=1&version=v2.12';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<!-- <div class="mm-page mm-slideout"> -->
<div>
    <article>
        <section>
            <?php include "header.php" ?>
            <div class="conten_page">