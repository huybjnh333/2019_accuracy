<?php
include _source . "phantrang_kietxuat.php";
?>
<div class="conten_page">
    <div class="conten_right">
        <?php include _source . 'box-header.php'; ?>
        <div class="pro_home_id_2 flex">
            <?php
            if ($nd_total == 0) {
                echo "<div class='dv-notfull'>" . $glo_lang['khong_tim_thay_du_lieu_nao'] . "</div>";
            } else {
                while ($value = mysql_fetch_array($nd_kietxuat)) {
                    $tenbaiviet = $value['tenbaiviet_' . $lang];
                    $url = $full_url . '/' . $value['seo_name'];
                    $image = $fullpath . '/' . $value['duongdantin'] . '/' . $value['icon'];

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
                            <h3 itemprop="headline" class="limit-row-2"><?= $tenbaiviet ?></h3>
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
    <?php include _using . "left_conten.php"; ?>
    <div class="clr"></div>
</div>




