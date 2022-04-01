<?php
if (!defined("MOTTY")) die();

//gui binh luan
if ($motty == "gui-binh-luan" && isset($_POST)) {
    $data = array();
    $data['tenbaiviet_vi'] = LOC_char($_POST['bl_tieude']);
    $data['noidung_vi'] = LOC_char($_POST['bl_noidung']);
    $data['hoten'] = LOC_char($_POST['bl_hoten']);
    $data['sodienthoai'] = LOC_char($_POST['bl_sodienthoai']);
    $data['id_sp'] = LOC_char($_POST['idbv']);
//    $data['id_parent'] = LOC_char($_POST['id_parent']);
    $data['ip_gui'] = GET_ip();
    $data['ngay_dang'] = time();
    $data['showhi'] = 0;
    ACTION_db($data, '#_binhluan', 'add', NULL, NULL);
    $_SESSION['token'] = md5(RANDOM_chuoi(5));
    $return = array("data" => 1);
    echo json_encode($return);
    exit();

}
//end gui binh luan
if ($motty == "add-sao" && isset($_POST)) {
    $id = $_POST['id'];
    $sao = $_POST['sao'];
    // unset($_SESSION['sao'][$id]);
    if (!empty($_SESSION['sao'][$id])) {
        echo $glo_lang['ban_da_binh_chon_cho_san_pham_nay'];
        exit();
    }
    $_SESSION['sao'][$id] = $id;
    DB_que("UPDATE `#_baiviet` SET `sao_" . $sao . "` = `sao_" . $sao . "` + 1, `num_1` = `num_1` + $sao, `num_2` = `num_2` + 1 WHERE `id` = '$id'");
    echo $glo_lang['cam_on_ban_da_binh_chon_cho_san_pham_nay'];
    exit();
}
if (isset($_POST['action_s']) && $_POST['action_s'] == "get_diadiem") {
    $id = $_POST['id'];
    $text = $_POST['text'];
    echo '<option value="">' . $text . '</option>';
    $diadiem = LAY_diadiem();
    foreach ($diadiem as $val_1) {
        if ($val_1['id_parent'] != $id) continue;
        echo '<option value="' . $val_1['id'] . '">' . $val_1['tenbaiviet_' . $lang] . '</option>';
    }
    exit();
}
if (isset($_POST['send_lienhe'])) {
    if ((!empty($_POST['notsecuty'])) || (!empty($_POST['mabaove']) && strtolower($_POST['mabaove']) == strtolower($_SESSION['captcha']['code'])) || (!empty($_POST['id_token']) && $_POST['id_token'] == $_SESSION['token'])) {

        $admin_email = LAY_email(1);
        $htmlbox = file_get_contents("nguoiquanly/htmlbox/1m.html");
        $logo = $fullpath . "/" . $thongtin['duongdantin'] . "/" . $thongtin['logo'];
        $thongtinheader = $thongtin['tencongty_' . $lang];
        $footer = "<p><b>" . $thongtin['tencongty_' . $lang] . "</b></p>";
        $footer .= $thongtin['sodienthoai_' . $lang] != "" ? "<p>" . $glo_lang['so_dien_thoai'] . ": " . $thongtin['sodienthoai_' . $lang] . "</p>" : "";
        $footer .= $thongtin['email_' . $lang] != "" ? "<p>" . $glo_lang['email'] . ": " . $thongtin['email_' . $lang] . "</p>" : "";
        $footer .= $thongtin['diachi_' . $lang] != "" ? "<p>" . $glo_lang['dia_chi'] . ": " . $thongtin['diachi_' . $lang] . "</p>" : "";


        $s_fullname = isset($_POST['s_fullname']) ? $_POST['s_fullname'] : "";
        $s_fullname_s = isset($_POST['s_fullname_s']) ? $_POST['s_fullname_s'] : "";

        $s_dienthoai = isset($_POST['s_dienthoai']) ? $_POST['s_dienthoai'] : "";
        $s_dienthoai_s = isset($_POST['s_dienthoai_s']) ? $_POST['s_dienthoai_s'] : "";

        $s_email = isset($_POST['s_email']) ? $_POST['s_email'] : "";
        $s_email_s = isset($_POST['s_email_s']) ? $_POST['s_email_s'] : "";

        $s_address = isset($_POST['s_address']) ? $_POST['s_address'] : "";
        $s_address_s = isset($_POST['s_address_s']) ? $_POST['s_address_s'] : "";

        $s_title = isset($_POST['s_title']) ? $_POST['s_title'] : "";
        $s_title_s = isset($_POST['s_title_s']) ? $_POST['s_title_s'] : "";

        $s_message = isset($_POST['s_message']) ? $_POST['s_message'] : "";
        $s_message_s = isset($_POST['s_message_s']) ? $_POST['s_message_s'] : "";

        $tieude_lienhe = isset($_POST['tieude_lienhe']) ? base64_decode($_POST['tieude_lienhe']) : "";

        $noidung = "";
        $noidung .= RETURN_text_lienhe($s_fullname_s, $s_fullname);
        $noidung .= RETURN_text_lienhe($s_dienthoai_s, $s_dienthoai);
        $noidung .= RETURN_text_lienhe($s_email_s, $s_email);
        $noidung .= RETURN_text_lienhe($s_address_s, $s_address);
        $noidung .= RETURN_text_lienhe($s_title_s, $s_title);
        $noidung .= RETURN_text_lienhe($s_message_s, $s_message);

        for ($i = 1; $i < 50; $i++) {
            if (isset($_POST['group_form_send_' . $i])) {
                $noidung .= RETURN_text_lienhe($_POST['group_form_send_' . $i . '_s'], $_POST['group_form_send_' . $i]);
            }
        }

        $message = str_replace(array("%thongtin_lienhe%", "%footer%", '%logo%', '%thongtinheader%', '%noidung%'),
            array(LOC_char($tieude_lienhe), $footer, LOC_char($logo), $thongtinheader, $noidung), $htmlbox);

        $data = array();
        $data['tenbaiviet_vi'] = LOC_char($tieude_lienhe);
        $data['ip_gui'] = GET_ip();
        $data['ngay_dang'] = time();
        $data['noi_dung_vn'] = addslashes($message);

        $data['showhi'] = 0;
        ACTION_db($data, '#_form_lienhe', 'add', NULL, NULL);

        ob_start();
        GUI_email("$admin_email", "", $tieude_lienhe, $_SERVER['SERVER_NAME'], $message, $thongtin);
        ob_end_clean();

        if (!empty($_POST['id_token'])) {
            $_SESSION['token'] = md5(RANDOM_chuoi(5));
            $return = array("err" => 1, "token" => $_SESSION['token']);
            echo json_encode($return);
        } else {
            echo 1;
        }

    } else {
        if (!empty($_POST['id_token'])) {
            $_SESSION['token'] = md5(RANDOM_chuoi(5));
            $return = array("err" => 2, "token" => $_SESSION['token']);
            echo json_encode($return);
        } else echo 2;
    }
    exit();
}

