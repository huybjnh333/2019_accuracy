<?php
if (!defined("MOTTY")) die('???');
$page = $_POST['page'];
$id = $_POST['id'];
$step = $_POST['step'];
$key = $_POST['key'];
$total = $_POST['total'];
$numview = $_POST['numview'];
$id_run = !empty($_POST['id_run']) && is_numeric($_POST['id_run']) ? $_POST['id_run'] : 0;

if (!is_numeric($numview)) $numview = 6;


if ($page < 1) $page = 1;
$start = ($numview * $page) - $numview;
$wh = "";

if ($id != 0 && $id != "")
    $wh .= " AND `id_parent` in (" . $id . ") ";

if ($id_run > 0) {
    $wh .= " AND `id` <> " . $id_run . " ";
}
if ($key != '')
    $wh .= " AND (`tenbaiviet_vi` LIKE '%" . $key . "%' OR `tenbaiviet_en` LIKE '%" . $key . "%')";

$nd_kietxuat = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `step` = '" . $step . "' $wh ORDER BY `catasort` DESC LIMIT $start," . $numview);

$array_special = array(3, 7);


$i = 0;
while ($rows = mysql_fetch_assoc($nd_kietxuat)) {
    $i++;
    $idbv = $rows['id_parent'];
    if ($step == 6) {
        ?>
        <div class="giaovien_id">
            <li>
                <a href="<?= GET_link($full_url, SHOW_text($rows['seo_name'])) ?>">
                    <img src="<?= checkImage($fullpath, $rows['icon'], $rows['duongdantin'], 'thumb_') ?>"/>
                </a>
            </li>
            <ul>
                <h3><?= SHOW_text($rows['tenbaiviet_' . $lang]) ?><span><?= getdm($idbv, $lang) ?></span></h3>
                <p><?= SHOW_text(strip_tags($rows['mota_' . $lang])) ?></p>
                <h4>
                    <a href="<?= GET_link($full_url, SHOW_text($rows['seo_name'])) ?>"><?= $glo_lang['xem_chi_tiet']; ?></a>
                </h4>
            </ul>
            <div class="clr"></div>
        </div>
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
        <?php
        continue;
    }
    if (in_array($step, $array_special)) { ?>
        <div class="box-tintuc flex">
            <ul>
                <li>
                    <a href="<?= GET_link($full_url, SHOW_text($rows['seo_name'])) ?>">
                        <img src="<?= checkImage($fullpath, $rows['icon'], $rows['duongdantin'], 'thumb_') ?>"/>
                    </a>
                </li>
                <div class="right_tt">
                    <h2>
                        <a href="<?= GET_link($full_url, SHOW_text($rows['seo_name'])) ?>">
                            <?= SHOW_text($rows['tenbaiviet_' . $lang]) ?>
                        </a>
                    </h2>
                    <p><?= SHOW_text(strip_tags($rows['mota_' . $lang])) ?></p>
                </div>
            </ul>
        </div>
        <?php
        continue;
    }
    ?>
    <div class="box-khoahoc flex">
        <ul>
            <div class="ajax_scron ajax_scron_<?= $page ?>"></div>
            <li><a href="<?= GET_link($full_url, SHOW_text($rows['seo_name'])) ?>">
                    <img
                            src="<?= checkImage($fullpath, $rows['icon'], $rows['duongdantin'], 'thumb_') ?>"
                            alt="<?= SHOW_text($rows['tenbaiviet_' . $lang]) ?>"/></a></li>
            <h3>
                <a href="<?= GET_link($full_url, SHOW_text($rows['seo_name'])) ?>"><?= SHOW_text($rows['tenbaiviet_' . $lang]) ?></a>
            </h3>
            <p><?= SHOW_text(strip_tags($rows['mota_' . $lang])) ?></p>
            <h4><a href="<?= GET_link($full_url, SHOW_text($rows['seo_name'])) ?>"><?= $glo_lang['xem_chi_tiet'] ?></a>
            </h4>
        </ul>
    </div>
<?php }
if ($total <= ($numview * $page)) {
    echo '<script language="javascript">stopped = true; $(".bottom_more").hide();  </script>';
}
?>