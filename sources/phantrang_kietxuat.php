<?php
$numview = 12;
//if ($slug_table == 'danhmuc' || $motty == 'search') {
//    $numview = 32;
//}
//if ($motty == 'search') {
//    $numview = 30;
//}

$pzer = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

$vi_tri = PHANTRANG_start($pzer, $numview);
if ($pzer == 1 || $pzer == NULL)
    $pzz = 0;
else $pzz = $pzer * $numview;

if (empty($wh)) $wh = '';
$nd_kietxuat = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (" . $slug_step . ") $wh ORDER BY `catasort` DESC LIMIT $vi_tri,$numview");
$nd_total = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (" . $slug_step . ") $wh");

$danhmucsp = $slug_id;

//if (($slug_table == 'danhmuc' && $slug_step == 2) || ($slug_table == 'danhmuc' && $slug_step == 4)) {
//    $danhmuccon = DB_fet("id",
//        "#_danhmuc",
//        "`showhi` = 1 AND `id` = $slug_id AND `step` = " . $slug_step,
//        "catasort desc, id desc",
//        "",
//        1, 1);
//    $arraydm = array();
//    foreach ($danhmuccon as $row) {
//        array_push($arraydm, $row['id']);
//    }
//    $danhmucsp = implode(',', $arraydm);
//    if ($arr_running['id_parent'] == 0) {
//        $danhmuccon = DB_fet("id",
//            "#_danhmuc",
//            "`showhi` = 1 AND `step` = " . $slug_step . " AND `id_parent` = " . $danhmucsp,
//            "catasort desc, id desc",
//            "",
//            1, 1);
//        $arraydm = array();
//        array_push($arraydm, $danhmucsp);
//        foreach ($danhmuccon as $row) {
//            array_push($arraydm, $row['id']);
//        }
//        $danhmucsp = implode(',', $arraydm);
//    }
//}

/////////////////

//echo "SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `id_parent` IN (" . $danhmucsp . ") $wh ORDER BY `catasort` DESC, `id` DESC LIMIT $vi_tri,$numview";

if ((($slug_step != $slug_id) || $slug_table == 'danhmuc') && $thongtin_step['step'] != 8) {
    $nd_kietxuat = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `id_parent` IN (" . $danhmucsp . ") $wh ORDER BY `catasort` DESC, `id` DESC LIMIT $vi_tri,$numview");
    $nd_total = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `id_parent` IN (" . $danhmucsp . ") $wh");
}
if ($motty == 'search') {
    $nd_kietxuat = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND step in (2) AND `tenbaiviet_$lang` like '%" . $haity . "%' OR `p1` like '%" . $haity . "%' ORDER BY `catasort` DESC, `id` DESC LIMIT $vi_tri,$numview");
    $nd_total = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND  step in(2) AND  `tenbaiviet_$lang` like '%" . $haity . "%' OR `p1` like '%" . $haity . "%'");

//    if(!empty($haity)){
//        $strsql = "SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND step  in(2) AND `tenbaiviet_$lang` like '%" . $haity . "%' ";
//        $nd_kietxuat = DB_que($strsql . "ORDER BY `catasort` DESC, `id` DESC LIMIT $vi_tri,$numview");
//        $nd_total = DB_que($strsql);
//    }

    if (!empty($_GET['tn'])) {
        $strsearch = "  ";
        if (!empty($_GET['dm'])) {
            $strsearch = " id_parent in (" . $_GET['dm'] . ") AND ";
        }
        $tn = explode("-", $_GET['tn']);
        foreach ($tn as $rowtn) {
            $strsearch .= "FIND_IN_SET($rowtn,detail_vi) AND ";
        }
        $strsearch = substr($strsearch, 0, -5);
//        echo "SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND step  in(2) AND $strsearch ORDER BY `catasort` DESC, `id` DESC LIMIT $vi_tri,$numview";
        $nd_kietxuat = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND step  in(2) AND $strsearch ORDER BY `catasort` DESC, `id` DESC LIMIT $vi_tri,$numview");
        $nd_total = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND  step in(2) AND $strsearch ");
    }


//    if (!empty($baty)) {
//        $strsql = "SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND step  in(2) AND `tenbaiviet_$lang` like '%" . $haity . "%' ";
//        $nd_kietxuat = DB_que($strsql . "ORDER BY `catasort` DESC, `id` DESC LIMIT $vi_tri,$numview");
//        $nd_total = DB_que($strsql);
//        echo $strsql;

//    }
}

//if($slug_step == 2){
//    $danhmuc = DB_fet("*", "#_danhmuc", "`showhi` = 1 AND `id_parent` = 0 and step = " . $slug_step,
//        "catasort asc, id asc", "", 1, 1);
//    foreach ($danhmuc as $rows) {
//        $id = $rows['id'];
//        $nd_kietxuat = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND step in(2) AND `id_parent` = ".$id." ORDER BY `catasort` DESC, `id` DESC LIMIT $vi_tri,$numview");
//        $nd_total = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND step in(2) AND `id_parent` = ".$id." ");
//    }
//
//}

if ($motty == 'search-price') {

    $nd_kietxuat = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND step  in(2) AND FIND_IN_SET($haity, `detail_vi`) ORDER BY `catasort` DESC, `id` DESC LIMIT $vi_tri,$numview");
    $nd_total = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND  step in(2) AND FIND_IN_SET($haity, `detail_vi`)");
}
if ($motty == 'tag' && empty($_GET['type'])) {
    $nd_kietxuat = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND step  in(1) AND FIND_IN_SET ('$haity', `tags_seo_$lang`) ORDER BY `catasort` DESC, `id` DESC ");
    $nd_total = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND  step in(1) AND FIND_IN_SET ('$haity', `tags_seo_$lang`)");
}

if ($slug_step == 6 AND $motty = 'thu-vien-video') {
    $nd_kietxuat = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `id` != " . $arr_running['id'] . " AND `step` IN (" . $slug_step . ") $wh ORDER BY `catasort` DESC LIMIT $vi_tri,$numview");
    $nd_total = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `id` != " . $arr_running['id'] . " AND `step` IN (" . $slug_step . ") $wh");
}

//if($slug_step == 6 AND $arr_running['seo_name'] != "chung-nhan-chat-luong"){
//    $nd_kietxuat = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `id_parent` != 17 AND `step` IN (" . $slug_step . ") $wh ORDER BY `catasort` DESC LIMIT $vi_tri,$numview");
//    $nd_total = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` =  1 AND `id_parent` != 17 AND `step` IN (" . $slug_step . ") $wh");
//}


$nd_total = @mysql_num_rows($nd_total);
$numshow = ceil($nd_total / $numview);
$sotrang = PHANTRANG_findPages($nd_total, $numview);
?>