if (isset($_POST['gui_donhang'])) {
    if (strtolower($_POST['mabaove']) == strtolower($_SESSION['captcha']['code'])) {
        $id_sp = "";
        $so_luong = "";
        $don_gia = "";
        $logo = $fullpath . "/" . $thongtin['duongdantin'] . "/" . $thongtin['logo'];
        $ctyname = $thongtin['tencongty_' . $lang];
        $thongtinheader = $thongtin['tencongty_' . $lang];
        $thongtin_dathang = "<table border='1'  cellspacing='0' cellpadding='4' style='width:100%; border-collapse: collapse; font-family:Tahoma; font-size:11px;text-align: center;' bordercolor='#cccccc'>";
        $thongtin_dathang .= '<tr> <th width="7%">STT</th> <th width="20%">' . $glo_lang['cart_ten_sp'] . '</th> <th width="10%">' . $glo_lang['cart_qty'] . '</th> <th width="15%">' . $glo_lang['cart_dongia'] . '</th> <th width="15%">' . $glo_lang['cart_thanhtien'] . '</th> </tr>';
        $thongtin_dathang = "<table border='1'  cellspacing='0' cellpadding='4' style='width:100%; border-collapse: collapse; font-family:Tahoma; font-size:11px;text-align: center;' bordercolor='#cccccc'>";
        $thongtin_dathang .= '<tr> <th width="7%">STT</th> <th width="20%">' . $glo_lang['cart_ten_sp'] . '</th> <th width="10%">' . $glo_lang['cart_qty'] . '</th> <th width="15%">' . $glo_lang['cart_dongia'] . '</th> <th width="15%">' . $glo_lang['cart_thanhtien'] . '</th> </tr>';
        $footer = "<p><b>" . $thongtin['tencongty_' . $lang] . "</b></p>";
        $footer .= $thongtin['sodienthoai_' . $lang] != "" ? "<p>" . $glo_lang['so_dien_thoai'] . ": " . $thongtin['sodienthoai_' . $lang] . "</p>" : "";
        $footer .= $thongtin['email_' . $lang] != "" ? "<p>" . $glo_lang['email'] . ": " . $thongtin['email_' . $lang] . "</p>" : "";
        $footer .= $thongtin['diachi_' . $lang] != "" ? "<p>" . $glo_lang['dia_chi'] . ": " . $thongtin['diachi_' . $lang] . "</p>" : "";
        $tongtien = 0;
        $stt = 0;
        foreach ($_SESSION['cart'] as $key => $value) {
            $sanpham = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` = 1 AND `id` = '" . $key . "' LIMIT 1");
            if (mysql_num_rows($sanpham) > 0) {
                $sanpham = mysql_fetch_array($sanpham);

                $dongia = $sanpham['giatien'];
                $giasp = $sanpham['giatien'];
                $giakm = $sanpham['giakm'];
                $optkm = $sanpham['opt_km'];
                $giamgiaphantram = 0;
                if ($giakm < 100 && $giakm > 0) {
                    $giamgiaphantram = $giakm;
                }
                if ($optkm > 0 && $giakm > 0) {
                    $temp = $giasp;
                    $giasp = $giakm;
                    $giakm = $temp;
                    $dongia = $giasp;
                    if ($giamgiaphantram > 0) {

                        $dongia = $giakm - ($giakm * ($giamgiaphantram / 100));
                    }
                }
                $id_sp .= $key . ",";
                $so_luong .= $value . ",";
                $don_gia .= $dongia . ",";
                $thanhtien = $value * $dongia;
                $tongtien += $thanhtien;
                $stt++;
                $thongtin_dathang .= '<tr>
                <td>' . $stt . '</td>
                <td><a href="' . $full_url . "/" . $sanpham['seo_name'] . '">' . $sanpham['tenbaiviet_' . $_SESSION['lang']] . '</a></td>
                <td>' . $value . '</td>
                <td>' . NUMBER_fomat($dongia) . '</td>
                <td>' . NUMBER_fomat($thanhtien) . '</td>
              </tr>';
            }
        }
        $thongtin_dathang .= '<tr> <td colspan="4" style="text-align:right;color:red;font-weight:bold;">' . $glo_lang['cart_tong_tien'] . ':</td> <td colspan="2"><span id="pro_sum"> <label style="color:red;font-weight:bold;">' . NUMBER_fomat($tongtien) . '' . $glo_lang['dvt'] . '</label> </span> </td> </tr>';
        $thongtin_dathang .= "</table>";

        $id_sp = trim($id_sp, ",");
        $so_luong = trim($so_luong, ",");
        $don_gia = trim($don_gia, ",");

        $admin_email = LAY_email(1);
        $data_html = file_get_contents("nguoiquanly/htmlbox/cart.html");

        $s_fullname = $_POST['s_fullname'];
        $s_dienthoai = $_POST['s_dienthoai'];
        $s_email = $_POST['s_email'];
        $s_address = $_POST['s_address'];
        $s_message = $_POST['s_message'];

        $s_thanhtoan = $_POST['type_payment'];
        if ($s_thanhtoan == 1) $s_thanhtoannd = $glo_lang['thanh_toan_tien_mat'];
        else if ($s_thanhtoan == 2) $s_thanhtoannd = $glo_lang['thanh_toan_chuyen_khoan'];
        else $s_thanhtoannd = $glo_lang['thanh_toan_qua_paypal'];

        $data = array();
        $data['iduser'] = @$_SESSION['id'];
        $data['hoten'] = $s_fullname;
        $data['sodienthoai'] = $s_dienthoai;
        $data['email'] = $s_email;
        $data['diachi'] = $s_address;
        $data['ghichu'] = $s_message;
        $data['idsp'] = $id_sp;
        $data['soluong'] = $so_luong;
        $data['dongia'] = $don_gia;
        $data['ngaydat'] = time();
        $data['thanhtoan'] = $s_thanhtoan;
        $data['trangthai'] = 1;

        if (isset($_SESSION['ma-giam-gia'])) {
            $s_magiamgia = $_SESSION['ma-giam-gia']['magiamgia'];
            $s_sotiengiam = $_SESSION['ma-giam-gia']['sotiengiam'];
            $data['ma_giam_gia'] = $s_magiamgia;
            $data['so_tien'] = $s_sotiengiam;
        }
        ACTION_db($data, "#_order", 'add', NULL, NULL);

        $id_order = mysql_insert_id();

        $madh = 'DH' . mt_rand(1000, 9999) . $id_order;
        $data1['madh'] = $madh;
        ACTION_db($data1, "#_order", 'update', NULL, "`id` = $id_order");

        $message = str_replace(array("%madh%", "%hoten%", "%dienthoai%", "%email%", "%diachi%", "%thongtinkhac%", "%thanhtoan%", "%noidungdathang%", "%logo%", "%thongtinheader%", "%ctyname%", "%ngaydat%", "%footer%"),
            array($madh, $s_fullname, $s_dienthoai, $s_email, $s_address, $s_message, $s_thanhtoannd, $thongtin_dathang, $logo, $thongtinheader, $ctyname, date('d/m/Y H:i'), $footer), $data_html);

        $subject = $glo_lang['thong_tin_dat_hang'];

        ob_start();
        GUI_email("$admin_email;$s_email", "", "$subject", $_SERVER['SERVER_NAME'], $message, $thongtin);
        ob_end_clean();
        // echo $message;

        if ($motty = 'dat-hang') {
            $arr_donhang = array(
                'type' => 0,
                'mess' => "",
                'money' => '',
                'madh' => '',
                'error' => 0,
            );

            $donhang = DB_que("SELECT * FROM `#_order` WHERE `madh` = '" . $data1['madh'] . "'");
            while ($rows = mysql_fetch_assoc($donhang)) {
                $madh = $rows['madh'];
                $type_payment = $rows['thanhtoan'];
                $arr_donhang['madh'] = $data1['madh'];
                $arr_donhang['money'] = $tongtien;
                $arr_donhang['error'] = 1;
                $arr_donhang['type'] = $type_payment;
            }
            if ($arr_donhang['error'] == 1) {
                unset($_SESSION['ma-giam-gia']);
                unset($_SESSION['cart']);
            }
            echo json_encode($arr_donhang);
            exit;
        }

        unset($_SESSION['ma-giam-gia']);
        unset($_SESSION['cart']);
        echo 1;
    } else echo 2;
    exit();
}

if ($motty == "paypal-success") {
    $_SESSION['sessionid'] = session_id();
    $id_user = $_SESSION['sessionid'];
    if (!empty($_SESSION['id'])) {
        $id_user = $_SESSION['id'];
    }
    $donhang = DB_que("SELECT * FROM `#_order` WHERE `iduser` = '" . $id_user . "' ORDER BY `id` DESC LIMIT 1");
    $donhang = mysql_fetch_assoc($donhang);
    $madh = $donhang['madh'];
    LOCATION_js($full_url . "/thong-tin-dat-hang/" . $madh);
    exit();
}

if ($motty == "paypal-false") {
    LOCATION_js($full_url);
    exit();
}

if ($motty == "robots.txt") {
    header('Content-Type: text/plain');
    echo $thongtin['robots'];
    exit();
}

if ($motty == "pa-size-child" && is_file(_source . "code_site/pa-" . $haity . ".php")) {
    include _source . "code_site/pa-" . $haity . ".php";
    exit();
}

if ($motty == "sitemap.xml") {
    include "sitemap.php";
    exit();
}

if ($motty == "load-capcha") {
    include("nguoiquanly/plugins/captcha/simple-php-captcha.php");
    exit();
}

if ($motty == 'load-danhmuc-ajax') {
    include "phantrang_danhmuc_ajax.php";
    exit();
}
if ($motty == 'load-products-ajax') {
    include "phantrang_kietxuat_ajax.php";
    exit();
}
if ($motty == 'load-tour-ajax') {
    include "phantrang_tour_ajax.php";
    exit();
}
if ($motty == 'load-news-ajax') {
    include "phantrang_new_ajax.php";
    exit();
}
if ($motty == 'load-more-data') {
    include "phantrang_more_data.php";
    exit();
}
if ($motty == 'load-video-ajax') {
    include "phantrang_video_ajax.php";
    exit();
}
if ($motty == 'load-room-ajax') {
    include "phantrang_room_ajax.php";
    exit();
}

if ($motty == 'load-img-ajax') {
    include "phantrang_img_ajax.php";
    exit();
}

if ($motty == 'dang-ky-phone') {
    if (!empty($_POST)) {
        $v_phone = $_POST['v_phone'];
        $_SESSION['cap_phone'] = RAND(11111, 99999);

        $check_query = DB_que("SELECT `id` FROM `#_phone_follow` WHERE `phone` = '" . $v_phone . "' LIMIT 1");
        if (mysql_num_rows($check_query) == 0) {
            $data = array();
            $data['phone'] = $v_phone;
            $data['ddate'] = time();
            $data['showhi'] = 1;

            ACTION_db($data, '#_phone_follow', 'add', NULL);
            $thongbao = $glo_lang['phone_text_thanhcong'];
        } else $thongbao = $glo_lang['phone_text_datontai'];

    } else $thongbao = $glo_lang['loi_dang_ky'];

    $return = array("new_cap" => $_SESSION['cap_phone'], "message" => $thongbao);
    echo json_encode($return);
    exit();
}

