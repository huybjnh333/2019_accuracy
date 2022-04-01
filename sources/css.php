<?php

$favicon = $fullpath . '/' . $thongtin['duongdantin'] . '/' . $thongtin['favico'];
$css = array(
    "css/style.css" => "css/style.min.css",
    "menu_mb/css.css" => "css/style.min.css"
);
$cssduoi = array(
//    "css/thumbs2.css" => "css/thumbs2.css",
//    "css/thumbnail-slider.css" => "css/thumbnail-slider.css",
//    "css/shake.css" => "css/shake.css",
    "css/widget.css" => "css/widget.css",
//    "css/unleash.css" => "css/unleash.css",
//    "css/font-awesome.min.css" => "css/font-awesome.min.css",
//    "css/animate.min.css" => "css/animate.min.css",
//    "css/animation.css" => "css/animation.css",
    "images/fancybox/jquery.fancybox.css" => "css/fancybox/jquery.fancybox.css",
//    "css/galleria.folio.css" => "css/galleria.folio.css",
    "https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" => "https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css",
//    "css/lightgallery.min.css" => "css/lightgallery.min.css",
//    "css/owl.carousel.css" => "css/lightgallery.min.css",
    "css/noty.min.css" => "css/noty.min.css",
);
$js = array(
//    "js/jquery.carouFredSel.min.js" => "js/jquery.carouFredSel.min.js",
//    "js/jquery.mousewheel.min.js" => "js/jquery.mousewheel.min.js",
//    "js/jquery.touchSwipe.min.js" => "js/jquery.touchSwipe.min.js",
//    "js/jquery.masonry.min.js" => "js/jquery.masonry.min.js",
//    "js/jquery.idTabs.min.js" => "js/jquery.idTabs.min.js",
    "js/script218.js" => "js/script218.js",
    "images/fancybox/jquery.fancybox.js" => "images/fancybox/jquery.fancybox.js",
//    "js/flexcroll.js" => "js/flexcroll.js",
//    "js/galleria-1.2.8.min.js" => "js/galleria-1.2.8.min.js",
//    "js/jquery.unleash.js" => "js/jquery.unleash.js",
    "menu_mb/jquery.mmenu.min.js" => "menu_mb/jquery.mmenu.min.js",
    "js/owl.carousel.js" => "js/owl.carousel.js",
//    "css/thumbnail-slider.js" => "css/thumbnail-slider.js",
//    "js/jquery.lazyload.min.js" => "js/jquery.lazyload.min.js",
    "https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" => "https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js",
//    "js/lightgallery-all.min.js" => "js/lightgallery-all.min.js",
    "js/noty.js" => "js/noty.js",
    "js/me.js" => "js/me.js",
//    "js/jquery.fittext.js" => "js/jquery.fittext.js",
//    "js/jquery.lettering.js" => "js/jquery.lettering.js",
//    "js/jquery.textillate.js" => "js/jquery.textillate.js",
);
if (!empty($_GET['min'])) {
    include 'minifier.php';

    minifyCSS($css, "css/style.min.css");

    minifyCSS($cssduoi, "css/stylefooter.min.css");

    minifyJS($js, "js/jsmin.js");
}

?>
    <script src="js/jquery-1.8.3.min.js"></script>
<?php
if ($dev) {
    foreach ($css as $k => $v) { ?>
        <link href="<?= $k ?>" rel="stylesheet" type="text/css" media="all"/>
    <?php }
} else {
    ?>
    <link href="css/style.min.css?v=<?= time() ?>" rel="stylesheet" type="text/css" media="all"/>
    <link href="menu_mb/css.min.css" rel="stylesheet" type="text/css" media="all"/>
<?php } ?>