<?php

include _source . "phantrang_kietxuat.php";
include _source . 'box-header.php';
$display = true;
if ($slug_step != $slug_id) {
    $display = false;
}
?>

<div class="pagewrap page_conten_page">
    <div class="pro_home">
        <?php
        if ($nd_total == 0) {
            echo "<div class='dv-notfull'>" . $glo_lang['khong_tim_thay_du_lieu_nao'] . "</div>";
        } else {
            while ($row = mysql_fetch_array($nd_kietxuat)) {
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
            <?php }
        } ?>

        <div class="clr"></div>
    </div>
    <div class="nums">
        <ul>
            <?= PHANTRANG($pzer, $sotrang, $full_url . "/" . $motty, $_SERVER['QUERY_STRING']) ?>
        </ul>
        <div class="clr"></div>
    </div>
</div>
