    <div class="bannerMain">
        <ul class="banner owl-carousel owl-theme" id="owl-banner">
            <?php
            $banner_top = LAY_banner(" AND `id_parent` = 16");
            $count = 1;
            while ($r = mysql_fetch_array($banner_top)) {
                $images = $fullpath . '/' . $r['duongdantin'] . '/' . $r['icon'];
                $tenbaiviet = $r['tenbaiviet_' . $lang];
//            $noidung = $r['noidung_' . $lang];
                $mota = $r['mota_' . $lang];
                $link = $r['lien_ket'];
                if (empty($r['lien_ket'])) {
                    $link = $full_url . '/den-led';
                }
                $p1 = $r['p1'];
                ?>
                <li class="item">
<!--                    <div class="pagewrap">-->
<!--                        <div class="box_title_banner">-->
<!--                            <ul>-->
<!--                                <h3>--><?//= $tenbaiviet ?><!--</h3>-->
<!--                                <p class="limit-row-3">--><?//= strip_tags($mota) ?><!--</p>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </div>-->
                    <img alt="<?= $tenbaiviet . " " . $count ?>" class="owl-lazy" data-src="<?= $images ?>">
                </li>
                <?php
                $count++;
            } ?>
        </ul>
        <div class="clr"></div>
    </div>







