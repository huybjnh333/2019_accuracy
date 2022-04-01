<?php
// Update Luot view
$data['soluotxem'] = array();
$data['soluotxem'] = $arr_running['soluotxem'] + 1;
ACTION_db($data, '#_baiviet', 'update', NULL, "`id` = " . $arr_running['id']);
// Update Luot view
//$arrbv = DB_fet("*", "#_step", "`showhi` = 1 and id=" . $slug_step, "catasort desc", "1", 1);
//$arrbv = reset($arrbv);
//$data = DB_fet("*", "#_baiviet", "`showhi` = 1 and step=" . $slug_step, "catasort desc", "", 1);

$databaiviet = DB_fet("*", "#_baiviet", 'showhi=1 and id=' . $slug_id, "", "1", "arr", 1);
$databaiviet = $databaiviet[$slug_id];
$tenbaiviet = $databaiviet['tenbaiviet_' . $lang];
$imagebaiviet = $fullpath . "/" . $databaiviet['duongdantin'] . "/" . $databaiviet['icon'];
$noidung = $databaiviet['noidung_' . $lang];
$ma_sp = $databaiviet['p1'];
$detai_vi = $databaiviet['detail_vi'];
$giatien = $databaiviet['giatien'];
$optkm = $databaiviet['opt_km'];

$array_images = array();
array_push($array_images, $imagebaiviet);
$bvhinhanh = DB_fet("*",
    "#_baiviet_img",
    "id_parent=" . $arr_running['id'],
    "`sort` DESC",
    "5",
    1,
    1);
foreach ($bvhinhanh as $row) {
    $urlimages = $fullpath . '/datafiles/' . $row['duongdantin'] . '/' . $row['p_name'];
    array_push($array_images, $urlimages);
}

$bvlienquan = DB_fet("*", "#_baiviet", "`showhi` = 1 and id != " . $arr_running['id'] . " and id_parent =" . $arr_running['id_parent'] . " and step=" . $slug_step, "`id` desc, `catasort` desc", "8", 1);
$sanpham_tinhnangcha = DB_fet("*",
    "#_baiviet_tinhnang",
    "`showhi` = 1 AND `step` = $slug_step AND id_parent = 0",
    "catasort asc, id asc",
    "",
    1,
    1);
$sptn_cha = DB_fet("*",
    "#_baiviet_tinhnang",
    "`showhi` = 1 AND `step` = $slug_step AND id IN(2,3,4,5) AND id_parent = 0",
    "catasort asc, id asc",
    "",
    1,
    1);
?>
<div class="conten">
    <?php include _source . "box-header.php"; ?>
    <div class="pagewrap page_conten_page">
        <div class="padding_pagewrap">
            <div id="pro_img_main" class="product">
                <div class="viewLeft">
                    <div id="bridal_images" class="bridal_product"><a href='<?= $imagebaiviet ?>' class='cloud-zoom' id='zoom1'
                                               rel="position: 'inside' , showTitle: false, adjustX:0, adjustY:0"><img
                                    src="<?= $imagebaiviet ?>" alt="<?=$arr_running['tenbaiviet_'.$lang]?>"></a></div>
                    <div id="bridal_images_list" class="bridal_product_list">
                        <ul id="pro_img_slide" class="owl-images-pro-child owl-carousel owl-theme none-pargin">
                            <?php
                            foreach ($array_images as $v) {
                                ?>
                                <li><a href='<?= $v ?>' class='cloud-zoom-gallery'
                                       rel="useZoom: 'zoom1', smallImage: '<?= $v ?>'"><img
                                                src="<?= $v ?>"></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <script type="text/javascript" src="js/cloud-zoom.1.0.2.min.js"></script>
                    <?php if (count($array_images) > 4){ ?>
                    <script type="text/javascript">
                        jQuery(document).ready(function () {
                            jQuery("#pro_img_slide").owlCarousel({
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
                    <?php }else{ ?>
                        <script type="text/javascript">
                            jQuery(document).ready(function () {
                                jQuery("#pro_img_slide").owlCarousel({
                                    lazyLoad: true,
                                    loop: false,
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
                        <style>
                            .viewLeft{
                                width: 600px!important;
                            }
                            .product .owl-stage {
                                width: 100% !important;
                                height: 510px;
                                margin-right: -10px;
                                transform: translateY(0px) !important;
                                -moz-transform: translateY(0px) !important;
                                -webkit-transform: translateY(0px) !important;
                                -o-transform: translateY(0px) !important;
                                -ms-transform: translateY(0px) !important;
                            }

                            .product .owl-item{
                                width: calc(100% - 20px)!important;
                            }

                            .bridal_product_list{
                                width: 25% !important;
                            }

                            .bridal_product{
                                width: 75% !important;
                            }

                            .bridal_product img{
                                height: 500px!important;
                            }
                        </style>
                    <?php }?>
                </div>
                <!--end viewLeft-->
                <div class="viewRight">
                    <div class="titleView"><?= $tenbaiviet ?></div>
                    <h1><?=$glo_lang['gia']?>: <?=$glo_lang['lien_he']?></h1>
                    <ul class="desc">
                        <li><?= $glo_lang['cart_ma_sp'] ?>: <?= $ma_sp ?></li>
                        <?php
                        foreach ($sanpham_tinhnangcha as $rows) {
                            $str = tinhnangsp($rows['id'], $detai_vi, $slug_step, $lang);
                            ?>
                            <li <?= empty($str) ? "class='hidden'" : ""; ?>><?= $sanpham_tinhnangcha[$rows['id']]['tenbaiviet_' . $lang] ?>
                                : <?= $str ?></li>
                        <?php } ?>
                        <li><?= $glo_lang['luot_xem'] ?> <?= $arr_running['soluotxem'] ?></li>
                    </ul>
                    <div class="clr"></div>
                    <?php include _using . "sharelink.php"; ?>
                    <div class="clr"></div>
                    <div class="chitiet_sp">
                        <h4><a href="<?= $full_url . "/lien-he" ?>"><?= $glo_lang['dat_hang_ngay'] ?></a></h4>
                    </div>
                </div>
                <!--end viewRight-->
                <div class="clr"></div>
            </div>
        </div>
    </div>
    <div class="tintuc_home_box">
        <div class="pagewrap">
            <div class="titBox left">
                <div class="tit_2"><?= $glo_lang['san_pham_lien_quan'] ?></div>
            </div>
            <div class="pro_home pro_home_2 home">
                <div class="placeSlide_main">
                    <div class="placeSlide owl-carousel owl-theme owl-custome">
                        <?
                        foreach ($bvlienquan as $value) {
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
                                    <p class="limit-row-2"><?= $glo_lang['cart_ma_sp'] ?>: <?= $ma_sp ?></p>
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
        </div>
    </div>
</div>



