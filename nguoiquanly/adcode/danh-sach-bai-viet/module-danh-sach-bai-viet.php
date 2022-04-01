<?php
if (isset($_GET['upload']) && (isset($_GET['edit']) && is_numeric($_GET['edit']))) {
    include "module-danh-sach-bai-viet-upload.php";
} else if (isset($_GET['tinh-nang']) && (isset($_GET['edit']) && is_numeric($_GET['edit']))) {
    include "module-danh-sach-bai-viet-tinh-nang.php";
} else if (isset($_GET['them-moi']) || (isset($_GET['edit']) && is_numeric($_GET['edit']))) {
    include "module-danh-sach-bai-viet-add.php";
} else {
    $table = '#_baiviet';
    $table_slug = str_replace("#_", "", $table);
    if ($id_step == 2)
        $n_bviet = "sản phẩm";
    else
        $n_bviet = "bài viết";

    if (isset($_GET['del'])) {
        $sql_se = DB_que("SELECT * FROM `$table` WHERE `id`='" . $_GET['catalogid'] . "' LIMIT 1");

        if (mysql_num_rows($sql_se) > 0) {
            $icon = @mysql_result($sql_se, 0, 'icon');
            $dowload = @mysql_result($sql_se, 0, 'dowload');
            $icon_new = @mysql_result($sql_se, 0, 'icon_new');
            $duongdantin = @mysql_result($sql_se, 0, 'duongdantin');
            $del_name = @mysql_result($sql_se, 0, 'tenbaiviet_vi');
            @unlink("../" . $duongdantin . "/" . $icon);
            @unlink("../" . $duongdantin . "/thumb_" . $icon);
            @unlink("../datafiles/files/" . $dowload);

            DB_que("DELETE FROM `#_slug` WHERE `id_bang`='" . $_GET['catalogid'] . "' AND `bang` = '$table_slug'");
            DB_que("DELETE FROM $table WHERE `id` = '" . $_GET['catalogid'] . "' LIMIT 1");
            // Xóa ảnh con
            $sql_img = DB_que("SELECT * FROM `#_baiviet_img` WHERE `id_parent` ='" . $_GET['catalogid'] . "'");
            if (mysql_num_rows($sql_img) > 0) {
                while ($row = mysql_fetch_assoc($sql_img)) {
                    $p_name = $row['p_name'];
                    $path_img = $row['duongdantin'];
                    @unlink("../datafiles/" . $path_img . "/" . $p_name);
                    @unlink("../datafiles/" . $path_img . "/thumb_" . $p_name);
                }
                DB_que("DELETE FROM `#_baiviet_img` WHERE `id_parent` = '" . $_GET['catalogid'] . "'");;
            }
            // End xóa ảnh con
            $_SESSION['show_message_on'] = 'Xóa ' . $n_bviet . ' [<strong>' . $del_name . '</strong>] thành công!';

        } else $_SESSION['show_message_off'] = 'Dữ liệu không hợp lệ!';
        LOCATION_js($url_page . "&step=" . @$step . "&id_step=" . @$id_step);
        exit();
    }
    if (isset($_REQUEST['xuat_file_excel'])) {
        include "export_excel_baiviet.php";
    }
    if (isset($_REQUEST['addgiatri']) AND isset($_REQUEST['maxvalu'])) {
        for ($i = 0; $i < $_REQUEST['maxvalu']; $i++) {

            $idofme = $_POST["idme$i"];
            $sort = str_replace(".", "", $_POST["sortby$i"]);
            $ncata_vi = isset($_POST["ncata_vi$i"]) ? $_POST["ncata_vi$i"] : "";
            $ncata_en = isset($_POST["ncata_en$i"]) ? $_POST["ncata_en$i"] : "";
            $ncata_cn = isset($_POST["ncata_cn$i"]) ? $_POST["ncata_cn$i"] : "";

            $opx = isset($_POST["opt_$i"]) ? "1" : "0";
            $opxx = isset($_POST["opxx$i"]) ? "1" : "0";
            $opt2 = isset($_POST["opx_2_$i"]) ? "1" : "0";
            $showhi = isset($_POST["showhi_$i"]) ? "1" : "0";
            $data = array();

            $data['tenbaiviet_vi'] = $ncata_vi;
            $data['tenbaiviet_en'] = $ncata_en;
            $data['tenbaiviet_cn'] = $ncata_cn;
            $data['catasort'] = $sort;
            $data['opt'] = $opx;
            $data['opt1'] = $opxx;
            $data['opt2'] = $opt2;
            $data['showhi'] = $showhi;

            if (isset($_SESSION['admin']) && isset($_POST["id_parent$i"])) {
                $data['id_parent'] = $_POST["id_parent$i"];
            }
            if (isset($_POST["coppy_row$i"])) {
//                echo 1245;
                COPPY_row($table, $idofme, $step);
            }

            if (isset($_POST["xoa_gr_arr_$i"])) {
                //xoa
                $sql_se = DB_que("SELECT * FROM `$table` WHERE `id`='" . $idofme . "' LIMIT 1");
                if (mysql_num_rows($sql_se) > 0) {
                    $icon = @mysql_result($sql_se, 0, 'icon');
                    $dowload = @mysql_result($sql_se, 0, 'dowload');
                    $icon_new = @mysql_result($sql_se, 0, 'icon_new');
                    $duongdantin = @mysql_result($sql_se, 0, 'duongdantin');
                    $del_name = @mysql_result($sql_se, 0, 'tenbaiviet_vi');
                    @unlink("../" . $duongdantin . "/" . $icon);
                    @unlink("../" . $duongdantin . "/thumb_" . $icon);
                    @unlink("../datafiles/files/" . $dowload);

                    DB_que("DELETE FROM `#_slug` WHERE `id_bang`='" . $idofme . "' AND `bang` = '$table_slug'");
                    DB_que("DELETE FROM $table WHERE `id` = '" . $idofme . "' LIMIT 1");
                    // Xóa ảnh con
                    $sql_img = DB_que("SELECT * FROM `#_baiviet_img` WHERE `id_parent` ='" . $idofme . "'");
                    if (mysql_num_rows($sql_img) > 0) {
                        while ($row = mysql_fetch_assoc($sql_img)) {
                            $p_name = $row['p_name'];
                            $path_img = $row['duongdantin'];
                            @unlink("../datafiles/" . $path_img . "/" . $p_name);
                            @unlink("../datafiles/" . $path_img . "/thumb_" . $p_name);
                        }
                        DB_que("DELETE FROM `#_baiviet_img` WHERE `id_parent` = '" . $idofme . "'");;
                    }
                }
                //
            } else {
                $hinhanh = UPLOAD_image("upload_$i", "../" . $duongdantin . "/", time());
                if ($hinhanh != false) {
                    $data['icon'] = $hinhanh;
                    if ($_POST['anh_sp_' . $i] != '') {
                        $anh_sp = explode("x", $_POST['anh_sp_' . $i]);
                        $wid = $anh_sp[0];
                        $hig = $anh_sp[1];
                        TAO_anhthumb("../" . $duongdantin . "/" . $hinhanh, "../" . $duongdantin . "/thumb_" . $hinhanh, $wid, $hig, "images/trang_" . $wid . "_" . $hig . ".png");
                    } else {
                        TAO_anhthumb("../" . $duongdantin . "/" . $hinhanh, "../" . $duongdantin . "/thumb_" . $hinhanh, 500, 500);
                    }

                    $sql_thongtin = DB_que("SELECT * FROM `$table` WHERE `id`='" . $idofme . "' LIMIT 1");
                    @unlink("../" . mysql_result($sql_thongtin, 0, "duongdantin") . "/" . mysql_result($sql_thongtin, 0, "icon"));
                    @unlink("../" . mysql_result($sql_thongtin, 0, "duongdantin") . "/thumb_" . mysql_result($sql_thongtin, 0, "icon"));
                }
                //end
                ACTION_db($data, $table, 'update', NULL, "`id` = '$idofme' ");
            }
        }
        $_SESSION['show_message_on'] = 'Cập nhật dữ liệu thành công!';
    }
    $mo = '';
    $uri = '';
    $numview = 50;

    $s_chude = isset($_GET['chu-de']) && is_numeric($_GET['chu-de']) ? $_GET['chu-de'] : 0;
    $s_trangthai = isset($_GET['trang-thai']) && is_numeric($_GET['trang-thai']) ? $_GET['trang-thai'] : 0;
    $s_ksearch = isset($_GET['ksearch']) ? strip_tags(str_replace("+", " ", $_GET['ksearch'])) : "";
    $s_hienthi = isset($_GET['hien-thi']) && is_numeric($_GET['hien-thi']) ? $_GET['hien-thi'] : 0;

    if ($s_hienthi == 1) $numview = 15;
    else if ($s_hienthi == 2) $numview = 30;
    else if ($s_hienthi == 3) $numview = 60;
    else if ($s_hienthi == 4) $numview = 100;
    else if ($s_hienthi == 5) $numview = 200;

    $pz = 0;
    $pzz = 0;

    if (isset($_GET['pz'])) {
        $pz = $_GET['pz'];
        if ($pz == "" || $pz == 0) $pzz = 0;
        else $pzz = $pz * $numview;
    }

    if ($s_trangthai != 0) {
        $sta = $s_trangthai == 1 ? 1 : 0;
        $mo .= ' AND `showhi`=' . $sta . ' ';
        $uri .= '&trang-thai=' . $s_trangthai;
    }

    if ($s_ksearch != "") {
        $mo .= " AND (`tenbaiviet_vi` LIKE '%" . $s_ksearch . "%' OR `tenbaiviet_en` LIKE '%" . $s_ksearch . "%')";
        $uri .= '&ksearch=' . str_replace(" ", "+", $s_ksearch);
    }

    if ($s_chude != 0) {
        if ($id_step == 11) { //du lich
            // $lay_all_kietxuat = LAYDANHSACH_idkietxuat($s_chude, $step);
            $mo .= ' AND FIND_IN_SET( ' . $s_chude . ', `detail_en`) <> 0 ';
        } else {
            $lay_all_kietxuat = LAYDANHSACH_idkietxuat($s_chude, $step);
            $mo .= ' AND `id_parent` in (' . $lay_all_kietxuat . ')';
        }

        $uri .= '&chu-de=' . $s_chude;
    }

    $sql = DB_que("SELECT * FROM `$table` WHERE (`step`='" . $step . "' OR FIND_IN_SET(" . $step . ", `detail_cn`) > 0 ) $mo ORDER BY `catasort` DESC LIMIT $pzz,$numview");
    $sql_num = DB_que("SELECT * FROM `$table` WHERE (`step`='" . $step . "' OR FIND_IN_SET(" . $step . ", `detail_cn`) > 0 ) $mo");

    $numlist = @mysql_num_rows($sql_num);
    $numshow = ceil($numlist / $numview);

    $thongtin_step = DB_que("SELECT * FROM `#_step` WHERE `id` = '$step' LIMIT 1");
    $thongtin_step = mysql_fetch_assoc($thongtin_step);

    $list_danhmuc = DB_fet("*", "#_danhmuc", "", "`id` DESC", "", "arr", 1);
    $list_bv_img = DB_fet("*", "#_baiviet_img", '', '`id` ASC', '', 'arr');
    ?>
    <section class="content-header">
        <h1><?= GETNAME_step($step) ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?= $fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="active">Quản lý <?= GETNAME_step($step) ?></li>
        </ol>
    </section>
    <form action="" method="post" enctype='multipart/form-data'>
        <input type="hidden" name="token" value="<?= GET_token() ?>">
        <section class="content">
            <div class="row">
                <section class="col-lg-12">
                    <?php include _source . "mesages.php"; ?>
                    <div class="box">
                        <div class="box-header" style='padding-bottom: 0'>
                            <h3 class="box-title box-title-td pull-right">

                                <button type="submit" name="addgiatri" class="btn btn-primary"
                                        onclick="return CHECK_name_emty()"><i class="fa fa-floppy-o"></i> <?= luu_lai ?>
                                </button>
                                <a href="<?= $url_page ?>&them-moi=true&step=<?= $step ?>&id_step=<?= $id_step ?>"
                                   class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                            </h3>
                            <div class="box-tools">
                                <?php include _source . "search_baiviet.php" ?>
                            </div>
                        </div>
                        <?php if (is_file("step/" . $id_step . "a.php")) include("step/" . $id_step . "a.php"); ?>
                        <div class="box-header">
                            <div class="paging_simple_numbers">
                                <ul class="pagination">
                                    <?php
                                    $url_search = "?" . http_build_query($_GET);
                                    PHANTRANG_admin($numshow, $url_search, $pz, $uri);
                                    ?>
                                </ul>
                            </div>
                            <h3 class="box-title box-title-td pull-right">
                                <button type="submit" name="addgiatri" class="btn btn-primary"
                                        onclick="return CHECK_name_emty()"><i class="fa fa-floppy-o"></i> <?= luu_lai ?>
                                </button>
                                <a href="<?= $url_page ?>&them-moi=true&step=<?= $step ?>&id_step=<?= $id_step ?>"
                                   class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                            </h3>
                        </div>
                        <!--  -->
                    </div>
                </section>
            </div>
        </section>
    </form>
<?php } ?>