if ($motty == 'doi-mat-khau') {

    $table = "#_members";
    $sql = DB_que("SELECT * FROM $table WHERE `showhi` = 1 AND `id` = '" . $_SESSION['id'] . "' AND `phanquyen` = 0 LIMIT 1");
    $row = mysql_fetch_array($sql);
    $sql_keypass = SHOW_text($row['keypass']);
    $sql_matkhau = SHOW_text($row['matkhau']);

    $matkhau_old = $_REQUEST['passold_dk'];
    $keypass = RANDOM_chuoi(5);
    $matkhau = create_pass($auto_key_pass . md5($auto_key_pass . $_POST['pass_dk']), $keypass);
    $matkhau_old = create_pass($auto_key_pass . md5($auto_key_pass . $matkhau_old), $sql_keypass);
    if ($matkhau_old == $sql_matkhau) {
        if (trim($_POST['pass_dk']) != '') {
            $data['keypass'] = $keypass;
            $data['matkhau'] = $matkhau;
        }

        ACTION_db($data, "#_members", 'update', NULL, "`id` = '" . $_SESSION['id'] . "' AND `phanquyen` = 0 LIMIT 1");
        echo 1;
    } else echo 2;
    exit();
}
if ($motty == "lay-mat-khau") {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $key = isset($_POST['key']) ? $_POST['key'] : '';
    $sql = DB_que("SELECT * FROM `#_members` WHERE `showhi` = 1 AND `email` = '" . $email . "' AND `active` = '" . $key . "' AND `phanquyen` = 0 LIMIT 1");

    $row = mysql_fetch_array($sql);
    $sql_keypass = SHOW_text($row['keypass']);
    $keypass = RANDOM_chuoi(5);
    $matkhau = create_pass($auto_key_pass . md5($auto_key_pass . $_POST['pass_dk']), $sql_keypass);

    $ex_key = @explode("O_K", $key);

    if (@$ex_key[1] != md5(GET_ip())) {
        $messenge['error'] = 1;
        echo json_encode($messenge);
        exit();
    } else {
        $data = array();
        $data['matkhau'] = $matkhau;
        $data['active'] = '';
        ACTION_db($data, "#_members", 'update', NULL, "`email` = '" . $email . "' AND `active`  = '" . $key . "' AND `phanquyen` = 0 LIMIT 1");
        $messenge['error'] = 0;
        echo json_encode($messenge);
        exit();
    }
    exit();
}

if ($motty == 'check-doi-thong-tin') {
    $hoten = $_REQUEST['fullname_dk'];
    $sodienthoai = $_REQUEST['phone_dk'];
    $diachi = $_REQUEST['diachi'];
    // $gioitinh       = $_REQUEST['gioitinh_dk'];

    // $bd_date        = $_REQUEST['bd_date'];
    // $bd_month       = $_REQUEST['bd_month'];
    // $bd_year        = $_REQUEST['bd_year'];
    // $ngaysinh       = $bd_date.'/'.$bd_month.'/'.$bd_year;

    $data = array();
    $data['hoten'] = $hoten;
    $data['sodienthoai'] = $sodienthoai;
    $data['diachi'] = $diachi;
    // $data['gioitinh']       = $gioitinh;
    // $data['ngaysinh']       = $ngaysinh;


    ACTION_db($data, "#_members", 'update', NULL, "`id` = '" . $_SESSION['id'] . "' AND `phanquyen` = 0 LIMIT 1");
    $_SESSION['hoten'] = $hoten;
    exit();
}

if ($motty == 'dang-ky-mail') {
    $_SESSION['cap'] = "";
    $v_email = isset($_POST['v_email']) ? $_POST['v_email'] : "";
    $v_name = isset($_POST['v_name']) ? $_POST['v_name'] : "";
    $v_phone = isset($_POST['v_phone']) ? $_POST['v_phone'] : "";

    $capcha_hd = $_POST['capcha_hd'];
    if (isset($_SESSION['cap']) && $_SESSION['cap'] == $capcha_hd) {
        $_SESSION['cap'] = RAND(11111, 99999);
        if (!filter_var($v_email, FILTER_VALIDATE_EMAIL) === false) {
            $check_query = DB_que("SELECT `id` FROM `#_email_follow` WHERE `email` = '" . $v_email . "' LIMIT 1");
            if (mysql_num_rows($check_query) == 0) {
                $data = array();
                $data['email'] = $v_email;
                $data['v_name'] = $v_name;
                $data['v_phone'] = $v_phone;
                $data['ddate'] = time();
                $data['showhi'] = 1;
                //$data['nstatus']  = 1;

                ACTION_db($data, '#_email_follow', 'add', NULL);
                $thongbao = $glo_lang['them_dia_chi_email_thanh_cong'];
            } else $thongbao = $glo_lang['dia_chi_email_da_ton_tai'];
        } else {
            $thongbao = $glo_lang['dia_chi_email_khong_hop_le'];
        }
    } else $thongbao = $glo_lang['loi_dang_ky'];

//    else {
//        if (!filter_var($v_email, FILTER_VALIDATE_EMAIL) === false) {
//            if ($_POST['v_name'] == "") {
//                $thongbao = $glo_lang['chua_nhap_email_hoac_sdt'];
//            } else {
//                $thongbao = $glo_lang['dia_chi_email_da_ton_tai'];
//            }
//        } else {
//            $thongbao = $glo_lang['dia_chi_email_khong_hop_le'];
//        }
//    }
    $return = array("new_cap" => $_SESSION['cap'], "message" => $thongbao);
    echo json_encode($return);
    exit();
}

if ($motty == 'add-cart') {
    $arr_cart = array(
        'type' => 0,
        'quantity' => "",
    );

    foreach ($_POST as $k => $v) {
        ${$k} = $v;
    }

    $numcart = 0;
    if (!empty($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
        foreach ($cart as $k => $row) {
            $numcart += $row;
        }
    }
    if (isset($_SESSION['cart'][$id_cart])) {
        $_SESSION['cart'][$id_cart] = $_SESSION['cart'][$id_cart] + $quantity;
        $arr_cart['quantity'] = $numcart;
        $arr_cart['type'] = 1;
    } else {
        $_SESSION['cart'][$id_cart] = $quantity;
        $arr_cart['type'] = 1;
    }
    $return = array("type" => $arr_cart['type'], "quantity" => ($numcart + 1) . " " . $glo_lang['san-pham']);
    echo json_encode($return);
    exit();
}


if ($motty == 'check-dang-nhap') {
    if (isset($_POST['txt_email'])) {
        $email = addslashes($_POST['txt_email']);
        $pass = addslashes($_POST['txt_pass']);

        //Kiểm tra tên đăng nhập có tồn tại không
        $query = DB_que("SELECT `id`,`matkhau`,`keypass`, `hoten` FROM `#_members` WHERE `showhi` = 1 AND `email`='" . mysql_real_escape_string($email) . "' AND `phanquyen` = 0 LIMIT 1");
        if (mysql_num_rows($query) == 0) {
            $messenge['error'] = 1;
            // $messenge['ms']     = email_pass_khong_khong_dung;
            echo json_encode($messenge);
            exit();
        }

        //Lấy mật khẩu trong database ra
        $row = mysql_fetch_array($query);
        $keypass = $row['keypass'];
        // $phannhom = $row['diemuytin'];
        $pass = create_pass($auto_key_pass . md5($auto_key_pass . $pass), $keypass);

        //So sánh 2 mật khẩu có trùng khớp hay không
        if ($pass != $row['matkhau']) {
            $messenge['error'] = 1;
            // $messenge['ms']     = email_pass_khong_khong_dung;
            echo json_encode($messenge);
            exit();
        }

        //Lưu tên đăng nhập
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $email;
        $_SESSION['hoten'] = $row['hoten'];
        $messenge['error'] = 0;
        echo json_encode($messenge);
        exit();
    }
    exit();
}

if ($motty == 'check-dang-ky') {
    if (isset($_POST['email_dk'])) {
        $email = $_POST['email_dk'];
        $hoten = $_POST['fullname_dk'];
        $sodienthoai = $_POST['phone_dk'];
        $diachi = $_POST['diachi'];
        $keypass = RANDOM_chuoi(5);
        $matkhau = create_pass($auto_key_pass . md5($auto_key_pass . addslashes($_POST['pass_dk'])), $keypass);

        $query = DB_que("SELECT * FROM `#_members` WHERE `email`='" . mysql_real_escape_string($email) . "' LIMIT 1");
        if (mysql_num_rows($query) > 0) {
            $messenge['error'] = 1;
            echo json_encode($messenge);
            exit();
        }

        $data = array();
        $data['tentruycap'] = str_replace(strstr($email, '@'), '', $email) . (rand(999, 9999)) . time();
        $data['email'] = $email;
        $data['hoten'] = $hoten;
        $data['sodienthoai'] = $sodienthoai;
        $data['keypass'] = $keypass;
        $data['matkhau'] = $matkhau;
        $data['diachi'] = $diachi;


        $data['phanquyen'] = 0;
        $data['showhi'] = 1;

        $id = ACTION_db($data, '#_members', 'add', array("themmoi"), NULL);

        //gui mai
        $admin_email = LAY_email(1);
        $htmlbox = file_get_contents("nguoiquanly/htmlbox/1m.html");
        $logo = $fullpath . "/" . $thongtin['duongdantin'] . "/" . $thongtin['logo'];
        $thongtinheader = $thongtin['tencongty_' . $lang];
        $footer = "<p><b>" . $thongtin['tencongty_' . $lang] . "</b></p>";
        $footer .= $thongtin['sodienthoai_' . $lang] != "" ? "<p>" . $glo_lang['so_dien_thoai'] . ": " . $thongtin['sodienthoai_' . $lang] . "</p>" : "";
        $footer .= $thongtin['email_' . $lang] != "" ? "<p>" . $glo_lang['email'] . ": " . $thongtin['email_' . $lang] . "</p>" : "";
        $footer .= $thongtin['diachi_' . $lang] != "" ? "<p>" . $glo_lang['dia_chi'] . ": " . $thongtin['diachi_' . $lang] . "</p>" : "";

        $subject = "Thông tin tài khoản khách hàng";

        $noidung = '<tr><td colspan="7"><p>Kính gửi: ' . $hoten . '</p><p>Chào Quý khách,</p><p>Cảm ơn quý khách đã đăng ký thành viên tại website ' . $_SERVER['HTTP_HOST'] . '</p><p>Chúng tôi xin gửi thông tin tài khoản như sau:</p><p>Email: ' . $email . '<br/><br/>Mật khẩu: ' . $_POST['pass_dk'] . '</p></td></tr>';

        $message = str_replace(array("%thongtin_lienhe%", "%footer%", '%logo%', '%thongtinheader%', '%noidung%'),
            array(LOC_char($subject), $footer, LOC_char($logo), $thongtinheader, $noidung), $htmlbox);


        ob_start();
        GUI_email("$email", "$hoten", "$subject", $_SERVER['SERVER_NAME'], $message, $thongtin);
        ob_end_clean();
        //end gui mai

        // $_SESSION['email'] = $email;
        // $_SESSION['id']    = $id;
        // $_SESSION['hoten'] = $hoten;
        $messenge['error'] = 0;
        echo json_encode($messenge);
        exit();
    }
    exit();
}

if ($motty == 'check-email') {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $sql = DB_que("SELECT * FROM `#_members` WHERE `showhi` = 1 AND `phanquyen` = 0 AND `email` = '" . $email . "' LIMIT 1");
        if (mysql_num_rows($sql) > 0) {
            $r = mysql_fetch_assoc($sql);
            $hoten = $r['hoten'];
            $active = md5(time()) . "O_K" . md5(GET_ip());
            $data = array();
            $data['active'] = $active;

            $sql = ACTION_db($data, '#_members', 'update', array("capnhat"), "`email` = '" . $email . "' AND `phanquyen` = 0");

            $admin_email = LAY_email(1);
            $htmlbox = file_get_contents("nguoiquanly/htmlbox/1m.html");
            $logo = $fullpath . "/" . $thongtin['duongdantin'] . "/" . $thongtin['logo'];
            $thongtinheader = $thongtin['tencongty_' . $lang];
            $footer = "<p><b>" . $thongtin['tencongty_' . $lang] . "</b></p>";
            $footer .= $thongtin['sodienthoai_' . $lang] != "" ? "<p>" . $glo_lang['so_dien_thoai'] . ": " . $thongtin['sodienthoai_' . $lang] . "</p>" : "";
            $footer .= $thongtin['email_' . $lang] != "" ? "<p>" . $glo_lang['email'] . ": " . $thongtin['email_' . $lang] . "</p>" : "";
            $footer .= $thongtin['diachi_' . $lang] != "" ? "<p>" . $glo_lang['dia_chi'] . ": " . $thongtin['diachi_' . $lang] . "</p>" : "";


            $url = $full_url . '/mat-khau-moi/?email=' . $r['email'] . '&key=' . $active;
            $subject = $glo_lang['guide_change_pass'];

            $noidung = '<tr><td colspan="7"><p>Xin Chào ' . $hoten . ',</p><p>Chúng tôi nhận được yêu cầu đổi mật khẩu từ email của bạn. Bạn hãy <a href="' . $url . '">nhấn vào đây</a> để tiến hành thay đổi mật khẩu.</p><p>Xin cảm ơn và rất mong tiếp tục nhận được sự ủng hộ của bạn!</p></td></tr>';

            $message = str_replace(array("%thongtin_lienhe%", "%footer%", '%logo%', '%thongtinheader%', '%noidung%'),
                array(LOC_char($subject), $footer, LOC_char($logo), $thongtinheader, $noidung), $htmlbox);

            ob_start();
            GUI_email("$email", "$hoten", "$subject", $_SERVER['SERVER_NAME'], $message, $thongtin);
            ob_end_clean();

            $messenge['error'] = 0;
            $messenge['ms'] = $email;
        } else {
            $messenge['error'] = 1;
        }

        echo json_encode($messenge);
        exit();
    }
    exit();
}

