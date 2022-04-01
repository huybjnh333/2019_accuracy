<?php
include _source . "phantrang_kietxuat.php";
?>
<div class="conten_page">
    <div class="conten_right">
        <?php include _source . "box-header.php"; ?>
        <div class="padding_pagewrap ">
            <div class="video_top">
                <?php
                $video_tieubieu = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (" . $slug_step . ") ORDER BY `opt` DESC, `id` DESC LIMIT 1");
                if (mysql_num_rows($video_tieubieu)) {
                    $id_video = mysql_result($video_tieubieu, 0, 'mt_1_' . $lang);
                    $tenvideo = mysql_result($video_tieubieu,0,'tenbaiviet_'.$lang);
                    ?>
                    <ul>
                        <h3 class="limit-row-2"><?= $tenvideo ?></h3>
                        <li>
                            <iframe width="560" height="315" data-iframely-url="https://www.youtube.com/embed/<?= GET_ID_youtube($id_video) ?>" frameborder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                        </li>
                    </ul>
                <?php } ?>
            </div>
        </div>
        <div class="video_id">
            <?php
            if ($nd_total == 0) {
                echo "<div class='dv-notfull'>" . $glo_lang['khong_tim_thay_du_lieu_nao'] . "</div>";
            } else {
                while ($rows = mysql_fetch_array($nd_kietxuat)) {
                    $tenbaiviet = $rows['tenbaiviet_' . $lang];
                    $mota = $rows['mota_' . $lang];
                    $url = $full_url . '/' . $rows['seo_name'];
                    $ngaydang = $rows['ngaydang'];
                    $images = $fullpath . '/' . $rows['duongdantin'] . '/' . $rows['icon'];
                    ?>
                    <ul itemscope itemtype="http://schema.org/ScholarlyArticle">
                        <a href="<?= $url ?>">
                            <li>
                                <img class="lazy"
                                     itemprop="image"
                                     alt="<?= $tenbaiviet ?>"
                                     src="<?= $fullpath ?>/images/no-image.png"
                                     data-srcset="<?= $images ?> 2x, <?= $images ?> 1x"
                                     data-src="<?= $images ?>"/>
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

