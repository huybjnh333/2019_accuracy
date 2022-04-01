<?php
$sp_ban_chay = DB_fet("*",
    "#_baiviet",
    "`showhi` = 1 AND step in (2) AND opt2=1",
    "`catasort` DESC, `id` DESC",
    "15",
    1,
    1);
$tintieubieuhome = DB_fet("*",
    "#_baiviet",
    "`showhi` = 1 AND step =4 AND opt1=1 ",
    "",
    6,
    1,
    1);
$name = "";
$datamenu = '';
$showhi = "hidden";
$array_hidden = array(2, 5, 6, 7);
$array_dmuc = array(2, 3, 4);
if (!empty($slug_step)) {
    $datstep = DB_fet("*",
        "#_step",
        "`showhi` = 1 AND id =$slug_step",
        "",
        1,
        1,
        1);
    $datstep = reset($datstep);
    $name = $datstep['tenbaiviet_' . $lang];
    $datamenu = DB_fet("*",
        "#_baiviet",
        "`showhi` = 1 AND step = $slug_step",
        "catasort desc, id desc",
        "",
        1,
        1);
    if (in_array($slug_step, $array_dmuc)) {
        $datamenu = DB_fet("*",
            "#_danhmuc",
            "`showhi` = 1 AND step = $slug_step AND id_parent = 0",
            "catasort asc, id asc",
            "",
            1,
            1);
    }
}

if (!empty($slug_step) && !in_array($slug_step, $array_hidden)) {
    $showhi = "";
}
$tingnangmucgia = DB_fet("*",
    "#_baiviet_tinhnang",
    "`showhi` = 1 AND step =2 AND id_parent =11 ",
    "catasort asc",
    "",
    1,
    1);
$showhigiatien = "hidden";
$array_page = array(
    'search-price',
    'gio-hang',
    'dat-hang');
if ($slug_step == 2) {
    $showhigiatien = "";
}
if (in_array($motty, $array_page)) {
    $showhigiatien = "";
    $datamenu = DB_fet("*",
        "#_danhmuc",
        "`showhi` = 1 AND step = 2 AND id_parent = 0",
        "catasort asc, id asc",
        "",
        1,
        1);
}
?>


<div class="box_id_home <?= $showhi ?>">
    <div class="title_tin_id">
        <h3><?= $name ?></h3>
    </div>
    <div class="menu_left">
        <ul>
            <?php foreach ($datamenu as $row) {
                $url = $full_url . '/' . $row['seo_name'] . '/';
                $tenmenu = $row['tenbaiviet_' . $lang];
                ?>
                <li><a href="<?= $url ?>" title="<?= $tenmenu ?>"><?= $tenmenu ?></a></li>
            <?php } ?>
        </ul>
    </div>