if ($motty == 'dang-xuat') {
    unset($_SESSION['id']);
    unset($_SESSION['email']);
    unset($_SESSION['hoten']);
    LOCATION_js($full_url);
    exit();
}


if (isset($_POST['action_gui'])) {
    $id_gui = $_POST['id_gui'];
    $id_form = $_POST['id_form'];
    $list_id = $_POST['list_id'];
    $list_title = $_POST['list_title'];
    $array_save = array();

    $list_id_cout = count($list_id);
    for ($i = 0; $i < $list_id_cout; $i++) {
        $name = isset($_POST['name_' . $list_id[$i]]) ? $_POST['name_' . $list_id[$i]] : '';

        if (isset($_POST['check_box_name_' . $list_id[$i]])) {
            $name = "";
            unset($_SESSION['form_chekbox']['ckb' . $list_id[$i]]);
            foreach ($_POST['check_box_name_' . $list_id[$i]] as $value) {
                if ($value != '') {
                    $name .= "[" . $value . "] ";
                    $_SESSION['form_chekbox']['ckb' . $list_id[$i]][] = $value;
                }

            }
        }
        $array_save[] = array("id" => $list_id[$i], "td" => $list_title[$i], "nd" => $name);

        if (isset($_POST['name_' . $list_id[$i]])) {
            $_SESSION['form']['name_' . $list_id[$i]] = $name;
        }


    }

    if (strtolower($_POST['mabaove']) == strtolower($_SESSION['captcha']['code'])) {
        $data = array();
        $data['id_gui'] = $id_gui;
        $data['id_form'] = $id_form;
        $data['ngay_dang'] = time();
        $data['noidung_vi'] = serialize($array_save);
        $data['showhi'] = 0;
        unset($_SESSION['form']);
        ACTION_db($data, '#_form_danhmuc_nd', 'add');
        ALERT_js($glo_lang['yeu_cau_cua_ban_da_duoc_gui']);
        LOCATION_js($full_url);
    } else {
        ALERT_js($glo_lang['nhap_ma_bao_ve_chua_dung']);
    }
}

if (isset($_POST['send_lienhe'])) {


    if ((!empty($_POST['notsecuty'])) || (!empty($_POST['mabaove']) && strtolower($_POST['mabaove']) == strtolower($_SESSION['captcha']['code'])) || (!empty($_POST['id_token']) && $_POST['id_token'] == $_SESSION['token'])) {

        $admin_email = LAY_email(1);
        $htmlbox = file_get_contents("nguoiquanly/htmlbox/1m.html");
        $logo = $fullpath . "/" . $thongtin['duongdantin'] . "/" . $thongtin['logo'];
        $thongtinheader = $thongtin['tencongty_' . $lang];
        $footer = "<p><b>" . $thongtin['tencongty_' . $lang] . "</b></p>";
        $footer .= $thongtin['sodienthoai_' . $lang] != "" ? "<p>" . $glo_lang['so_dien_thoai'] . ": " . $thongtin['sodienthoai_' . $lang] . "</p>" : "";
        $footer .= $thongtin['email_' . $lang] != "" ? "<p>" . $glo_lang['email'] . ": " . $thongtin['email_' . $lang] . "</p>" : "";
        $footer .= $thongtin['diachi_' . $lang] != "" ? "<p>" . $glo_lang['dia_chi'] . ": " . $thongtin['diachi_' . $lang] . "</p>" : "";


        $s_fullname = isset($_POST['s_fullname']) ? $_POST['s_fullname'] : "";
        $s_fullname_s = isset($_POST['s_fullname_s']) ? $_POST['s_fullname_s'] : "";

        $s_dienthoai = isset($_POST['s_dienthoai']) ? $_POST['s_dienthoai'] : "";
        $s_dienthoai_s = isset($_POST['s_dienthoai_s']) ? $_POST['s_dienthoai_s'] : "";

        $s_email = isset($_POST['s_email']) ? $_POST['s_email'] : "";
        $s_email_s = isset($_POST['s_email_s']) ? $_POST['s_email_s'] : "";

        $s_address = isset($_POST['s_address']) ? $_POST['s_address'] : "";
        $s_address_s = isset($_POST['s_address_s']) ? $_POST['s_address_s'] : "";

        $s_title = isset($_POST['s_title']) ? $_POST['s_title'] : "";
        $s_title_s = isset($_POST['s_title_s']) ? $_POST['s_title_s'] : "";

        $s_message = isset($_POST['s_message']) ? $_POST['s_message'] : "";
        $s_message_s = isset($_POST['s_message_s']) ? $_POST['s_message_s'] : "";

        $tieude_lienhe = isset($_POST['tieude_lienhe']) ? base64_decode($_POST['tieude_lienhe']) : "";

        $noidung = "";
        $noidung .= RETURN_text_lienhe($s_fullname_s, $s_fullname);
        $noidung .= RETURN_text_lienhe($s_dienthoai_s, $s_dienthoai);
        $noidung .= RETURN_text_lienhe($s_email_s, $s_email);
        $noidung .= RETURN_text_lienhe($s_address_s, $s_address);
        $noidung .= RETURN_text_lienhe($s_title_s, $s_title);
        $noidung .= RETURN_text_lienhe($s_message_s, $s_message);

        for ($i = 1; $i < 50; $i++) {
            if (isset($_POST['group_form_send_' . $i])) {
                $noidung .= RETURN_text_lienhe($_POST['group_form_send_' . $i . '_s'], $_POST['group_form_send_' . $i]);
            }
        }

        $message = str_replace(array("%thongtin_lienhe%", "%footer%", '%logo%', '%thongtinheader%', '%noidung%'),
            array(LOC_char($tieude_lienhe), $footer, LOC_char($logo), $thongtinheader, $noidung), $htmlbox);

        $data = array();
        $data['tenbaiviet_vi'] = LOC_char($tieude_lienhe);
        $data['ip_gui'] = GET_ip();
        $data['ngay_dang'] = time();
        $data['noi_dung_vn'] = addslashes($message);

        $data['showhi'] = 0;
        ACTION_db($data, '#_form_lienhe', 'add', NULL, NULL);

        ob_start();
        GUI_email("$admin_email", "", $tieude_lienhe, $_SERVER['SERVER_NAME'], $message, $thongtin);
        ob_end_clean();

        if (!empty($_POST['id_token'])) {
            $_SESSION['token'] = md5(RANDOM_chuoi(5));
            $return = array("err" => 1, "token" => $_SESSION['token']);
            echo json_encode($return);
        } else {
            echo 1;
        }

    } else {
        if (!empty($_POST['id_token'])) {
            $_SESSION['token'] = md5(RANDOM_chuoi(5));
            $return = array("err" => 2, "token" => $_SESSION['token']);
            echo json_encode($return);
        } else echo 2;
    }
    exit();
}

