<?php
@header('X-XSS-Protection:0');
session_start();
if (empty($_SESSION['datathanhpho'])) {
    $data = json_decode(file_get_contents('local.json'), true);
    $_SESSION['datathanhpho'] = $data;

}
//echo '<pre>';
//var_dump($_SESSION['datathanhpho']);
//exit();
include("nguoiquanly/config/sql.php");
include("nguoiquanly/config/function.php");
define('MOTTY', TRUE);
define('_source', "sources/");
define('_using', "sources/using/");

$lang_group = array("en", "cn");
$lang = $_SESSION["lang"] = "vi";
$full_url = $fullpath;
if (in_array($motty, $lang_group)) {
    $lang = $_SESSION["lang"] = $motty;
    $full_url = $fullpath . "/" . $motty;
    $motty = @$haity;
    $haity = @$baty;
    $baty = @$bonty;
    $bonty = @$namty;
}

//define
$danhsach_define = DB_que("SELECT * FROM `#_clanguage` WHERE `showhi` = 1 GROUP BY `code_lang`");
while ($r = mysql_fetch_array($danhsach_define)) {
    $glo_lang[$r['code_lang']] = $r['lang_' . $_SESSION['lang']];
}
//End define

//couter
if (!isset($_SESSION['ttwebsession'])) {
    $_SESSION['ttwebsession'] = md5(uniqid(rand(), true));
}

$baygio = time();
$timeroff = 7884000; // 3 thang
$online_tv = ONLINE_user(600, $_SESSION['ttwebsession']);
$thongke_tv = THONGKE_online();
// end

$check_slug = DB_que("SELECT * FROM `#_slug` WHERE `slug` = '" . $motty . "' LIMIT 1");
$slug_step = "";
$slug_page = "";
$slug_table = "";
$slug_id = "";

if (mysql_num_rows($check_slug) > 0) {
    $slug_step = mysql_result($check_slug, 0, "step");
    $slug_table = mysql_result($check_slug, 0, "bang");
    $slug_id = mysql_result($check_slug, 0, "id_bang");

    $arr_running = DB_que("SELECT * FROM `#_$slug_table` WHERE `showhi` = 1 AND `seo_name` = '" . $motty . "' LIMIT 1");
    $arr_running = mysql_fetch_assoc($arr_running);
}
// get page
if ($slug_step) {
    $thongtin_step = DB_que("SELECT * FROM `#_step` WHERE `id` = '" . $slug_step . "' LIMIT 1");
    $thongtin_step = mysql_fetch_assoc($thongtin_step);
}

//
$seo_description = "";
$seo_keywords = "";
$seo_title = "";

$thongtin = DB_que("SELECT * FROM `#_seo` LIMIT 1");
$thongtin = mysql_fetch_assoc($thongtin);
$seo_description = $thongtin['seo_description_' . $_SESSION["lang"]];
$seo_keywords = $thongtin['seo_keywords_' . $_SESSION["lang"]];
$seo_title = $thongtin['seo_title_' . $_SESSION["lang"]];
if ($thongtin['is_khoasite'] == 1 && empty($_SESSION['luluwebproadmin'])) {
    include _source . 'khoa_site.php';
    exit();
}



//
include _source . "post.php";
//
if ($motty == "search") {
    $seo_description = $seo_keywords = $seo_title = $glo_lang['tim_kiem'];
}

if (!empty($arr_running)) {
    $seo_description = $arr_running['seo_description_' . $_SESSION["lang"]];
    $seo_keywords = $arr_running['seo_keywords_' . $_SESSION["lang"]];
    $seo_title = $arr_running['seo_title_' . $_SESSION["lang"]];

    if ($arr_running['icon'] != '') {
        $seo_image = $fullpath . "/" . $arr_running['duongdantin'] . "/thumb_" . $arr_running['icon'];
    }
}
$id_old = 0;
if ($slug_table == 'baiviet') {
//    $datasession = explode('-', $_SESSION['addView']);
    if (!empty($datasession[0]) && $datasession[0] != $slug_id) {
        $data_update = array();
        $data_update['view'] = $arr_running['view'] + 1;
        ACTION_db($data_update, '#_baiviet', $kieu = 'update', '', 'id=' . $slug_id);
        $_SESSION['addView'] = $slug_id . '-' . $_SESSION['ttwebsession'];
        $id_old = $slug_id;
    }
}

include _source . "tren.php";
include _source . "router.php";
include _source . "duoi.php";

?>