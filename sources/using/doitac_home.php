<?php
$doitac = DB_fet("*",
    "#_baiviet",
    "`showhi` = 1 AND `step` = 8",
    "`catasort` DESC, `id` DESC", "", 1, 1);
?>
<div class="doitac_home">
    <div class="pagewrap">
        <div class="logo_doitac">
            <div class="placeSlide_main">
                <div class="placeSlide_doiac owl-carousel owl-theme owl-custome">
                    <?php
                    foreach ($doitac as $value) {
                        $tbv = $value['tenbaiviet_' . $lang];
                        $link = $value['lienket'];
                        $image = $fullpath . '/' . $value['duongdantin'] . '/' . $value['icon'];
                        ?>
                        <ul>
                            <li >
                                <a target="_blank" href="<?= $link ?>">
                                    <img class="lazy"
                                         alt="<?= $tbv ?>"
                                         src="<?= $fullpath ?>/images/no-image.png"
                                         data-srcset="<?= $image ?> 2x, <?= $image ?> 1x"
                                         data-src="<?= $image ?>"/>
                                </a>
                            </li>
                        </ul>
                    <?php } ?>
                </div>
                <script type="text/javascript">
                    jQuery(document).ready(function () {
                        jQuery(".placeSlide_doiac").owlCarousel({
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
                                    items: 3
                                }, 767: {
                                    items: 5
                                }, 991: {
                                    items: 6
                                }, 1199: {
                                    items: 7
                                }
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>