<?php

//include _source . 'box-header.php';
include _source . "phantrang_kietxuat.php";
?>

<div class="link_page">
    <div class="pagewrap">
        <ul>
            <li><a href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a></li>
            <li><a href="<?= $full_url ?>/san-pham-thuong-hieu/"><i aria-hidden="true"></i>
                            <?= $glo_lang['thuong_hieu'] ?></a></li>
<!--            <li><a href="--><?//= $_SERVER['REQUEST_URI'] ?><!--">--><?//= $haity ?><!--</a></li>-->
        </ul>
        <div class="clr"></div>
    </div>
</div>
<div class="clr"></div>
<div class="pagewrap page_conten_page">
    <div class="box_home_th">
        <div class="pro_home_id flex">
            <?php
            if ($nd_total == 0) {
                echo "<div class='dv-notfull'>" . $glo_lang['khong_tim_thay_du_lieu_nao'] . "</div>";
            } else {
                $i = 0;
                while ($rows = mysql_fetch_array($nd_kietxuat)) {
                    $images = $fullpath . '/' . $rows['duongdantin'] . '/' . $rows['icon'];
                    $tenbv = $rows['tenbaiviet_' . $lang];
                    $giatien = $rows['giatien'];
                    $urlbv = $full_url . '/' . $rows['seo_name'];
                    $giamgiaphantram = 0;
                    $giakhuyenmai = $rows['giakm'];
                    $optkm = $rows['opt_km'];
                    if ($giakhuyenmai > 0 && $giakhuyenmai <= 100) {
                        $giamgiaphantram = $giakhuyenmai;
                        $giakhuyenmai = number_format($giatien - ($giatien * ($giakhuyenmai / 100))) . ' ' . $glo_lang['dvt'];

                    } else if (!empty($giakhuyenmai)) {
                        $giakhuyenmai = number_format($giakhuyenmai) . ' ' . $glo_lang['dvt'];
                    }
                    if ($giatien <= 0) {
                        $giatien = $glo_lang['lien_he'];
                    } else {
                        $giatien = number_format($giatien) . ' ' . $glo_lang['dvt'];
                    }
                    ?>
                    <ul itemscope itemtype="http://schema.org/ScholarlyArticle">
                        <a href="<?= $urlbv ?>">
                            <li>
                                <img class="lazy"
                                     itemprop="image"
                                     alt=""
                                     src="<?= $fullpath ?>/images/no-image.png"
                                     data-srcset="<?= $images ?> 2x, <?= $images ?> 1x"
                                     data-src="<?= $images ?>"/>
                            </li>
                            <h3 itemprop="headline"><a href="<?= $urlbv ?>"><?= $tenbv ?></a></h3>
                            <h4>
                                <?php
                                if(!empty($giakhuyenmai) AND $optkm == 1){
                                    echo $giakhuyenmai;
                                    ?>
                                    <span class="<?= (empty($giatien) ? "hidden" : "") ?>"><?= $giatien ?></span>
                                <?php } else { echo $giatien; }  ?>
                            </h4>
                            <p><i class="fa fa-gratipay" aria-hidden="true"></i>0 Lượt Yêu Thích</p>

                        </a>
                    </ul>

                <?php }
            } ?>
            <div class="clr"></div>
        </div>
        <div class="nums">
            <ul>
                <?php
                $strphantrang = PHANTRANG($pzer, $sotrang, $full_url . "/" . $motty . '/' . $haity . '/', $_SERVER['QUERY_STRING']);
                if (!empty($baty)) {
                    $strphantrang = PHANTRANG($pzer, $sotrang, $full_url . "/" . $motty . '/' . $haity . '/' . $baty . '/', $_SERVER['QUERY_STRING']);
                }
                echo $strphantrang;
                ?>
            </ul>
            <div class="clr"></div>
        </div>
    </div>
</div>



