<?php
if ((!empty($thongtin_step) && $thongtin_step['num_view'] == 0) || empty($thongtin_step))
    $numview = 16;
else $numview = $thongtin_step['num_view'];


// $key       = isset($_GET['key']) ? str_replace("+", " ", strip_tags($_GET['key'])) : '';
// $is_search = $motty == 'search' ? true : false;


$is_search = isset($_GET['pla']) || isset($_GET['emp']) ? true : false;
$pla = isset($_GET['pla']) && is_numeric($_GET['pla']) ? $_GET['pla'] : "";
$emp = isset($_GET['emp']) && is_numeric($_GET['emp']) ? $_GET['emp'] : "";

if ($is_search) {
    // $slug_step      = 3;
    // $lay_all_kx     = LAYDANHSACH_idkietxuat(0, $slug_step);
    // $thongtin_step  = DB_que("SELECT * FROM `#_step` WHERE `id` = '$slug_step' LIMIT 1");
    // $thongtin_step  = mysql_fetch_assoc($thongtin_step);
    $lay_all_kx = LAYDANHSACH_idkietxuat(0, $slug_step);
} else if ($slug_table == 'step') {
    $lay_all_kx = LAYDANHSACH_idkietxuat(0, $slug_step);
    $tenhienthi = SHOW_text($thongtin_step['tenbaiviet_' . $lang]);
} else {
    $tenhienthi = SHOW_text($arr_running['tenbaiviet_' . $lang]);
    $lay_all_kx = LAYDANHSACH_idkietxuat($arr_running['id'], $slug_step);
}

// if($is_search) $slug_step = "1,2,3";

$wh = "";
if ($is_search) {
    if ($pla != '')
        $lay_all_kx = LAYDANHSACH_idkietxuat($pla, $slug_step);
    if ($emp != '')
        $wh .= " AND FIND_IN_SET(" . $emp . ", `detail_vi`) > 0 ";

    // $wh .= " AND (`tenbaiviet_vi` LIKE '%".$key."%' OR `tenbaiviet_en` LIKE '%".$key."%' OR `p1` = '".$key."')";
}
$wh .= "  AND `id_parent` in (" . $lay_all_kx . ") ";


include _source . "phantrang_kietxuat.php";

$anhcon = LAY_anhstep($thongtin_step['id'], 1);
//include _source . 'box-header.php';
?>
<div class="conten_page">
    <div class="conten_right">
        <?php include _source . "box-header.php"; ?>
        <div class="doitac_id flex">
            <?php
            if ($nd_total == 0) {
                echo "<div class='dv-notfull'>" . $glo_lang['khong_tim_thay_du_lieu_nao'] . "</div>";
            } else {
                while ($value = mysql_fetch_array($nd_kietxuat)) {
                    $tbv = $value['tenbaiviet_' . $lang];
                    $linkdoitac = $value['lienket'];
                    $url = $full_url."/".$value['seo_name'];
                    $image = $fullpath . "/" . $value['duongdantin'] . "/" . $value['icon'];
                    ?>
                    <ul itemscope itemtype="http://schema.org/ScholarlyArticle">
                        <a href="<?=$url?>">
                            <li>
                                <img class="lazy"
                                     itemprop="image"
                                     alt="<?= $tbv ?>"
                                     src="<?= $fullpath ?>/images/no-image.png"
                                     data-srcset="<?= $image ?> 2x, <?= $image ?> 1x"
                                     data-src="<?= $image ?>"/>
                            </li>
                            <h3 itemprop="headline"><p  class="limit-row-3"><?=SHOW_text($tbv)?></p></h3>
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