</div>
<div class="box_id_home <?= $showhigiatien ?>">
    <div class="title_tin_id">
        <h3><?= $glo_lang['san-pham'] ?></h3>
    </div>
    <div class="dv-menu-left no_box">
        <div class="dv-ul-menu">
            <ul class="sub-1" id="accordion-1">
                <?php foreach ($datamenu as $row) {
                    $url = $full_url . '/' . $row['seo_name'] . '/';
                    $tenmenu = $row['tenbaiviet_' . $lang];
                    $iddm_child = $row['id'];
                    $datamenu_child = DB_fet("*",
                        "#_danhmuc",
                        "`showhi` = 1 AND id_parent = $iddm_child",
                        "catasort asc, id asc",
                        "",
                        1,
                        1);
                    ?>
                    <li><a href="<?= $url ?>" title="<?= $tenmenu ?>"><?= $tenmenu ?></a>
                        <ul class="sub-2 <?= (empty($datamenu_child) ? "hidden" : "") ?>">
                            <?php foreach ($datamenu_child as $row_child) {
                                $url_child = $full_url . '/' . $row_child['seo_name'] . '/';
                                $tenmenu_child = $row_child['tenbaiviet_' . $lang];
                                ?>
                                <li>
                                    <a href="<?= $url_child ?>"
                                       title="<?= $tenmenu_child ?>">» <?= $tenmenu_child ?></a>
                                </li>
                            <?php } ?>
                        </ul>

                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>


<div class="box_id_home <?= $showhigiatien ?>">
    <div class="title_tin_id">
        <h3><?= $glo_lang['gia_tien'] ?></h3>
    </div>
    <div class="check_id">
        <ul>
            <?php foreach ($tingnangmucgia as $row) {
                $idtinhnang = $row['id'];
                $tentinhnang = $row['tenbaiviet_' . $lang];
                $totalsp = DB_fet("*",
                    "#_baiviet",
                    "`showhi` = 1 AND step =2 AND FIND_IN_SET($idtinhnang, `detail_vi`) ",
                    "",
                    "",
                    1,
                    1);
                ?>
                <label class="container"><?= $tentinhnang ?><span> (<?= count($totalsp) ?>)</span>
                    <input onclick="searchPrice(<?= $idtinhnang ?>)" type="checkbox">
                    <span class="checkmark"></span>
                </label>
            <?php } ?>
        </ul>
    </div>
</div>
<div class="box_id_home">
    <div class="title_tin_id">
        <h3><?= $glo_lang['san_pham_ban_chay'] ?></h3>
    </div>
    <div class="pro_home_id_3">
        <div class="marquee">
            <?php foreach ($sp_ban_chay as $rows) {
                $images = $fullpath . '/' . $rows['duongdantin'] . '/' . $rows['icon'];
                $tenbv = $rows['tenbaiviet_' . $lang];
                $mota = $rows['mota_' . $lang];
                $urlbv = $full_url . '/' . $rows['seo_name'];
                $ngaydang = date('d/m/Y', $rows['ngaydang']);
                $giatien = $rows['giatien'];
                $giamgiaphantram = 0;
                $giakhuyenmai = $rows['giakm'];
                if ($giakhuyenmai > 0 && $giakhuyenmai <= 100) {
                    $giamgiaphantram = $giakhuyenmai;
                    $giakhuyenmai = number_format($giatien - ($giatien * ($giakhuyenmai / 100))) . ' ' . $glo_lang['dvt'];

                } else {
                    $giakhuyenmai = number_format($giakhuyenmai) . ' ' . $glo_lang['dvt'];
                }
                if ($giatien <= 0) {
                    $giatien = $glo_lang['lien_he'];
                } else {
                    $giatien = number_format($giatien) . ' ' . $glo_lang['dvt'];
                }
                $masp = $rows['p1'];
                ?>
                <ul itemscope itemtype="http://schema.org/ScholarlyArticle">
                    <a href="<?= $urlbv ?>" title="<?= $tenbv ?>">
                        <div class="discount-tag <?= (empty($giamgiaphantram)) ? "hidden" : "" ?>">
                            <?= $giamgiaphantram ?>%
                        </div>
                        <li>
                            <img itemprop="image" alt="<?= $tenbv ?>" src="<?= $images ?>"/>
                        </li>
                        <h3 itemprop="headline"><?= $tenbv ?></h3>
                        <?php if ($giakhuyenmai > 0 && $rows['opt_km'] > 0) { ?>
                            <h4><?= $giakhuyenmai ?> <span><?= $giatien ?></span></h4>
                        <?php } else { ?>
                            <h4><?= $giatien ?></h4>
                        <?php } ?>
                        <p><?= $glo_lang['cart_ma_sp'] ?>: <?= $masp ?></p>
                    </a>
                </ul>
            <?php } ?>
            <div class="clr"></div>
        </div>

    </div>
</div>
<div class="box_id_home">
    <div class="title_tin_id">
        <h3><?= $glo_lang['tin_tuc_noi_bac'] ?></h3>
    </div>
    <div class="tt_left_id">
        <?php foreach ($tintieubieuhome as $rows) {

            $images = $fullpath . '/' . $rows['duongdantin'] . '/' . $rows['icon'];
            $tenbv = $rows['tenbaiviet_' . $lang];
            $mota = $rows['mota_' . $lang];
            $urlbv = $full_url . '/' . $rows['seo_name'];
            ?>
            <ul itemscope itemtype="http://schema.org/ScholarlyArticle">
                <a href="<?= $urlbv ?>">
                    <li>
                        <img itemprop="image" alt="<?= $tenbv ?>" src="<?= $images ?>"/>
                    </li>
                    <h3 class="limit-row-3" itemprop="headline"><?= $tenbv ?></h3>
                </a>
                <div class="clr"></div>
            </ul>
        <?php } ?>
    </div>
</div>
<script>
    function searchPrice(idsp) {
        var fullurl_redirect = "<?=$full_url . '/search-price/'?>" + idsp + "/";
        window.location.replace(fullurl_redirect);
    }
</script>