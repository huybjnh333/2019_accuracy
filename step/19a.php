<?php
// Update Luot view
$data['soluotxem'] = array();
$data['soluotxem'] = $arr_running['soluotxem'] + 1;
ACTION_db($data, '#_baiviet', 'update', NULL, "`id` = " . $arr_running['id']);
// Update Luot view
include _source . 'box-header.php';
$tenbv = $arr_running['tenbaiviet_' . $lang];
$noidung = $arr_running['noidung_' . $lang];
$mota = $arr_running['mota_' . $lang];
$chudautu = $arr_running['chu_dau_tu_' . $lang];
$diachilienhe = $arr_running['dia_chi_lien_he_' . $lang];
$ngayhoanthanh = date('d-m-Y', $arr_running['ngaykhaigiang']);
$id_parent = $arr_running['id_parent'];
$baivietlienquan = DB_fet("*",
    "#_baiviet",
    "`showhi` = 1 AND `step` = '" . $slug_step . "'",
    "RAND()",
    "",
    1,
    1);

$imageschild = DB_fet("*",
    "#_baiviet_img",
    "id_parent=" . $arr_running['id'],
    "sort desc",
    "",
    1,
    1);
?>

<div class="pagewrap page_conten_page">
    <div class="padding_pagewrap">
        <div class="noidung_ct_left <?= (count($imageschild) <= 0) ? "fullwidth" : "" ?>">
            <div class="tt_duan_id">
                <h2><?= $tenbv ?></h2>
                <ul>
                    <h3><?= $glo_lang['chu_dau_tu'] ?>:</h3>
                    <p><?= $arr_running['chu_dau_tu_' . $lang] ?></p>
                </ul>
                <ul>
                    <h3><?= $glo_lang['dia_chi_lien_he'] ?>:</h3>
                    <p><?= $arr_running['dia_chi_lien_he_' . $lang] ?></p>
                </ul>
                <ul>
                    <h3><?= $glo_lang['thiet_ke'] ?>:</h3>
                    <p><?= $arr_running['thiet_ke_' . $lang] ?></p>
                </ul>
                <ul>
                    <h3><?= $glo_lang['nam_thiet_ke'] ?>:</h3>
                    <p><?= date('d-m-Y', $arr_running['ngaykhaigiang']) ?></p>
                </ul>
                <ul>
                    <h3><?= $glo_lang['dien_tich'] ?>:</h3>
                    <p><?= $arr_running['dien_tich_' . $lang] ?></p>
                </ul>
            </div>
        </div>
        <div class="hinhanh_ct_right <?= (count($imageschild) <= 0) ? "hidden" : "" ?>">
            <div class="slideshow-container">
                <?php
                $count = 1;

                foreach ($imageschild as $row) {
                    $name = "Images " . $count;
                    if (!empty($row['p_note'])) {
                        $name = $row['p_note'];
                    }
                    $imageslink = $fullpath . '/datafiles/galagy/' . $row['p_name'];
                    ?>
                    <div class="mySlides fade">
                        <img alt="<?= $name ?>" src="<?= $imageslink ?>">
                    </div>
                    <?php
                    $count++;
                } ?>
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>


            <script>
                var slideIndex = 1;
                showSlides(slideIndex);

                function plusSlides(n) {
                    showSlides(slideIndex += n);
                }

                function currentSlide(n) {
                    showSlides(slideIndex = n);
                }

                function showSlides(n) {
                    var i;
                    var slides = document.getElementsByClassName("mySlides");
                    var dots = document.getElementsByClassName("dot");
                    if (n > slides.length) {
                        slideIndex = 1
                    }
                    if (n < 1) {
                        slideIndex = slides.length
                    }
                    for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";
                    }
                    for (i = 0; i < dots.length; i++) {
                        dots[i].className = dots[i].className.replace(" active", "");
                    }
                    slides[slideIndex - 1].style.display = "block";
                    dots[slideIndex - 1].className += " active";
                }
            </script>
        </div>
        <div class="clr"></div>

        <div class="showText">
            <h2>giới thiệu chi tiết</h2>
            <?= $noidung ?>
        </div>
        <div id="sharelink">
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style "><a class="addthis_button_facebook_like"
                                                                   fb:like:layout="button_count"></a> <a
                        class="addthis_button_tweet"></a> <a class="addthis_button_google_plusone"
                                                             g:plusone:size="medium"></a> <a
                        class="addthis_counter addthis_pill_style"></a></div>
            <script type="text/javascript"
                    src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-502225fb496239a5"></script>
            <!-- AddThis Button END -->
        </div>
    </div>

</div>

<div class="services_home_box">
    <div class="pagewrap">
        <div class="titBox left">
            <div class="tit"><?= $glo_lang['bai_viet_lien_quan'] ?></div>
        </div>
        <div class="pro_home">
            <div class="placeSlide_main">
                <div class="placeSlide_2 owl-carousel owl-theme">
                    <?php foreach ($baivietlienquan as $row) {
                        if ($arr_running['id'] == $row['id'])
                            continue;
                        $tenbv = $row['tenbaiviet_' . $lang];
                        $seoname = $full_url . '/' . $row['seo_name'];
                        $images = $fullpath . '/' . $row['duongdantin'] . '/' . $row['icon'];
                        $mota = $row['mota_' . $lang];
                        $ngaydang = $row['ngaykhaigiang'];

                        ?>
                        <ul itemscope itemtype="http://schema.org/ScholarlyArticle">
                            <a href="<?= $seoname ?>">
                                <li><img itemprop="image" alt="<?= $tenbv ?>" src="<?= $images ?>"/></li>
                                <h4 itemprop="headline"><?= $tenbv ?></h4>
                                <div class="limit-row-3">
                                    <?= $mota ?>
                                </div>
                            </a>
                        </ul>
                    <?php } ?>
                </div>
                <script type="text/javascript">
                    jQuery(document).ready(function () {
                        jQuery(".placeSlide_2").owlCarousel({
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
