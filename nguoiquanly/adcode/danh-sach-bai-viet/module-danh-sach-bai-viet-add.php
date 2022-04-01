<?php


$table = '#_baiviet';
$name_baiviet = "bài viết";
if ($id_step == 2)
    $name_baiviet = "sản phẩm";

$id = isset($_GET['edit']) && is_numeric($_GET['edit']) ? SHOW_text($_GET['edit']) : 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
        ${$key} = $value;
        if ($key == 'tenbaiviet_vi') {
            ${$key} = strip_tags($value);
        }
    }

    $catasort = str_replace(".", "", @$catasort);
    $giatien = str_replace(".", "", @$giatien);
    $giakm = str_replace(".", "", @$giakm);


    $seo_title_vi = LAY_uutien(@$seo_title_vi, @$tenbaiviet_vi);
    $seo_title_en = LAY_uutien(@$seo_title_en, @$tenbaiviet_en);
    $seo_title_cn = LAY_uutien(@$seo_title_cn, @$tenbaiviet_cn);
    $seo_description_vi = LAY_uutien(@$seo_description_vi, @$tenbaiviet_vi);
    $seo_description_en = LAY_uutien(@$seo_description_en, @$tenbaiviet_en);
    $seo_description_cn = LAY_uutien(@$seo_description_cn, @$tenbaiviet_cn);
    $seo_keywords_vi = LAY_uutien(@$seo_keywords_vi, @$tenbaiviet_vi);
    $seo_keywords_en = LAY_uutien(@$seo_keywords_en, @$tenbaiviet_en);
    $seo_keywords_cn = LAY_uutien(@$seo_keywords_cn, @$tenbaiviet_cn);

    // $opt_km             = isset($_POST["opt_km"]) ? "1" : "0";
    $showhi = isset($_POST["showhi"]) ? "1" : "0";
    // $opt                = isset($_POST["opt"]) ? "1" : "0";
    // $opt1               = isset($_POST["opt1"]) ? "1" : "0";


    $ngay = @explode("/", $ngaydang);
    $ngaykhai = @explode("/", $ngaykhaigiang);
    $capnhat = @explode("/", $capnhat);
    $gio = @date("H:i:s", time());
    $ngayluu = @strtotime($ngay[2] . "-" . $ngay[1] . "-" . $ngay[0] . " " . $gio);
    $ngayluukhai = @strtotime($ngaykhai[2] . "-" . $ngaykhai[1] . "-" . $ngaykhai[0] . " " . $gio);
    $capnhat = @strtotime($capnhat[2] . "-" . $capnhat[1] . "-" . $capnhat[0] . " " . $gio);


    $detail_vi = "";
    $detail_en = "";
    $detail_cn = "";
    if (isset($_POST['detail_vi'])) {
        foreach ($_POST['detail_vi'] as $val) {
            if ($val != "") {
                $detail_vi .= $val . ",";
            }

        }
        $detail_vi = trim($detail_vi, ",");
    }
    if (isset($_POST['detail_en'])) {
        foreach ($_POST['detail_en'] as $val) {
            if ($val != "") {
                $detail_en .= $val . ",";
            }
        }
        $detail_en = trim($detail_en, ",");
    }
    if (isset($_POST['detail_cn'])) {
        foreach ($_POST['detail_cn'] as $val) {
            if ($val != "") {
                $detail_cn .= $val . ",";
            }
        }
        $detail_cn = trim($detail_cn, ",");
    }
}
$array_typefile = array(
    'pdf',
    'jpg',
    'png',
    'docx',
    'xls',
);
if (!empty($_POST)) {

    $seo_name = LAY_uutien($seo_name, $tenbaiviet_vi);
    $hinhanh = UPLOAD_image("icon", "../" . $duongdantin . "/", time());
    $icon_hover = UPLOAD_image("icon_hover", "../" . $duongdantin . "/", time());
    $dowload = UPLOAD_file("dowload", "../datafiles/files/", time(), $array_typefile);

    $_POST['id_user'] = $_SESSION['luluwebproadmin'];
    $_POST['ngaydang'] = @$ngayluu;
    $_POST['ngaykhaigiang'] = @$ngayluukhai;
    $_POST['capnhat'] = @$capnhat;
    $_POST['showhi'] = @$showhi;
    // $_POST['opt']                   = @$opt;
    // $_POST['opt1']                  = @$opt1;

    $_POST['duongdantin'] = @$duongdantin;
    $_POST['seo_title_vi'] = @$seo_title_vi;
    $_POST['seo_title_en'] = @$seo_title_en;
    $_POST['seo_title_cn'] = @$seo_title_cn;
    $_POST['seo_description_vi'] = @$seo_description_vi;
    $_POST['seo_description_en'] = @$seo_description_en;
    $_POST['seo_description_cn'] = @$seo_description_cn;
    $_POST['seo_keywords_vi'] = @$seo_keywords_vi;
    $_POST['seo_keywords_en'] = @$seo_keywords_en;
    $_POST['seo_keywords_cn'] = @$seo_keywords_cn;


    $_POST['step'] = @$step;

    if ($dowload != false) {
        $_POST['dowload'] = @$dowload;
    }

    $_POST['giatien'] = @$giatien;
    $_POST['giakm'] = @$giakm;
//    $_POST['youtubelink'] = @$youtubelink;

    $_POST['catasort'] = @$catasort;
    $_POST['opt_km'] = @$opt_km;
    $_POST['detail_vi'] = @$detail_vi;
    $_POST['detail_en'] = @$detail_en;
    $_POST['detail_cn'] = @$detail_cn;
    if (!empty($tags_vi)) {
        $arraytempvi = explode(',', $tags_vi);
        $array_temp = array();
        foreach ($arraytempvi as $row) {
            array_push($array_temp, CONVERT_vn(mb_strtolower($row)));
        }
        $_POST['tags_seo_vi'] = implode(',', $array_temp);
    }
    if (!empty($tags_en)) {
        $arraytempen = explode(',', $tags_en);
        $array_temp = array();
        foreach ($arraytempen as $row) {
            array_push($array_temp, CONVERT_vn(mb_strtolower($row)));
        }
        $_POST['tags_seo_en'] = implode(',', $array_temp);
    }


    if ($hinhanh != false) {
        $_POST['icon'] = $hinhanh;
        if ($_REQUEST['anh_sp'] != '') {
            $anh_sp = explode("x", $_REQUEST['anh_sp']);
            $wid = $anh_sp[0];
            $hig = $anh_sp[1];
            TAO_anhthumb("../" . $duongdantin . "/" . $hinhanh, "../" . $duongdantin . "/thumb_" . $hinhanh, $wid, $hig, "images/trang_" . $wid . "_" . $hig . ".png");
        } else {
            TAO_anhthumb("../" . $duongdantin . "/" . $hinhanh, "../" . $duongdantin . "/thumb_" . $hinhanh, 500, 500);
        }
        if ($id > 0) {
            //xoa anh
            $sql_thongtin = DB_que("SELECT * FROM `$table` WHERE `id`='" . $id . "' LIMIT 1");
            @unlink("../" . mysql_result($sql_thongtin, 0, "duongdantin") . "/" . mysql_result($sql_thongtin, 0, "icon"));
            @unlink("../" . mysql_result($sql_thongtin, 0, "duongdantin") . "/thumb_" . mysql_result($sql_thongtin, 0, "icon"));
            //end
        }
    }
    if ($icon_hover != false) {
        $_POST['icon_hover'] = $icon_hover;
        if ($_REQUEST['anh_sp'] != '') {
            $anh_sp = explode("x", $_REQUEST['anh_sp']);
            $wid = $anh_sp[0];
            $hig = $anh_sp[1];
            TAO_anhthumb("../" . $duongdantin . "/" . $icon_hover, "../" . $duongdantin . "/thumb_" . $icon_hover, $wid, $hig, "images/trang_" . $wid . "_" . $hig . ".png");
        } else {
            TAO_anhthumb("../" . $duongdantin . "/" . $icon_hover, "../" . $duongdantin . "/thumb_" . $icon_hover, 500, 500, "images/trang_500_500.png");
        }

        if ($id > 0) {
            $sql_thongtin = DB_que("SELECT * FROM `$table` WHERE `id`='" . $id . "' LIMIT 1");
            @unlink("../" . mysql_result($sql_thongtin, 0, "duongdantin") . "/" . mysql_result($sql_thongtin, 0, "icon_hover"));
            @unlink("../" . mysql_result($sql_thongtin, 0, "duongdantin") . "/thumb_" . mysql_result($sql_thongtin, 0, "icon_hover"));
        }
    }

    if ($dowload != false && $id > 0) {
        $_POST['dowload'] = $dowload;
        $sql_thongtin = DB_que("SELECT * FROM `$table` WHERE `id`='" . $id . "' LIMIT 1");
        @unlink("../datafiles/files/" . mysql_result($sql_thongtin, 0, "dowload"));
    }

    if ($id == 0) {

        $_SESSION['data_baiviet_' . $step] = $_POST;
        //
        $id = ACTION_db($_POST, $table, 'add', array("themmoi", "anh_sp", "mutifile"), NULL);
        $_SESSION['show_message_on'] = "Thêm $name_baiviet thành công!";
        THEM_seoname($id, $seo_name, $table, $step, "0");
        LOCATION_js($url_page . "&step=" . @$_GET['step'] . "&id_step=" . @$id_step . "&edit=" . $id);
        exit();
    } else {

        ACTION_db($_POST, $table, 'update', array("themmoi", "anh_sp", "mutifile"), "`id` = " . $id);
        $_SESSION['show_message_on'] = "Cập nhật $name_baiviet thành công!";
        THEM_seoname($id, $seo_name, $table, $step, "1");

    }
}

