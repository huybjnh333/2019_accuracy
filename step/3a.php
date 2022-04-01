<?php
// Update Luot view
//$data['soluotxem'] = array();
//$data['soluotxem'] = $arr_running['soluotxem'] + 1;
//ACTION_db($data, '#_baiviet', 'update', NULL, "`id` = " . $arr_running['id']);
// Update Luot view

$ngaydang = date("l", $arr_running['ngaydang']);
$ngaydang = CONVER_thu($ngaydang, $glo_lang);
$giodang = date("H:i", $arr_running['ngaydang']);
$date = date("d/m/Y", $arr_running['ngaydang']);

//Imagecon
$imagebaiviet = $fullpath . "/" . $arr_running['duongdantin'] . "/" . $arr_running['icon'];
$array_images = array();
array_push($array_images, $imagebaiviet);
$bvhinhanh = DB_fet("*",
    "#_baiviet_img",
    "id_parent=" . $arr_running['id'],
    "`sort` DESC",
    "5",
    1,
    1, "");
foreach ($bvhinhanh as $row) {
    $urlimages = $fullpath . '/datafiles/' . $row['duongdantin'] . '/' . $row['p_name'];
    array_push($array_images, $urlimages);
}

$bvlienquan = DB_fet("*",
    "#_baiviet",
    "`showhi` = 1 AND `step` = " . $slug_step . " AND id !=" . $arr_running['id'],
    "`catasort` desc, `id` desc",
    "6",
    1,
    1);

?>
<div class="conten">
    <?php include _source . "box-header.php"; ?>
    <div class="pagewrap page_conten_page">
        <div class="padding_pagewrap">
            <?php
            if ($slug_step == 3) {
                ?>
                <div class="noidung_ct_left">
                    <div class="tt_duan_id">
                        <ul>
                            <h3><?= $arr_running['tenbaiviet_' . $lang] ?></h3>
                            <?= $arr_running['noidung_' . $lang] ?>
                        </ul>
                    </div>
                    <?php include _using . "sharelink.php"; ?>
                    <div class="clr"></div>
                </div>
                <div class="hinhanh_ct_right">
                    <div class="container">
                        <div id="bridal_images" class="bridal_images_tb"><a href='<?= $imagebaiviet ?>' class='cloud-zoom' id='zoom1'
                                                   rel="position: 'inside' , showTitle: false, adjustX:0, adjustY:0"><img
                                        src="<?= $imagebaiviet ?>"></a></div>
                        <div id="bridal_images_list" class="bridal_images_list_tb">
                            <ul id="pro_img_slide" class="owl-images-pro-child owl-carousel owl-theme none-pargin">
                                <?php
                                foreach ($array_images as $v) {
                                    ?>
                                    <li><a href='<?= $v ?>' class='cloud-zoom-gallery'
                                           rel="useZoom: 'zoom1', smallImage: '<?= $v ?>'"><img
                                                    src="<?= $v ?>"></a></li>
                                <?php }?>
                            </ul>
                        </div>
                        <?php if (count($array_images) > 0){ ?>
                        <script type="text/javascript" src="js/cloud-zoom.1.0.2.min.js"></script>
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
                                            items: 2
                                        }, 479: {
                                            items: 2
                                        }, 600: {
                                            items: 3
                                        }, 767: {
                                            items: 3
                                        }, 991: {
                                            items: 4
                                        }, 1199: {
                                            items: 4
                                        }
                                    }
                                });
                            });
                        </script>
                        <?php } ?>
                    </div>
                </div>
            <?php } else { ?>
                <div class="title_news">
                    <h2><?= $arr_running['tenbaiviet_' . $lang] ?></h2>
                    <li><?= " " . $ngaydang . ", " . $giodang . "  " . $glo_lang['date'] . " " . $date ?></li>
                    <p><?= $arr_running['mota_' . $lang] ?></p>
                </div>
                <div class="showText">
                    <?= $arr_running['noidung_' . $lang] ?>
                </div>
            <?php } ?>
            <div class="clr"></div>
        </div>
    </div>
    <div class="tintuc_home_box">
        <div class="pagewrap">
            <div class="titBox left">
                <div class="tit_2"><?= $glo_lang['bai_viet_lien_quan'] ?></div>
            </div>
            <?php
            if ($slug_step == 3) {
                ?>
                <div class="pro_home">
                    <div class="placeSlide_main">
                        <div class="placeSlide owl-theme owl-carousel owl-custome">
                            <?
                            foreach ($bvlienquan as $value) {
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
                                        <h4 itemprop="headline" class="limit-row-2"><?= $tenbaiviet ?></h4>
                                    </a>
                                </ul>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="tintuc_home_id">
                    <div class="placeSlide_main">
                        <div class="placeSlide owl-carousel owl-theme owl-custome">
                            <?
                            foreach ($bvlienquan as $value) {
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
                                    <p class="limit-row-4"><?= $mota ?></p>
                                </ul>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
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






