<?php
include _source . 'box-header.php';
$noidung = $arr_running['noidung_' . $lang];
$tenbaiviet = $arr_running['tenbaiviet_' . $lang];
$mota = $arr_running['mota_' . $lang];
$ngaydang = date("l", $arr_running['ngaydang']);
$ngaydang = CONVER_thu($ngaydang, $glo_lang);
$giodang = date("H:i", $arr_running['ngaydang']);
$date = date("d/m/Y", $arr_running['ngaydang']);
$databaivietlienquan = DB_fet("*", "#_baiviet", "showhi=1 and `id` != " . $arr_running['id'] . " and step=" . $slug_step, "", "", "arr", 1);
?>
<div class="pagewrap page_conten_page">
    <div class="padding_pagewrap">
        <div class="title_news">
            <h2><?= $tenbaiviet ?></h2>
            <li><?= " " . $ngaydang . ", " . $giodang . "  " . $glo_lang['date'] . " " . $date ?></li>
        </div>
        <div class="showText">
            <?= $noidung ?>
        </div>
        <?php include _using . "sharelink.php"; ?>
    </div>
</div>
<div class="tintuc_home_box">
    <div class="pagewrap">
        <div class="titBox left">
            <div class="tit_2"><?= $glo_lang['bai_viet_lien_quan'] ?></div>
        </div>
        <div class="tintuc_home_id">
            <div class="placeSlide_main">
                <div class="placeSlide owl-carousel owl-theme owl-custome">
                    <?php
                    foreach ($databaivietlienquan as $value) {
                        $tbv = $value['tenbaiviet_' . $lang];
                        $url = $full_url . "/" . $value['seo_name'];
                        $image = $fullpath . "/" . $value['duongdantin'] . "/" . $value['icon'];
                        $mota = strip_tags($value['mota_' . $lang]);
                        $ngaydang = date("l", $value['ngaydang']);
                        $ngaydang = CONVER_thu($ngaydang, $glo_lang);
                        $giodang = date("H:i", $value['ngaydang']);
                        $date = date("d/m/Y", $value['ngaydang']);
                        ?>
                        <ul itemscope itemtype="http://schema.org/ScholarlyArticle">
                            <li><a href="<?= $url ?>">
                                    <img class="lazy"
                                         itemprop="image"
                                         alt="<?= $tbv ?>"
                                         src="<?= $fullpath ?>/images/no-image.png"
                                         data-srcset="<?= $image ?> 2x, <?= $image ?> 1x"
                                         data-src="<?= $image ?>"/>
                                </a>
                            </li>
                            <h4>
                                <i class="fa fa-calendar"></i><?= " " . $ngaydang . ", " . $giodang . "  " . $glo_lang['date'] . " " . $date ?>
                            </h4>
                            <h3 itemprop="headline" class="limit-row-2 step"><a
                                        href="<?= $url ?>"><?= $tbv ?></a></h3>
                            <p class="limit-row-4"><?= strip_tags($noidung) ?></p>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery(".placeSlide").owlCarousel({
                    lazyLoad: true,
                    loop: true,
                    nav: true,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    autoplayHoverPause: true,
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: 1
                        }, 319: {
                            items: 1
                        }, 479: {
                            items: 1
                        }, 600: {
                            items: 2
                        }, 767: {
                            items: 2
                        }, 991: {
                            items: 3
                        }, 1199: {
                            items: 3
                        }
                    }
                });
            });
        </script>
    </div>
</div>