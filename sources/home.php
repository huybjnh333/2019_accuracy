<?php
include _source . 'phantrang_kietxuat.php';

$sanpham = DB_fet("*",
    "#_baiviet",
    "`showhi` = 1 AND `step` = 2 AND `opt2` = 1",
    "`catasort` DESC, `id` DESC", 8, 1, 1);
$stepSanpham = DB_fet("*",
    "#_step",
    "`showhi` = 1 AND `step` = 2",
    "", 1, 1, 1);
$stepSanpham = reset($stepSanpham);
$urlSanPham = $full_url . "/" . $stepSanpham['seo_name'];

$thietbi = DB_fet("*",
    "#_baiviet",
    "`showhi` = 1 AND `step` = 3 AND `opt1` = 1",
    "`catasort` DESC, `id` DESC", 6, 1, 1);
$sptn_cha = DB_fet("*",
    "#_baiviet_tinhnang",
    "`showhi` = 1 AND `step` = 2 AND id IN(2,3,4,5) AND id_parent = 0",
    "catasort asc, id asc",
    "",
    1,
    1);
?>
<div class="conten">
    <?php
    include _source . "banner_top.php";
    include _using . "gioithieu_home.php";
    ?>
    <div class="pro_home_box">
        <div class="pagewrap">
            <div class="titBox left">
                <div class="tit_2"><?= $glo_lang['sanphamcuachungtoi'] ?></div>
            </div>
            <div class="pro_home pro_home_2 home">
                <div class="placeSlide_main">
                    <div class="placeSlide_3 owl-carousel owl-theme owl-custome">
                        <?php
                        foreach ($sanpham as $value) {
                            $tenbaiviet = $value['tenbaiviet_' . $lang];
                            $image = $fullpath . "/" . $value['duongdantin'] . "/" . $value['icon'];
                            $url = $full_url . "/" . $value['seo_name'];
                            $ma_sp = $value['p1'];
                            $detail_vi = $value['detail_' . $lang];
                            ?>
                            <ul itemscope itemtype="http://schema.org/ScholarlyArticle">
                                <a href="<?= $url ?>">
                                    <li>
                                        <img class="lazy"
                                             itemprop="image"
                                             alt="<?= $tenbaiviet ?>"
                                             src="<?= $fullpath ?>/images/no-image.png"
                                             data-srcset="<?= $image ?> 2x, <?= $image ?> 1x"
                                             data-src="<?= $image ?>"/>
                                    </li>
                                    <h4 itemprop="headline" class="limit-row-2"><?= $tenbaiviet ?></h4>
                                    <p class="limit-row-2 <?= empty($ma_sp) ? "hidden" : "" ?>"><?= $glo_lang['cart_ma_sp'] ?>: <?= $ma_sp ?></p>
                                    <?php
                                    foreach ($sptn_cha as $val) {
                                        ?>
                                        <p class="limit-row-2 <?= empty(tinhnangsp($val['id'], $detail_vi, 2, $lang)) ? "hidden" : "" ?>"><?= $val['tenbaiviet_' . $lang] ?>
                                            : <?= tinhnangsp($val['id'], $detail_vi, 2, $lang); ?></p>
                                    <?php } ?>
                                </a>
                            </ul>
                        <?php } ?>
                    </div>
                    <script type="text/javascript">
                        jQuery(document).ready(function () {
                            jQuery(".placeSlide_3").owlCarousel({
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
                                        items: 2
                                    }, 600: {
                                        items: 2
                                    }, 767: {
                                        items: 3
                                    }, 991: {
                                        items: 3
                                    }, 1199: {
                                        items: 4
                                    }
                                }
                            });
                        });
                    </script>
                </div>
            </div>
            <div class="bottom_more">
                <h3><a href="<?= $urlSanPham ?>"><?= $glo_lang['xem_them'] ?><i class="fa fa-long-arrow-right"
                                                                                aria-hidden="true"></i></a>
                </h3>
            </div>
        </div>
    </div>
    <?php include _using . "htqlcl_home.php"; ?>
    <div class="home_tb">
        <div class="pagewrap">
            <div class="titBox left">
                <div class="tit_2"><?=$glo_lang['nha_may_va_thiet_bi']?></div>
            </div>
            <div class="pro_home home">
                <div class="placeSlide_main">
                    <div class="placeSlide owl-carousel owl-theme owl-custome">
                        <?php
                        foreach ($thietbi as $value) {
                            $tenbaiviet = $value['tenbaiviet_' . $lang];
                            $image = $fullpath . "/" . $value['duongdantin'] . "/" . $value['icon'];
                            $url = $full_url . "/" . $value['seo_name'];
                            ?>
                            <ul itemscope itemtype="http://schema.org/ScholarlyArticle">
                                <a href="<?= $url ?>">
                                    <li>
                                        <img class="lazy"
                                             itemprop="image"
                                             alt="<?= $tenbaiviet ?>"
                                             src="<?= $fullpath ?>/images/no-image.png"
                                             data-srcset="<?= $image ?> 2x, <?= $image ?> 1x"
                                             data-src="<?= $image ?>"/>
                                    </li>
                                    <h4 itemprop="headline" class="limit-row-3"><?= $tenbaiviet ?></h4>
                                </a>
                            </ul>
                        <?php } ?>
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
        </div>
    </div>
    <?php include _using . "tintuc_home.php"; ?>
</div>







