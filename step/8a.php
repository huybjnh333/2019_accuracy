<?php
include _source . "phantrang_kietxuat.php";
//include _source . "box-header.php";
?>
<div class="conten_page">
    <div class="conten_right">
        <?php include _source . "box-header.php"; ?>
        <div class="padding_pagewrap">
            <div class="video_top">
                <?php
                $id_video = $arr_running["mt_1_" . $lang];
                $tenvideo = $arr_running['tenbaiviet_'.$lang];
                $noidung = $arr_running['noidung_' . $lang];
                ?>
                <ul>
                    <h3><?= $tenvideo ?></h3>
                    <li>
                        <iframe width="560" height="315" data-iframely-url="https://www.youtube.com/embed/<?= GET_ID_youtube($id_video) ?>" frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                    </li>
                </ul>
                <div class="padding_pagewrap">
                    <div class="showText">
                        <?= $noidung ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include _using . "left_conten.php"; ?>
    <div class="clr"></div>
</div>