if (isset($_POST['dangky-ungtuyen'])) {


    if ((!empty($_POST['notsecuty'])) || (!empty($_POST['mabaove']) && strtolower($_POST['mabaove']) == strtolower($_SESSION['captcha']['code'])) || (!empty($_POST['id_token']) && $_POST['id_token'] == $_SESSION['token'])) {

        $admin_email = LAY_email(1);
        $htmlbox = file_get_contents("nguoiquanly/htmlbox/1m.html");
        $logo = $fullpath . "/" . $thongtin['duongdantin'] . "/" . $thongtin['logo'];
        $thongtinheader = $thongtin['tencongty_' . $lang];
        $footer = "<p><b>" . $thongtin['tencongty_' . $lang] . "</b></p>";
        $footer .= $thongtin['sodienthoai_' . $lang] != "" ? "<p>" . $glo_lang['so_dien_thoai'] . ": " . $thongtin['sodienthoai_' . $lang] . "</p>" : "";
        $footer .= $thongtin['email_' . $lang] != "" ? "<p>" . $glo_lang['email'] . ": " . $thongtin['email_' . $lang] . "</p>" : "";
        $footer .= $thongtin['diachi_' . $lang] != "" ? "<p>" . $glo_lang['dia_chi'] . ": " . $thongtin['diachi_' . $lang] . "</p>" : "";


        $s_fullname = isset($_POST['s_fullname']) ? $_POST['s_fullname'] : "";
        $s_fullname_s = isset($_POST['s_fullname_s']) ? $_POST['s_fullname_s'] : "";

        $s_dienthoai = isset($_POST['s_dienthoai']) ? $_POST['s_dienthoai'] : "";
        $s_dienthoai_s = isset($_POST['s_dienthoai_s']) ? $_POST['s_dienthoai_s'] : "";

        $s_email = isset($_POST['s_email']) ? $_POST['s_email'] : "";
        $s_email_s = isset($_POST['s_email_s']) ? $_POST['s_email_s'] : "";

        $s_address = isset($_POST['s_address']) ? $_POST['s_address'] : "";
        $s_address_s = isset($_POST['s_address_s']) ? $_POST['s_address_s'] : "";

        $s_rank = isset($_POST['s_rank']) ? $_POST['s_rank'] : "";
        $s_rank_s = isset($_POST['s_rank_s']) ? $_POST['s_rank_s'] : "";

        $tieude_lienhe = isset($_POST['tieude_lienhe']) ? base64_decode($_POST['tieude_lienhe']) : "";

        $noidung = "";
        $noidung .= RETURN_text_lienhe($s_fullname_s, $s_fullname);
        $noidung .= RETURN_text_lienhe($s_dienthoai_s, $s_dienthoai);
        $noidung .= RETURN_text_lienhe($s_email_s, $s_email);
        $noidung .= RETURN_text_lienhe($s_address_s, $s_address);
        $noidung .= RETURN_text_lienhe($s_rank_s, $s_rank);

        for ($i = 1; $i < 50; $i++) {
            if (isset($_POST['group_form_send_' . $i])) {
                $noidung .= RETURN_text_lienhe($_POST['group_form_send_' . $i . '_s'], $_POST['group_form_send_' . $i]);
            }
        }

        $message = str_replace(array("%thongtin_lienhe%", "%footer%", '%logo%', '%thongtinheader%', '%noidung%'),
            array(LOC_char($tieude_lienhe), $footer, LOC_char($logo), $thongtinheader, $noidung), $htmlbox);

        $data = array();
        $data['tenbaiviet_vi'] = LOC_char($tieude_lienhe);
        $data['ip_gui'] = GET_ip();
        $data['ngay_dang'] = time();
        $data['noi_dung_vn'] = addslashes($message);

        $data['showhi'] = 0;
        ACTION_db($data, '#_form_lienhe', 'add', NULL, NULL);

        ob_start();
        GUI_email("$admin_email", "", $tieude_lienhe, $_SERVER['SERVER_NAME'], $message, $thongtin);
        ob_end_clean();

        if (!empty($_POST['id_token'])) {
            $_SESSION['token'] = md5(RANDOM_chuoi(5));
            $return = array("err" => 1, "token" => $_SESSION['token']);
            echo json_encode($return);
        } else {
            echo 1;
        }

    } else {
        if (!empty($_POST['id_token'])) {
            $_SESSION['token'] = md5(RANDOM_chuoi(5));
            $return = array("err" => 2, "token" => $_SESSION['token']);
            echo json_encode($return);
        } else echo 2;
    }
    exit();
}