if ($id > 0) {
    $sql_se = DB_que("SELECT * FROM `$table` WHERE `id`='" . $id . "' LIMIT 1");
    $sql_se = mysql_fetch_assoc($sql_se);

    foreach ($sql_se as $key => $value) {
        ${$key} = $value;
    }

    $catasort = number_format($catasort, 0, ',', '.');
    $ngaydang = date("d/m/Y", $ngaydang);
    if (!empty($ngaykhaigiang)) {
        $ngaykhaigiang = date("d/m/Y", $ngaykhaigiang);
    }

    $capnhat = date("d/m/Y", $capnhat);

    $giatien = number_format($giatien, 0, ',', '.');
    $giakm = number_format($giakm, 0, ',', '.');


    if ($icon != '') {
        $icon = "<img src='../$duongdantin/thumb_$icon' width='255' height='auto' style='display:block'>";
    }
    if ($icon_hover != '') {
        $icon_hover = "<img src='../$duongdantin/thumb_$icon_hover' width='255' height='auto' style='display:block'>";
    }
} else {
    $id_parent = 0;

    if (isset($_GET['clear'])) {
        unset($_SESSION['data_baiviet_' . $step]);
    }
    $catasort = layCatasort($table, '`step` = ' . $step);
    $catasort = number_format(SHOW_text($catasort), 0, ',', '.');

    $ngaydang = date("d/m/Y");

    $ngaykhaigiang = date("d/m/Y");


    $capnhat = date('d/m/Y');
    if ($id_step == 11) {
        $mt_10_vi = date('d/m/Y', strtotime("10 days", time()));
    }
}

