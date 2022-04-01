<?php
if (!defined("MOTTY")) die('???');
$step = $_POST['step'];
$dataold = $_POST['dataold'];
$limit = $_POST['limit'];
$option = $_POST['option'];
$wh = " where  step =$step and id not in($dataold)";
if (!empty($option) && $wh != '') {
    $wh = " where  step =$step and id not in($dataold) and " . $option;
}
$nd_kietxuat = DB_que("select * from #_baiviet " . $wh . " order by `catasort` DESC, `id` DESC  limit " . $limit);
$i = 0;
$array_data = array(3, 7);


while ($rows = mysql_fetch_assoc($nd_kietxuat)) {
    $i++;
    $id = $rows['id'];
    $tenbaiviet = $rows['tenbaiviet_' . $lang];
    $link = $full_url . '/' . $rows['seo_name'];
    $mota = $rows['mota_' . $lang];
    $images = $fullpath . '/' . $rows['duongdantin'] . '/' . $rows['icon'];
    $idbv = $rows['id_parent'];
    if (in_array($step, $array_data)) {
        ?>
        <div class="box-tintuc flex">
            <ul>
                <li>
                    <a href="<?= $link ?>"><img
                                src="<?= $images ?>"></a></li>
                <div class="right_tt">
                    <h2>
                        <a href="<?= $link ?>"><?= $tenbaiviet ?></a></h2>
                    <?= $mota ?>
                </div>
            </ul>
        </div>
        <script>
            data.push('<?=$id?>');
        </script>
        <?php

        continue;
    }
    if ($step == 4) { ?>
        <div class="box-thuvienanh flex">
            <ul>
                <a href="<?= GET_link($full_url, SHOW_text($rows['seo_name'])) ?>">
                    <li>
                        <img src="<?= checkImage($fullpath, $rows['icon'], $rows['duongdantin'], 'thumb_') ?>"
                             alt="<?= SHOW_text($rows['tenbaiviet_' . $lang]) ?>"/>
                    </li>
                    <h3><?= SHOW_text($rows['tenbaiviet_' . $lang]) ?></h3>
                </a>
            </ul>
        </div>
        <script>
            data.push('<?=$id?>');
        </script>
        <?php
        continue;
    }
    if ($step == 6) {
        ?>

        <div class="giaovien_id">
            <li>
                <a href="<?= $link ?>">
                    <img src="<?= $images ?>"/>
                </a>
            </li>
            <ul>
                <h3><?= $tenbaiviet ?><span><?= getdm($idbv, $lang) ?></span></h3>
                <?= $mota ?>
                <h4><a href="<?= $link ?>"><?= $glo_lang['xem_chi_tiet']; ?></a></h4>
            </ul>
            <div class="clr"></div>
        </div>
        <script>
            data.push('<?=$id?>');
        </script>
        <?php
        continue;
    }
    ?>
    <div class="box-cackhoahoc flex">
        <ul>
            <li>
                <a href="<?= $link ?>">
                    <img src="<?= $images ?>">
                </a>
            </li>
            <h3>
                <a href="<?= $link ?>">
                    <?= $tenbaiviet ?>
                </a>
            </h3>
            <?= $mota ?>
            <h4>
                <a href="<?= $link ?>"><?= $glo_lang['xem_chi_tiet'] ?><i class="fa fa-long-arrow-right"></i></a>
            </h4>
        </ul>
    </div>
    <script>
        data.push('<?=$id?>');
    </script>
    <?php
    continue;
    ?>
<?php }
if ($limit > $i) {
    echo '<script language="javascript">stopped = true; $(".bottom_more").hide();  </script>';
}
?>