if (isset($_POST['dangky-nhantinnhan'])) {


    $admin_email = LAY_email(1);
    $htmlbox = file_get_contents("nguoiquanly/htmlbox/1m.html");
    $logo = $fullpath . "/" . $thongtin['duongdantin'] . "/" . $thongtin['logo'];
    $thongtinheader = $thongtin['tencongty_' . $lang];
    $footer = "<p><b>" . $thongtin['tencongty_' . $lang] . "</b></p>";
    $footer .= $thongtin['sodienthoai_' . $lang] != "" ? "<p>" . $glo_lang['so_dien_thoai'] . ": " . $thongtin['sodienthoai_' . $lang] . "</p>" : "";
    $footer .= $thongtin['email_' . $lang] != "" ? "<p>" . $glo_lang['email'] . ": " . $thongtin['email_' . $lang] . "</p>" : "";
    $footer .= $thongtin['diachi_' . $lang] != "" ? "<p>" . $glo_lang['dia_chi'] . ": " . $thongtin['diachi_' . $lang] . "</p>" : "";


    $s_fullname = isset($_POST['s_fullname']) ? $_POST['s_fullname'] : "";
    $s_fullname_s = isset($_POST['s_fullname_s']) ? $_POST['s_fullname_s'] : "";

    $s_dienthoai = isset($_POST['s_dienthoai']) ? $_POST['s_dienthoai'] : "";
    $s_dienthoai_s = isset($_POST['s_dienthoai_s']) ? $_POST['s_dienthoai_s'] : "";

    $s_email = isset($_POST['s_email']) ? $_POST['s_email'] : "";
    $s_email_s = isset($_POST['s_email_s']) ? $_POST['s_email_s'] : "";


    $tieude_lienhe = isset($_POST['tieude_lienhe']) ? base64_decode($_POST['tieude_lienhe']) : "";

    $noidung = "";
    $noidung .= RETURN_text_lienhe($s_fullname_s, $s_fullname);
    $noidung .= RETURN_text_lienhe($s_dienthoai_s, $s_dienthoai);
    $noidung .= RETURN_text_lienhe($s_email_s, $s_email);

    for ($i = 1; $i < 50; $i++) {
        if (isset($_POST['group_form_send_' . $i])) {
            $noidung .= RETURN_text_lienhe($_POST['group_form_send_' . $i . '_s'], $_POST['group_form_send_' . $i]);
        }
    }

    $message = str_replace(array("%thongtin_lienhe%", "%footer%", '%logo%', '%thongtinheader%', '%noidung%'),
        array(LOC_char($tieude_lienhe), $footer, LOC_char($logo), $thongtinheader, $noidung), $htmlbox);

    $data = array();
    $data['tenbaiviet_vi'] = LOC_char($tieude_lienhe);
    $data['ip_gui'] = GET_ip();
    $data['ngay_dang'] = time();
    $data['noi_dung_vn'] = addslashes($message);

    $data['showhi'] = 0;
    ACTION_db($data, '#_form_lienhe', 'add', NULL, NULL);

    ob_start();
    GUI_email("$admin_email", "", $tieude_lienhe, $_SERVER['SERVER_NAME'], $message, $thongtin);
    ob_end_clean();

    if (!empty($_POST['id_token'])) {
        $_SESSION['token'] = md5(RANDOM_chuoi(5));
        $return = array("err" => 1, "token" => $_SESSION['token']);
        echo json_encode($return);
    } else {
        echo 1;
    }


    exit();
}
$dataall = $_SESSION['datathanhpho'];
if ($motty == 'thanh-pho') {
    $arraydata = array();
    $id = $_POST['idtp'];
    $strquan = "";
    $strphuong = "";
    $dataquan = $dataall[$id]['districts'];
    $dataphuong = array_pop(array_reverse($dataquan));
    $dataphuong = $dataphuong['wards'];
    foreach ($dataquan as $k => $row) {
        $idquan = $k;
        $namequan = $row['name'];
        $strquan .= '<option value="' . $idquan . '">' . $namequan . '</option>';
    }
//    var_dump($dataphuong);
    foreach ($dataphuong as $k => $row) {
        $idphuong = $k;
        $namephuong = $row['name'];
        $strphuong .= '<option value="' . $idphuong . '">' . $namephuong . '</option>';
    }

    $arraydata['dataquan'] = $strquan;
    $arraydata['dataphuong'] = $strphuong;
    echo json_encode($arraydata);
    exit;
}
if ($motty == 'quan') {
    $arraydata = array();
    $idtp = $_POST['idtp'];
    $idquan = $_POST['idquan'];
    $dataphuong = $dataall[$idtp]['districts'][(int)$idquan];
    $dataphuong = $dataphuong['wards'];
    $strphuong = '';
    foreach ($dataphuong as $k => $row) {
        $idphuong = $k;
        $namephuong = $row['name'];
        $strphuong .= '<option value="' . $idphuong . '">' . $namephuong . '</option>';
    }
    $arraydata['dataphuong'] = $strphuong;
    echo json_encode($arraydata);
    exit;
}
if ($motty == 'addtotal') {
    if (!empty($_POST)) {
        $idbv = $_POST['idbv'];
        $databv = DB_fet("*", "#_baiviet", 'id=' . $idbv, "", "1", "arr", 1);
        $databv = reset($databv);
        $total = $databv['totaldownload'] + 1;
        $data = array();
        $data['totaldownload'] = $total;

        ACTION_db($data, '#_baiviet', 'update', NULL, "id=" . $idbv);
    }
    exit;
}
if (!empty($_POST['dangkykhoahoc'])) {
    $admin_email = LAY_email(1);
    $htmlbox = file_get_contents("nguoiquanly/htmlbox/1m.html");
    $logo = $fullpath . "/" . $thongtin['duongdantin'] . "/" . $thongtin['logo'];
    $thongtinheader = $thongtin['tencongty_' . $lang];
    $footer = "<p><b>" . $thongtin['tencongty_' . $lang] . "</b></p>";
    $footer .= $thongtin['sodienthoai_' . $lang] != "" ? "<p>" . $glo_lang['so_dien_thoai'] . ": " . $thongtin['sodienthoai_' . $lang] . "</p>" : "";
    $footer .= $thongtin['email_' . $lang] != "" ? "<p>" . $glo_lang['email'] . ": " . $thongtin['email_' . $lang] . "</p>" : "";
    $footer .= $thongtin['diachi_' . $lang] != "" ? "<p>" . $glo_lang['dia_chi'] . ": " . $thongtin['diachi_' . $lang] . "</p>" : "";


    $s_fullname = isset($_POST['s_fullname']) ? $_POST['s_fullname'] : "";
    $s_fullname_s = isset($_POST['s_fullname_s']) ? $_POST['s_fullname_s'] : "";

    $s_dienthoai = isset($_POST['s_dienthoai']) ? $_POST['s_dienthoai'] : "";
    $s_dienthoai_s = isset($_POST['s_dienthoai_s']) ? $_POST['s_dienthoai_s'] : "";

    $s_email = isset($_POST['s_email']) ? $_POST['s_email'] : "";
    $s_email_s = isset($_POST['s_email_s']) ? $_POST['s_email_s'] : "";

    $s_address = isset($_POST['s_address']) ? $_POST['s_address'] : "";
    $s_address_s = isset($_POST['s_address_s']) ? $_POST['s_address_s'] : "";

    $khoahoctemp = $_POST['s_khoahoc'];
    $datatemp = DB_fet("*",
        "#_baiviet",
        "`showhi` = 1 AND id=" . $khoahoctemp,
        "`catasort` DESC, `id` DESC",
        1,
        1,
        1);
    $datatemp = reset($datatemp);
    $url = $full_url . '/' . $datatemp['seo_name'];
    $khoahoctemp = "<a target='_blank' href='" . $url . "'>" . $datatemp['tenbaiviet_' . $lang] . "</a>";
    $s_khoahoc = isset($_POST['s_khoahoc']) ? $khoahoctemp : "";
    $s_khoahoc_s = isset($_POST['s_khoahoc_s']) ? $_POST['s_khoahoc_s'] : "";

    $tieude_lienhe = isset($_POST['tieude_lienhe']) ? base64_decode($_POST['tieude_lienhe']) : "";

    $noidung = "";
    $noidung .= RETURN_text_lienhe($s_fullname_s, $s_fullname);
    $noidung .= RETURN_text_lienhe($s_dienthoai_s, $s_dienthoai);
    $noidung .= RETURN_text_lienhe($s_email_s, $s_email);
    $noidung .= RETURN_text_lienhe($s_address_s, $s_address);
    $noidung .= '<tr><td colspan="3" style="width:160px; font-size: 13px">' . LOC_char(base64_decode($s_khoahoc_s)) . '</td><td colspan="4" width="400"><span style="display:block; padding-left:5px; font-size: 13px">' . $s_khoahoc . '</span></td></tr>';

    for ($i = 1; $i < 50; $i++) {
        if (isset($_POST['group_form_send_' . $i])) {
            $noidung .= RETURN_text_lienhe($_POST['group_form_send_' . $i . '_s'], $_POST['group_form_send_' . $i]);
        }
    }

    $message = str_replace(array("%thongtin_lienhe%", "%footer%", '%logo%', '%thongtinheader%', '%noidung%'),
        array(LOC_char($tieude_lienhe), $footer, LOC_char($logo), $thongtinheader, $noidung), $htmlbox);

    $data = array();
    $data['tenbaiviet_vi'] = LOC_char($tieude_lienhe);
    $data['ip_gui'] = GET_ip();
    $data['ngay_dang'] = time();
    $data['noi_dung_vn'] = addslashes($message);

    $data['showhi'] = 0;
    ACTION_db($data, '#_form_lienhe', 'add', NULL, NULL);

    ob_start();
    GUI_email("$admin_email", "", $tieude_lienhe, $_SERVER['SERVER_NAME'], $message, $thongtin);
    ob_end_clean();

    if (!empty($_POST['id_token'])) {
        $_SESSION['token'] = md5(RANDOM_chuoi(5));
        $return = array("err" => 1, "token" => $_SESSION['token']);
        echo json_encode($return);
    } else {
        echo 1;
    }
    exit;
}

if ($motty == 'ma-giam-gia') {
    $arr_mess = array(
        'type' => 0,
        'mess' => "Mã giảm giá không hợp lệ hoặc đã hết hạn sử dụng",
        'sotiengiam' => 0,
        'magiamgia' => "",
    );

    foreach ($_POST as $k => $v) {
        ${$k} = $v;
    }

    if (!empty($magiamgia)) {

    }

    if (!empty($totalmoney)) {
//        $totalmoney = str_replace('.', '', $totalmoney);
    }

    $arr_mess['sotien'] = 0;
    $arr_mess['totalmoney_n'] = NUMBER_fomat($totalmoney) . " " . $glo_lang['dvt'];

    $ma_giam_gia = DB_que("SELECT * FROM `#_magiamgia` WHERE `ma_giam_gia` = '" . $magiamgia . "' ORDER BY `id` ASC");
    while ($rows = mysql_fetch_assoc($ma_giam_gia)) {
        $ma_giamgia = $rows['ma_giam_gia'];
        $so_tien = $rows['so_tien'];

        $bat_dau = $rows['bat_dau'];
        $ket_thuc = $rows['ket_thuc'];
        date_default_timezone_set('Asia/Saigon');
        $date = date('d/m/Y', time());
        $date = @explode("/", $date);
        $date = @strtotime($date[2] . "-" . $date[1] . "-" . $date[0] . " " . date("23:59:59"));
        if ($bat_dau <= $date AND $ket_thuc >= $date) {
            if (count($rows['ma_giam_gia']) >= 1) {
                $arr_mess['type'] = 1;
                $arr_mess['sotien'] = NUMBER_fomat($so_tien) . " " . $glo_lang['dvt'];
                $arr_mess['sotiengiam'] = $so_tien;
                $arr_mess['totalmoney_n'] = NUMBER_fomat($totalmoney - $so_tien) . " " . $glo_lang['dvt'];
                $arr_mess['totalmoney_new'] = $totalmoney - $so_tien;
                $arr_mess['magiamgia'] = $ma_giamgia;

                if ($arr_mess['sotiengiam'] > 0 AND $arr_mess['sotiengiam'] <= 100) {
                    $arr_mess['sotien'] = NUMBER_fomat($totalmoney * $so_tien / 100) . " " . $glo_lang['dvt'];
                    $arr_mess['sotiengiam'] = $totalmoney * $so_tien / 100;
                    $arr_mess['totalmoney_n'] = NUMBER_fomat($totalmoney - ($totalmoney * $so_tien / 100))
                        . " " . $glo_lang['dvt'];
                    $arr_mess['totalmoney_new'] = $totalmoney - ($totalmoney * $so_tien / 100);
                }
                $_SESSION['ma-giam-gia'] = $arr_mess;

                if ($arr_mess['sotiengiam'] > $totalmoney) {
                    $arr_mess['type'] = 2;
                    $arr_mess['mess'] = "Số tiền giảm không được lớn hơn tổng giá trị";
                    $arr_mess['sotien'] = 0;
                    $arr_mess['sotiengiam'] = 0;
                    $arr_mess['totalmoney_n'] = NUMBER_fomat($totalmoney) . " " . $glo_lang['dvt'];
                    $arr_mess['totalmoney_new'] = $totalmoney;
                    unset($_SESSION['ma-giam-gia']);
                }
            }
        } else {
            unset($_SESSION['ma-giam-gia']);
        }
    }
    if ($arr_mess['type'] == 0) {
        unset($_SESSION['ma-giam-gia']);
    }

    echo json_encode($arr_mess);
    exit;
}