$thongtin_step = DB_que("SELECT * FROM `#_step` WHERE `id` = '$step' LIMIT 1");
$thongtin_step = mysql_fetch_assoc($thongtin_step);

?>
    <!--    <input type="button" value="Dịch" id="send"/>-->
    <section class="content-header">
        <h1>Danh sách <?= $thongtin_step['tenbaiviet_vi'] ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?= $fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="active">Danh sách <?= $thongtin_step['tenbaiviet_vi'] ?></li>
        </ol>
    </section>
    <form id="form_submit" name="form_submit" action="" method="post" enctype='multipart/form-data'>
        <section class="content form_create">
            <div class="row">
                <section class="col-lg-12">
                    <?php include _source . "mesages.php"; ?>
                    <div class="box">
                        <div class="box-header with-border">
                            <h2 class="h2_title">
                                <i class="fa fa-pencil-square-o"></i><?= GETNAME_step($step) ?>
                                > <?= $id > 0 ? 'Cập nhật' : 'Thêm' ?> <?= $thongtin_step['tenbaiviet_vi'] ?>
                            </h2>
                            <h3 class="box-title box-title-td pull-right">
                                <button onclick="return checkSubmit();" type="submit" class="btn btn-primary"><i
                                            class="fa fa-floppy-o"></i> <?= luu_lai ?></button>
                                <a href="<?= $url_page ?>&them-moi=true&step=<?= @$_GET['step'] ?>&id_step=<?= @$_GET['id_step'] ?>"
                                   class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                                <a href="<?= $url_page ?>&step=<?= @$_GET['step'] ?>&id_step=<?= @$_GET['id_step'] ?>"
                                   class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
                            </h3>
                        </div>
                        <?php
                        //                        echo $id_step;
                        if (is_file("step/" . $id_step . ".php")) include("step/" . $id_step . ".php"); ?>
                    </div>
                </section>
            </div>
        </section>

        <div class="box-header mb-60">
            <h3 class="box-title box-title-td pull-right">
                <button onclick="return checkSubmit()" type="submit" class="btn btn-primary"><i
                            class="fa fa-floppy-o"></i> <?= luu_lai ?></button>
                <a href="<?= $url_page ?>&them-moi=true&step=<?= @$_GET['step'] ?>&id_step=<?= @$_GET['id_step'] ?>"
                   class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                <a href="<?= $url_page ?>&step=<?= @$_GET['step'] ?>&id_step=<?= @$_GET['id_step'] ?>"
                   class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
            </h3>
        </div>
    </form>

    <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
        function checkSubmit() {
            if ($("#tenbaiviet_vi").val().trim() == '') {
                alert("Vui lòng nhập tiêu đề");
                $("#tenbaiviet_vi").focus();
                return false;
            }
            if ($(".cls_giatien_f").length > 0 && $(".cls_giatien_f").val() < 0) {
                alert("Giá bán không được phép âm. Vui lòng kiểm tra lại!");
                $(".cls_giatien_f").focus();
                return false;
            }
            if ($(".cls_giatien_khuyenmai_f").length > 0 && $(".cls_giatien_khuyenmai_f").val() != 0) {
                var gia_ban = parseInt($(".cls_giatien_f").val().replace(/\./g, ""));
                var gia_km = parseInt($(".cls_giatien_khuyenmai_f").val().replace(/\./g, ""));

                if (gia_km > gia_ban) {
                    alert("Giá khuyến mãi không được lớn hơn giá bán. Vui lòng kiểm tra lại!");
                    $(".cls_giatien_khuyenmai_f").focus();
                    return false;
                }

            }
            if ($(".time_js_date_1").length > 0 && $(".time_js_date_2").length > 0) {
                var time_1 = $(".time_js_date_1").val();
                var time_2 = $(".time_js_date_2").val();
                time_1 = time_1.split("/");
                time_2 = time_2.split("/");
                time_1 = new Date(time_1[2], time_1[1] - 1, time_1[0], 23, 59, 0).getTime() / 1000;
                time_2 = new Date(time_2[2], time_2[1] - 1, time_2[0], 23, 59, 0).getTime() / 1000;
                if (time_1 > time_2) {
                    alert("Ngày khởi hành không được lớn hơn ngày kết thúc!");
                    $(".time_js_date_1").focus();
                    return false;
                }
            }


            // document.getElementById("form_submit").submit();
        }

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy'
        });
        $('#datepicker2').datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy'
        });

        $('#send').click(function () {
            var value = CKEDITOR.instances['noidung_vi'].getData();
            $.post("dich-text", {name: "John", time: "2pm"})
                .done(function (data) {
                    alert("Data Loaded: " + data);
                });
        });
    </script>
<?php $ckeditor->replace('mota_vi'); ?>
<?php if ($_GET['id_step'] != 13) {
    $ckeditor->replace('noidung_vi');
} ?>
<?php if ($lang_nb2 && $_GET['id_step'] != 13) {
    $ckeditor->replace('mota_en');
    $ckeditor->replace('noidung_en');
} ?>
<?php if ($lang_nb3 && $_GET['id_step'] != 13) {
    $ckeditor->replace('mota_cn');
    $ckeditor->replace('noidung_cn');
} ?>