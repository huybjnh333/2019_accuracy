<?php
$array_step = array();
$array_diff = array();
$arraydata = array();
$arraydata_title = array();
$arr_sanphamall = DB_fet("*", "#_baiviet", "`showhi` = 1 and step=1 and `tags_$lang`!=''", "catasort desc", "8", 1, 1);
$array_tags = array();
$array_not_title = array();
$danhmucname = "";
foreach ($arr_sanphamall as $row) {
    $tags = explode(',', $row['tags_' . $lang]);
    $tags_seo = explode(',', $row['tags_seo_' . $lang]);
    $count = count($tags);
    for ($i = 0; $i < $count; $i++) {
        if (array_key_exists($tags_seo[$i], $array_tags))
            continue;
        $array_tags[$tags_seo[$i]] = $tags[$i];
    }
}
if ($motty == '404') {
    $nametitle = $bre;
    $seokqkhac = DB_fet("*", "#_seo_name", "id=1", "", "", 1, "");
    $seokqkhac = reset($seokqkhac);
    $images_background = $fullpath . '/datafiles/setone/' . $seokqkhac['icon'];
} else if (($motty != 'search-news' && $motty != 'search') && $motty != 'tag') {

    $datastep = DB_fet("*", "#_step", 'showhi=1 and id=' . $slug_step, "", "1", "arr", 1);
    $datastep = reset($datastep);
    $danhmucname = $datastep['tenbaiviet_' . $lang];
    $images_background = $fullpath . '/' . $datastep['duongdantin'] . '/' . $datastep['icon'];
    $seonamestep = $full_url . '/' . $datastep['seo_name'];
    $nameseonamestep = $datastep['tenbaiviet_' . $lang];
    $arraydata[$seonamestep] = $nameseonamestep;
    $nametitle = $nameseonamestep;
    if ($slug_table == 'danhmuc') {
        if ($arr_running['id_parent'] != 0) {
            $datadanhmuc_cha = DB_fet("*", "#_danhmuc", 'showhi=1 AND id_parent = 0 and id=' . $arr_running['id_parent'], "", "1", "arr", 1);
            $datadanhmuc_cha = reset($datadanhmuc_cha);
            $seonamedanhmuc_cha = $full_url . '/' . $datadanhmuc_cha['seo_name'];
            $nameseonamedanhmuc_cha = $datadanhmuc_cha['tenbaiviet_' . $lang];
            $danhmuccha_name = $datadanhmuc_cha['tenbaiviet_' . $lang];
            $arraydata[$seonamedanhmuc_cha] = $nameseonamedanhmuc_cha;
            $nametitle = $nameseonamedanhmuc_cha;
        }
        $datadanhmuc = DB_fet("*", "#_danhmuc", 'showhi=1 and id=' . $slug_id, "", "1", "arr", 1);
        $datadanhmuc = reset($datadanhmuc);
        $seonamedanhmuc = $full_url . '/' . $datadanhmuc['seo_name'];
        $nameseonamedanhmuc = $datadanhmuc['tenbaiviet_' . $lang];
        $danhmucname = $datadanhmuc['tenbaiviet_' . $lang];
        $arraydata[$seonamedanhmuc] = $nameseonamedanhmuc;
        $nametitle = $nameseonamedanhmuc;
    }

    if ($slug_table == 'baiviet') {
        $databaiviet = DB_fet("*",
            "#_baiviet",
            'showhi=1 and id=' . $slug_id, "", "1", "arr", 1, "");
        $databaiviet = reset($databaiviet);
        $seonamebaiviet = $full_url . '/' . $databaiviet['seo_name'];
        $nameseonamebaiviet = $databaiviet['tenbaiviet_' . $lang];

        $datadanhmuc = DB_fet("*",
            "#_danhmuc",
            'showhi=1 and id=' . $databaiviet['id_parent'],
            "",
            "1",
            "arr",
            1, "");
        $datadanhmuc = reset($datadanhmuc);
        if (!empty($databaiviet['id_parent'])) {
            $danhmucname = $datadanhmuc['tenbaiviet_' . $lang];
        }
        $seonamedanhmuc = $full_url . '/' . $datadanhmuc['seo_name'];
        $nameseonamedanhmuc = $datadanhmuc['tenbaiviet_' . $lang];

        //////dm cha
//        if(empty($datadanhmuc)){
//            $datadanhmuc_cha = DB_fet("*", "#_step", 'showhi=1 AND id_parent = 0 and id=' . $datadanhmuc['id_parent'], "", "1", "arr", 1);
//            $datadanhmuc_cha = reset($datadanhmuc_cha);
//            var_dump($datadanhmuc_cha);
//            $seonamedanhmuc_cha = $full_url . '/' . $datadanhmuc_cha['seo_name'];
//            $nameseonamedanhmuc_cha = $datadanhmuc_cha['tenbaiviet_' . $lang];
//            $arraydata[$seonamedanhmuc_cha] = $nameseonamedanhmuc_cha;
//            $nametitle = $nameseonamedanhmuc_cha;
//        }

        /////

        $arraydata[$seonamedanhmuc] = $nameseonamedanhmuc;
        $nametitle = $nameseonamebaiviet;

        if($slug_step == 1){
            if (!in_array($slug_step, $array_not_title)) {
                $arraydata[$seonamebaiviet] = $nameseonamebaiviet;
            }
            if (in_array($slug_step, $array_step)) {
                $nametitle = $nameseonamedanhmuc;
            }
            if (in_array($slug_step, $arraydata_title)) {
                $nametitle = $nameseonamebaiviet;
            }
        }else{
            $nametitle = $danhmucname;
        }
    }

} else {
    $nametitle = $glo_lang['tim_kiem'];
    $arraydata[$full_url . '/search/' . $haity] = $nametitle;
}
?>
<?php
$banner_top = LAY_banner(" AND `id_parent` = 25");
while ($r = mysql_fetch_array($banner_top)) {
    $imagesbox = $fullpath . "/" . $r['duongdantin'] . "/" . $r['icon'];
}
$strshort = "";
$count = 0;

foreach ($arraydata as $k => $v) {
    $count++;
    if (empty($v))
        continue;
    if ($count < count($arraydata)) {
        $strshort .= '<li><a  href="' . $k . '" > ' . $v . '</a></li>';
    } else {
        $strshort .= '<li><a href="' . $k . '"> ' . $v . '</a></li>';
    }
}

$image_danhmuc = DB_que("SELECT * FROM `#_step` WHERE `id` = '$slug_step'  LIMIT 1");
if ($motty == "search") {
    $image_danhmuc = DB_que("SELECT * FROM `#_step` WHERE `id` = 3  LIMIT 1");
}
$image_danhmuc = mysql_fetch_assoc($image_danhmuc);
$image = $fullpath . '/' . $image_danhmuc['duongdantin'] . '/' . $image_danhmuc['icon'];
?>
<div class="imges_id_page" style="background-image:url(<?=$image?>);"></div>
<div class="link_page">
    <div class="pagewrap">
        <h3><?= $nametitle ?></h3>
        <ul>
            <li><i class="fa fa-home"><a href="<?= $full_url . '/'; ?>"></a></i></li>
            <li><a href="<?= $full_url . '/'; ?>"><?= $glo_lang['trang_chu']; ?></a></li>
                <?= $strshort ?>
            <div class="clr"></div>
        </ul>
        <div class="clr"></div>
    </div>
</div>