if ($motty == 'update-qty') {
    $id = $_POST['id'];
    $qty = $_POST['qty'];
    if (is_numeric(trim($qty))) {
        if ($qty == 0) {
            unset($_SESSION['cart'][$id]);
            echo "reload";
            exit();
        } else {
            $sanpham_gia = DB_que("SELECT * FROM `#_baiviet` WHERE `id` = '" . $id . "' LIMIT 1");
            if (mysql_num_rows($sanpham_gia) > 0) {
                $sanpham_gia = mysql_fetch_array($sanpham_gia);
                $_SESSION['cart'][$id] = $qty;
                $dongia = $sanpham_gia['giatien'];
                $giasp = $sanpham_gia['giatien'];
                $giakm = $sanpham_gia['giakm'];
                $optkm = $sanpham_gia['opt_km'];
                $giamgiaphantram = 0;
                if ($giakm < 100 && $giakm > 0) {
                    $giamgiaphantram = $giakm;
                }
                if ($optkm > 0 && $giakm > 0) {
                    $temp = $giasp;
                    $giasp = $giakm;
                    $giakm = $temp;
                    $dongia = $giasp;
                    if ($giamgiaphantram > 0) {
                        $dongia = $giakm - ($giakm * ($giamgiaphantram / 100));
                    }
                }
                $thanhtien = $dongia * $qty;
                $tongtien = 0;
                $tamtinh = 0;
                foreach ($_SESSION['cart'] as $key => $value) {
                    $sanpham_gia = DB_que("SELECT * FROM `#_baiviet` WHERE `id` = '" . $key . "' LIMIT 1");
                    $sanpham_gia = mysql_fetch_array($sanpham_gia);

                    $dongia = $sanpham_gia['giatien'];
                    $giasp = $sanpham_gia['giatien'];
                    $giakm = $sanpham_gia['giakm'];
                    $optkm = $sanpham_gia['opt_km'];
                    $giamgiaphantram = 0;
                    if ($giakm < 100 && $giakm > 0) {
                        $giamgiaphantram = $giakm;
                    }
                    if ($optkm > 0 && $giakm > 0) {
                        $temp = $giasp;
                        $giasp = $giakm;
                        $giakm = $temp;
                        $dongia = $giasp;
                        if ($giamgiaphantram > 0) {
                            $dongia = $giakm - ($giakm * ($giamgiaphantram / 100));
                        }
                    }
                    $tamtinh += $dongia * $_SESSION['cart'][$key];
                    if (isset($_SESSION['ma-giam-gia'])) {
                        $tongtien = $tamtinh - $_SESSION['ma-giam-gia']['sotiengiam'];
                    } else {
                        $tongtien += $dongia * $_SESSION['cart'][$key];
                    }
                }
                $return = array("thanhtien" => NUMBER_fomat($thanhtien), "tongtien" => NUMBER_fomat($tongtien)
                    . " " . $glo_lang['dvt'],
                    "tamtinh" => NUMBER_fomat($tamtinh) . " " . $glo_lang['dvt']);
                echo json_encode($return);
                exit();
            }
        }
    }
}

