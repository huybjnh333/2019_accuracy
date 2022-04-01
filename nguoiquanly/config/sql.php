<?php
$dev = true;
if ($_SERVER['HTTP_HOST'] != 'localhost') {
    $dev = false;
}
@header("Content-Type: text/html; charset=UTF-8");
if ($_SERVER['HTTP_HOST'] != 'localhost') {
    error_reporting(0);
}

$db_localhost = "localhost";
$db_user = "root";
$db_pass = '';
$db_data = "webdemo_2019_accuracy";
$_SESSION['sub_demo'] = "accuracy/";
$_SESSION['sub_demo_check'] = false;
$_SESSION['thumuc'] = $_SESSION['sub_demo'] . "datafiles/img_data";

if ($_SERVER['HTTP_HOST'] != 'localhost' && $_SERVER['HTTP_HOST'] != 'webdemo4.pavietnam.vn' ) {
    $_SESSION['thumuc'] = "datafiles/img_data";
    $_SESSION['sub_demo_check'] = true;
}


$db = @mysql_connect($db_localhost, $db_user, $db_pass);
if (is_string($db)) {
    include("config/db_mysql_error.php");
    exit();
}
$dbuse = @mysql_select_db($db_data, $db);
if (!$dbuse) {
    include("nguoiquanly/config/db_mysql_error.php");
    exit();
}
mysql_query("SET character_set_connection=utf8, character_set_results=utf8, character_set_client=binary");
@date_default_timezone_set('Asia/Saigon');

$domain1ty = $_SERVER['HTTP_HOST'];
$domain1ty = str_replace("www.", '', $domain1ty);

$docpat = urldecode(mb_strtolower(htmlspecialchars($_SERVER['REQUEST_URI'])));
$docpat = trim($docpat, "/");
$docpat = @explode("/", $docpat);

function CAT_CHUOI_tuchuoi($str, $char)
{
    $vitri = strpos("pa" . $str, $char);
    if ($vitri >= 2) {
        return trim(substr($str, 0, $vitri - 2));
    }
    return $str;
}

if ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == 'webdemo4.pavietnam.vn' ||$_SERVER['HTTP_HOST'] == '172.16.30.132') {
    $file_coder = @$docpat[0];
    $domain1ty = $domain1ty . "/" . $file_coder;
    $file_coder = $file_coder . "/";
    $motty = @CAT_CHUOI_tuchuoi($docpat[1], "?");
    $haity = @CAT_CHUOI_tuchuoi($docpat[2], "?");
    $baty = @CAT_CHUOI_tuchuoi($docpat[3], "?");
    $bonty = @CAT_CHUOI_tuchuoi($docpat[4], "?");
    $namty = @CAT_CHUOI_tuchuoi($docpat[5], "?");

} else {
    $file_coder = "";
    $motty = @CAT_CHUOI_tuchuoi($docpat[0], "?");
    $haity = @CAT_CHUOI_tuchuoi($docpat[1], "?");
    $baty = @CAT_CHUOI_tuchuoi($docpat[2], "?");
    $bonty = @CAT_CHUOI_tuchuoi($docpat[3], "?");
    $namty = @CAT_CHUOI_tuchuoi($docpat[4], "?");
}


if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')
    $fullpath = 'https://' . $domain1ty;
else
    $fullpath = 'http://' . $domain1ty;
$fullpath_admin = $fullpath . "/nguoiquanly/";
$auto_key_pass = "pavietnam.vn"; // dùng cho mã hoá mật khẩu

function PROCESS_data($array)
{
    if (is_array($array)) {
        $data = array();
        foreach ($array as $key => $val) {
            if (!is_array($val)) {
                $val_new = addslashes(trim($val));
                $data[$key] = $val_new;
            } else {
                $arr_2 = array();
                foreach ($val as $k => $v) {
                    $arr_2_new = addslashes(trim($v));
                    $arr_2[$k] = $arr_2_new;
                }
                $data[$key] = $arr_2;
            }
        }
        return $data;
    } else {
        return $array;
    }

}

if (!empty($_GET)) {
    $_GET = PROCESS_data($_GET);
}
if (!empty($_POST)) {
    $_POST = PROCESS_data($_POST);
}
if (!empty($_COOKIE)) {
    $_COOKIE = PROCESS_data($_COOKIE);
}
// if(!empty($_SESSION)){
// 	$_SESSION = PROCESS_data($_SESSION);
// }
if (!empty($_REQUEST)) {
    $_REQUEST = PROCESS_data($_REQUEST);
}

//if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == 'off'){
//    header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
//    exit();
//}

?>