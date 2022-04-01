<?php

$arraysearch = array(
    'search-price',

);
if (!defined("_source")) exit();

if ($motty == "") {
    include _source . "home.php";
} else if ($motty == "thoat") {
    $_SESSION['id'] = NULL;
    unset($_SESSION['id']);
    LOCATION_js($full_url);
    exit();
} else if (in_array($motty, $arraysearch)) {
    include _source . "search_manufacturer.php";
} else if ($motty == "search") {
    include _source . "search_page.php";
} else if ($motty == "tai-khoan") {
    include _source . "code_site/pa-tai-khoan.php";
} else if ($motty == "mat-khau") {
    include _source . "code_site/pa-doi-mat-khau.php";
}
//else if ($motty == "check-room") {
//    include _source . "code_site/check-room.php";
//} else if ($motty == "dat-tour") {
//    include _source . "code_site/dat-tour.php";
//}
else if (isset($slug_step) && $slug_step == "0") {
    include "step/1a.php";
} else if (!empty($arr_running) && !empty($thongtin_step['step']) && $thongtin_step['step'] != '') {
    if ($slug_table == "baiviet") {
        include "step/" . $thongtin_step['step'] . "a.php";
    } else {
        include "step/" . $thongtin_step['step'] . ".php";
    }
} else if ($motty == "crawldata") {
    include _source . "crawldata.php";
}else if ($motty == "san-pham-cung-loai") {
    include _using . "san_pham_cung_loai.php";
}
//else if ($motty == "gio-hang") {
//    include _source . "cart.php";
//} else if ($motty == "dat-hang") {
//    include _source . "buy.php";
//}
//else if ($motty == "kiem-tra-don-hang") {
//    include _source . "order_check.php";
//} else if ($motty == "lich-su-dat-hang") {
//    include _source . "quan_ly_don_hang.php";
//} else if ($motty == "dat-phong") {
//    include _source . "code_site/dat-phong.php";
//} else if ($motty == "thong-tin-dat-hang") {
//    include _source . "thong_tin_don_hang.php";
//} else if ($motty == "mat-khau-moi") {
//    include _source . "mat-khau-moi.php";
//    include _source . "home.php";
//} else if ($motty == "ty-gia") {
//    include _source . "coincap.php";
//}
else {
    $motty = "404";
    include "step/1a.php";
}
?>