if ($motty == 'sp-yeu-thich') {
    $id_user = $_SESSION['sessionid'];
    if (!empty($_SESSION['id'])) {
        $id_user = $_SESSION['id'];
    }
    $arr_luotthich = array(
        'type' => 0,
        'total' => "",
    );

    foreach ($_POST as $k => $v) {
        ${$k} = $v;
    }
    $count_sp['total'] = 0;
    $_SESSION['sessionid'] = session_id();
    $count_sp = DB_que("SELECT count(*) as `total` FROM `#_sanpham_yeuthich` 
                                                        WHERE `sp_dangthich` = '" . $id_cart . "'");
    $count_sp = mysql_fetch_assoc($count_sp);
    $sp_yt = DB_fet("*",
        "#_sanpham_yeuthich",
        "sp_dangthich= $id_cart  AND id_user='$id_user'",
        "",
        "", 1, 1, 0);
    if (count($sp_yt) <= 0) {
        $arr_luotthich['type'] = 1;
        $arr_luotthich['total'] = $count_sp['total'] + 1;
        $data = array();
        $data['id_user'] = $id_user;
        $data['sp_dangthich'] = $id_cart;
        ACTION_db($data, "#_sanpham_yeuthich", 'add', NULL, NULL);
    }
    echo json_encode($arr_luotthich);
    exit;
}

if ($motty == 'showmore-sanpham') {
    $arr_xemnhieuhon = array(
        'data' => "",
        'dataoldsp' => "",
        'total' => 0,
    );

    foreach ($_POST as $k => $v) {
        ${$k} = $v;
    }
//    var_dump($dataold);

    $count = DB_que("SELECT count(*) as `total` FROM `#_baiviet` WHERE `showhi` = 1 AND `id` NOT IN  
                                    (" . $dataold . ") AND `step` = " . $step . " AND " . $wheredata . " ORDER BY `catasort` DESC, `id` DESC");
    $count = mysql_fetch_assoc($count);
    $quantity = 1;
    $array = array();
    if ($count['total'] > 0) {
        $count_sanpham = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` = 1 AND `id` NOT IN  
                        (" . $dataold . ") AND `step` = " . $step . " AND " . $wheredata . " ORDER BY `catasort` DESC, `id` DESC  LIMIT " . $limit . "");
        while ($value = mysql_fetch_assoc($count_sanpham)) {
            $id = $value['id'];
            array_push($array, $id);

            $tenbaiviet = $value['tenbaiviet_' . $lang];
            $seo_name = $full_url . '/' . $value['seo_name'];
            $image = $fullpath . '/' . $value['duongdantin'] . '/' . $value['icon'];
            $ma_sp = $value['p1'];
            $giatien = $value['giatien'];
            $optkm = $value['opt_km'];
            $giamgiaphantram = 0;
            $giakm = $value['giakm'];
            $giakhuyenmai = $value['giakm'];
            if ($giakhuyenmai > 0 && $giakhuyenmai <= 100) {
                $giamgiaphantram = $giakhuyenmai;
                $giakhuyenmai = number_format($giatien - ($giatien * ($giakhuyenmai / 100)))
                    . ' ' . $glo_lang['dvt'];
            } else if (!empty($giakhuyenmai)) {
                $giakhuyenmai = number_format($giakhuyenmai) . ' ' . $glo_lang['dvt'];
            }
            if ($giatien <= 0) {
                $giatien = $glo_lang['lien_he'];
            } else {
                $giatien = number_format($giatien) . ' ' . $glo_lang['dvt'];
            }

            $id_user = $_SESSION['sessionid'];
            if (!empty($_SESSION['id'])) {
                $id_user = $_SESSION['id'];
            }
            $_SESSION['sessionid'] = session_id();
            $sp_yt = DB_fet("*",
                "#_sanpham_yeuthich",
                "sp_dangthich= $id  AND id_user='$id_user'",
                "",
                "", 1, 1, 0);
            $count_sp = DB_que("SELECT count(*) as `total` FROM `#_sanpham_yeuthich` 
                                                            WHERE `sp_dangthich` = '" . $id . "'");
            $count_sp = mysql_fetch_assoc($count_sp);

            if (!empty($giakhuyenmai) AND $optkm == 1) {
                $giatien_km = '<span class="' . (empty($giatien) ? "hidden" : "") . '">' . $giatien . '</span>';
            }
            $arr_oldsp[] =
//                '<ul itemscope itemtype="http://schema.org/ScholarlyArticle">
//                    <li><img itemprop="image" src=" ' . $image . ' " alt=" ' . $tenbaiviet . ' " width="400" height="290"/></li>
//                    <h3 itemprop="headline" class="limit-row-2"><p> ' . $tenbaiviet . ' </p></h3>
//                    <h4 class="limit-row-2"> ' . $giatien . ' </h4>
//                </ul>';
                '<ul itemscope itemtype="http://schema.org/ScholarlyArticle">
                    <a href="'. $seo_name .'">
                        <li><img itemprop="image" src="'. $image .'" alt="'. $tenbaiviet .'" width="300" height="200"/></li>
                        <h3 class="limit-row-2" itemprop="headline"><p>'. SHOW_text($tenbaiviet) .'</p></h3>
                    </a>
                </ul>';
        }

        $dataold = explode(',', $dataold);
        $array_new = array_merge($dataold, $array);
        $dataoldsp = implode(',', $array_new);

        $arr_xemnhieuhon['dataoldsp'] = $dataoldsp;
        $arr_xemnhieuhon['total'] = count($array);
        $arr_xemnhieuhon['data'] = $arr_oldsp;

    }
    echo json_encode($arr_xemnhieuhon);
    exit;
}


if (isset($_POST['send_datban'])) {
    if (!empty($_POST['idform'])) {
        $_POST['id_token'] = $_POST['id_token' . $_POST['idform']];
        $_SESSION['token'] = $_SESSION['token' . $_POST['idform']];
    }
    if ((!empty($_POST['id_token']) && $_POST['id_token'] == $_SESSION['token'])) {
        $admin_email = LAY_email(1);
        $htmlbox = file_get_contents("nguoiquanly/htmlbox/1m.html");
        $logo = $fullpath . "/" . $thongtin['duongdantin'] . "/" . $thongtin['logo'];
        $thongtinheader = $thongtin['tencongty_' . $lang];
        $footer = "<p><b>" . $thongtin['tencongty_' . $lang] . "</b></p>";
        $footer .= $thongtin['sodienthoai_' . $lang] != "" ? "<p>" . $glo_lang['so_dien_thoai'] . ": " . $thongtin['sodienthoai_' . $lang] . "</p>" : "";
        $footer .= $thongtin['email_' . $lang] != "" ? "<p>" . $glo_lang['email'] . ": " . $thongtin['email_' . $lang] . "</p>" : "";
        $footer .= $thongtin['diachi_' . $lang] != "" ? "<p>" . $glo_lang['dia_chi'] . ": " . $thongtin['diachi_' . $lang] . "</p>" : "";

        $s_maphong = isset($_POST['s_maphong']) ? $_POST['s_maphong'] : "";
        $s_maphong_s = isset($_POST['s_maphong_s']) ? $_POST['s_maphong_s'] : "";

        if (!empty($s_maphong)) {
            $mp = DB_fet("*",
                "#_baiviet",
                "`showhi` = 1 AND `id` = " . $s_maphong,
                "catasort asc, id asc",
                "",
                1,
                1);
            $mp = reset($mp);
            $s_maphong = $mp['p1'];
        }

        $s_thongso = isset($_POST['s_thongso']) ? $_POST['s_thongso'] : "";
        $s_thongso_s = isset($_POST['s_thongso_s']) ? $_POST['s_thongso_s'] : "";

        $s_ngaydat = isset($_POST['s_ngaydat']) ? $_POST['s_ngaydat'] : "";
        $s_ngaydat_s = isset($_POST['s_ngaydat_s']) ? $_POST['s_ngaydat_s'] : "";

        $s_thoigian = isset($_POST['s_thoigian']) ? $_POST['s_thoigian'] : "";
        $s_thoigian_s = isset($_POST['s_thoigian_s']) ? $_POST['s_thoigian_s'] : "";

        $s_fullname = isset($_POST['s_fullname']) ? $_POST['s_fullname'] : "";
        $s_fullname_s = isset($_POST['s_fullname_s']) ? $_POST['s_fullname_s'] : "";

        $s_dienthoai = isset($_POST['s_dienthoai']) ? $_POST['s_dienthoai'] : "";
        $s_dienthoai_s = isset($_POST['s_dienthoai_s']) ? $_POST['s_dienthoai_s'] : "";

        $s_email = isset($_POST['s_email']) ? $_POST['s_email'] : "";
        $s_email_s = isset($_POST['s_email_s']) ? $_POST['s_email_s'] : "";

        $s_title = isset($_POST['s_title']) ? $_POST['s_title'] : "";
        $s_title_s = isset($_POST['s_title_s']) ? $_POST['s_title_s'] : "";

        $s_soluong = isset($_POST['s_soluong']) ? $_POST['s_soluong'] : "";
        $s_soluong_s = isset($_POST['s_soluong_s']) ? $_POST['s_soluong_s'] : "";

        $s_coso = isset($_POST['s_coso']) ? $_POST['s_coso'] : "";
        $s_coso_s = isset($_POST['s_coso_s']) ? $_POST['s_coso_s'] : "";

        $timestamp_ngaydat = strtotime($s_ngaydat);

        if (!empty($s_maphong)) {
            $form_datban = DB_que("SELECT count(*) as `total` FROM `#_form_datban` WHERE `ngay_dat` = '" . $timestamp_ngaydat . "'
                                                AND  `thoigian_dat` = '" . $s_thoigian . "' AND `co_so` = '" . $s_coso . "' ORDER BY `id` DESC");
            $form_datban = mysql_fetch_assoc($form_datban);
            if ($form_datban['total'] > 0) {
                if (!empty($_POST['id_token'])) {
                    $_SESSION['token'] = md5(RANDOM_chuoi(5));
                    $return = array("err" => 3, "token" => $_SESSION['token']);
                    echo json_encode($return);
                } else {
                    echo 3;
                }
                exit();
            }
        }

        $tieude_lienhe = isset($_POST['tieude_lienhe']) ? base64_decode($_POST['tieude_lienhe']) : "";

        $noidung = "";
        $noidung .= RETURN_text_lienhe($s_maphong_s, $s_maphong);
        $noidung .= RETURN_text_lienhe($s_thongso_s, $s_thongso);
        $noidung .= RETURN_text_lienhe($s_ngaydat_s, $s_ngaydat);
        $noidung .= RETURN_text_lienhe($s_thoigian_s, $s_thoigian);
        $noidung .= RETURN_text_lienhe($s_fullname_s, $s_fullname);
        $noidung .= RETURN_text_lienhe($s_dienthoai_s, $s_dienthoai);
        $noidung .= RETURN_text_lienhe($s_email_s, $s_email);
        $noidung .= RETURN_text_lienhe($s_soluong_s, $s_soluong);
        $noidung .= RETURN_text_lienhe($s_title_s, $s_title);
        $noidung .= RETURN_text_lienhe($s_coso_s, $s_coso);

        for ($i = 1; $i < 50; $i++) {
            if (isset($_POST['group_form_send_' . $i])) {
                $noidung .= RETURN_text_lienhe($_POST['group_form_send_' . $i . '_s'], $_POST['group_form_send_' . $i]);
            }
        }

        $message = str_replace(array("%thongtin_lienhe%", "%footer%", '%logo%', '%thongtinheader%', '%noidung%'),
            array(LOC_char($tieude_lienhe), $footer, LOC_char($logo), $thongtinheader, $noidung), $htmlbox);

        $data = array();
        $data['tenbaiviet_vi'] = LOC_char($tieude_lienhe);
        $data['ip_gui'] = GET_ip();
        $data['ngay_dang'] = time();
        $data['ngay_dat'] = $timestamp_ngaydat;
        $data['thoigian_dat'] = $s_thoigian;
        $data['co_so'] = $s_coso;
        $data['noi_dung_vn'] = addslashes($message);

        $data['showhi'] = 0;
        ACTION_db($data, '#_form_datban', 'add', NULL, NULL);

        ob_start();
        GUI_email("$admin_email", "", $tieude_lienhe, $_SERVER['SERVER_NAME'], $message, $thongtin);
        ob_end_clean();

        if (!empty($_POST['id_token'])) {
            $_SESSION['token'] = md5(RANDOM_chuoi(5));
            $return = array("err" => 1, "token" => $_SESSION['token']);
            echo json_encode($return);
        } else {
            echo 1;
        }

    } else {
        if (!empty($_POST['id_token'])) {
            $_SESSION['token'] = md5(RANDOM_chuoi(5));
            $return = array("err" => 2, "token" => $_SESSION['token']);
            echo json_encode($return);
        } else echo 2;
    }
    exit();
}

if (($motty == 'pa-dat-ban')) {
    $arr_datban = array(
        "data" => "",
        "data_thongso" => "",
        "data_thoigian" => "",
        "data_coso" => "",
    );

    foreach ($_POST as $k => $v) {
        ${$k} = $v;
    }

    if (isset($maphong)) {
        function tinhnangsp($id_parent, $listchild, $lang, $step)
        {
            $sanpham_tinhnang = DB_fet("*",
                "#_baiviet_tinhnang",
                "`showhi` = 1 AND `step` = $step AND id_parent = " . $id_parent,
                "catasort asc, id asc",
                "",
                1,
                1);
            $array_temp = array();
            foreach ($sanpham_tinhnang as $value) {
                array_push($array_temp, $value['id']);
            }
            $arraytempstr = array();
            $arr_a = explode(',', $listchild);//tenbaiviet
            foreach ($arr_a as $value) {
                if (empty($sanpham_tinhnang[$value]))
                    continue;
                array_push($arraytempstr, $sanpham_tinhnang[$value]['tenbaiviet_' . $lang]);
            }
            return implode(', ', $arraytempstr);
        }

        $str_thongso = "";
        $str_thoigian = "";
        $str_coso = "";
        $i = 1;

        function dataDatBan($maphong, $id, $slug_step, $delimiter, $ma_tinhnang, $lang)
        {
            $data = DB_fet("*", "#_baiviet", "`showhi` = 1 and `id` = '$maphong' and `id_parent` = '$id' 
                        and step = " . $slug_step, "catasort ASC, id ASC", "", 1, 1);
            $resetdata = reset($data);
            $detailvi = $resetdata['detail_vi'];
            $detailvi = explode($delimiter, tinhnangsp($ma_tinhnang, $detailvi, $lang, $slug_step));
            krsort($detailvi);
            return $detailvi;
        }

        $thongso = dataDatBan($maphong, $id, $slug_step, ",", 6, $lang);
        $thoigian = dataDatBan($maphong, $id, $slug_step, ",", 30, $lang);
        $coso = dataDatBan($maphong, $id, $slug_step, ".,", 12, $lang);

        $str_thongso .= '<option value="">' . $glo_lang['thong_so'] . '</option>';
        foreach ($thongso as $rows) {
            if ($rows == "")
                continue;
            $str_thongso .= '<option value="' . $rows . '">' . $rows . '</option>';
            $i++;
        }

        $str_thoigian .= '<option value="">' . $glo_lang['thoi_gian'] . '</option>';
        foreach ($thoigian as $rows) {
            if ($rows == "")
                continue;
            $str_thoigian .= '<option value="' . $rows . '">' . $rows . '</option>';
            $i++;
        }
        $str_coso .= '<option value="">' . $glo_lang['co_so'] . '</option>';
        foreach ($coso as $rows) {
            if ($rows == "")
                continue;
            $str_coso .= '<option value="' . $rows . '">' . $rows . '</option>';
            $i++;
        }

        if (!empty($ngaydat)) {
            $ngaydat = strtotime($ngaydat);
        } else {
            $ngaydat = "";
        }
        if (empty($thoigian_chon)) {
            $thoigian_chon = "";
        }
        if (empty($coso_chon)) {
            $coso_chon = "";
        }
        if (!empty($ngaydat) && ($thoigian_chon != "")) {
            $form_datban = DB_que("SELECT count(*) as `total` FROM `#_form_datban` WHERE `ngay_dat` = '" . $ngaydat . "'
                AND  `thoigian_dat` = '" . $thoigian_chon . "' AND `co_so` = '" . $coso_chon . "' ORDER BY `id` DESC");
            $form_datban = mysql_fetch_assoc($form_datban);
            if ($form_datban['total'] > 0) {
                $arr_datban['data'] = 2;
            } else {
                $arr_datban['data'] = 1;
            }
        }
    }
    $arr_datban['data_thongso'] = $str_thongso;
    $arr_datban['data_thoigian'] = $str_thoigian;
    $arr_datban['data_coso'] = $str_coso;

    echo json_encode($arr_datban);
    exit;
}
?>