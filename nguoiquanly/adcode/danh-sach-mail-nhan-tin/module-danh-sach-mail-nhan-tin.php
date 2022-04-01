<?php
$table = '#_email_follow';
if (isset($_GET['del'])) {
    $sql_se = DB_que("SELECT * FROM `$table` WHERE `id`='" . $_GET['catalogid'] . "' LIMIT 1");
    $del_name = @mysql_result($sql_se, 0, 'email');
    DB_que("DELETE from $table WHERE id='" . $_GET['catalogid'] . "' limit 1");
    $_SESSION['show_message_on'] = 'Đã xóa [<strong>' . $del_name . '</strong>] thành công!';
    LOCATION_js($url_page);
    exit();
}

if (isset($_REQUEST['addgiatri']) AND isset($_REQUEST['maxvalu'])) {
    for ($i = 0; $i < $_REQUEST['maxvalu']; $i++) {
//        $idofme = $_POST["idme$i"];
//        $tenbv_vi = $_POST["ncata_vi$i"];
//        $v_name = $_POST["v_name$i"];
        $idofme = isset($_POST["idme$i"]) ? $_POST["idme$i"] : "";
        $tenbv_vi = isset($_POST["ncata_vi$i"]) ? $_POST["ncata_vi$i"] : "";
        $v_name = isset($_POST["v_name$i"]) ? $_POST["v_name$i"] : "";


        $showhi = isset($_POST["showhi_$i"]) ? "1" : "0";
        if (isset($_POST["xoa_gr_arr_$i"])) {
            DB_que("DELETE FROM $table WHERE id='" . $idofme . "' LIMIT 1");
        } else {
            DB_que("UPDATE `$table` SET `email`='$tenbv_vi', `v_name`='$v_name',`showhi`='$showhi' WHERE `id`='$idofme' LIMIT 1");
        }

    }
    $_SESSION['show_message_on'] = 'Cập nhật dữ liệu thành công!';
}
include _source . '/header_bar.php';
?>


<form action="" method="post">
    <input type="hidden" name="token" value="<?= GET_token() ?>">
    <section class="content">
        <div class="row">
            <section class="col-lg-12">
                <?php include _source . "mesages.php"; ?>
                <div class="box">
                    <div class="box-header">
                        <h2 class="h2_title">
                            <i class="fa fa-pencil-square-o"></i> Danh sách
                        </h2>
                        <h3 class="box-title box-title-td pull-right">
                            <button type="submit" name="addgiatri" class="btn btn-primary"
                                    onclick="return CHECK_delimg()"><i class="fa fa-floppy-o"></i> <?= luu_lai ?>
                            </button>
                        </h3>
                        <div class="box-tools">
                            <?php
                            $ksearch = isset($_GET['ksearch']) ? str_replace("+", " ", $_GET['ksearch']) : '';
                            ?>
                            <div class="input-group input-group-sm input-group-sm-timkiem">
                                <input name="ksearch" type="text" value="<?= $ksearch ?>"
                                       class="form-control pull-right key_search" placeholder="Nhập từ khóa tìm kiếm">
                                <div class="input-group-btn">
                                    <button name="search" type="button" class="btn btn-default btn_search_ds"
                                            onclick="SEARCH_jsstep()"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                            <?php
                            $mt_11_vi = isset($_GET['hien-thi']) ? $_GET['hien-thi'] : "";
                            $trangthai = isset($_GET['trang-thai']) ? $_GET['trang-thai'] : "";
                            ?>
                            <div class="dv-hd-locsds">
                                <div class="form-group">
                                    <select name="docid" class="js_trangthai_js form-control"
                                            onchange="SEARCH_jsstep()">
                                        <option selected="selected" value="0">Trạng thái</option>
                                        <option value="1" <?= LAY_selected(1, @$trangthai) ?>>Hiện</option>
                                        <option value="2" <?= LAY_selected(2, @$trangthai) ?>>Ẩn</option>
                                    </select>
                                </div>
                            </div>
                            <script type="text/javascript">
                                function SEARCH_jsstep() {
                                    var url = "";
                                    if ($(".key_search").length > 0) {
                                        var key_search = $(".key_search").val().trim().replace(/ /g, "+");
                                        if (key_search != "") url += "&ksearch=" + key_search;
                                    }
                                    if ($(".js_trangthai_js").length > 0) {
                                        var js_trangthai_js = $(".js_trangthai_js").val().trim();
                                        if (js_trangthai_js != 0) url += "&trang-thai=" + js_trangthai_js;
                                    }
                                    if ($(".js_hienthi_ds").length > 0) {
                                        var js_hienthi_ds = $(".js_hienthi_ds").val().trim();
                                        if (js_hienthi_ds != 0) url += "&hien-thi=" + js_hienthi_ds;
                                    }
                                    window.location.href = "?module=quan-ly-website&action=danh-sach-mail-nhan-tin" + url;
                                }
                            </script>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding table-danhsach-cont">
                        <table class="table table-hover table-danhsach">
                            <tbody>
                            <tr>
                                <th class="w50 text-center">
                                    <label>
                                        <input type='checkbox' class='minimal cls_showxoa_all'> Xóa
                                    </label>
                                </th>
                                <th class="w80 text-center">STT</th>
                                <th>Email</th>
                                <th class="w100 text-center">Hiển thị</th>
                                <th class="w100 text-center">Tác vụ</th>
                            </tr>
                            <?php
                            $whe = "";
                            if ($mt_11_vi != "") $whe .= "WHERE `cong_ty` = '$mt_11_vi'";
                            if ($trangthai == 1) $whe .= "WHERE `showhi` = 1";
                            else if ($trangthai == 2) $whe .= "WHERE `showhi` = 0";
                            else if ($trangthai == "") $whe .= "";
                            if ($ksearch != '') {
                                $whe .= "WHERE (`email` LIKE '%" . $ksearch . "%' OR `v_name` LIKE '%" . $ksearch . "%') ";
                            }
                            $numview = 20;

                            $pz = 0;
                            $pzz = 0;
                            $uri = "";
                            if (isset($_GET['pz'])) {
                                $pz = $_GET['pz'];
                                if ($pz == "" || $pz == 0) $pzz = 0;
                                else $pzz = $pz * $numview;
                            }
                            if ($mt_11_vi != "") {
                                $uri .= '&hien-thi=' . $mt_11_vi;
                            }

                            if ($ksearch != "") {
                                $uri .= '&ksearch=' . str_replace(" ", "+", $ksearch);
                            }

                            if ($trangthai != "") {
                                $uri .= '&trang-thai=' . $trangthai;
                            }

                            $sql = DB_que("SELECT * FROM `$table`  $whe ORDER BY `id` DESC LIMIT $pzz,$numview");
                            $sql_num = DB_que("SELECT * FROM `$table` $whe");
                            $numlist = @mysql_num_rows($sql_num);
                            $numshow = ceil($numlist / $numview);

                            $cl = 0;
                            $i = $pzz;
                            while ($rows = mysql_fetch_assoc($sql)) {
                                $i++;
                                $ida = $rows['id'];
                                $email = SHOW_text($rows['email']);
                                $v_name = SHOW_text($rows['v_name']);

                                $showhi = SHOW_text($rows['showhi']);
                                ?>
                                <tr>
                                    <td class="text-center">
                                        <input name="idme<?= $cl ?>" value="<?= $ida ?>" type="hidden">
                                        <input name='xoa_gr_arr_<?= $cl ?>' type='checkbox' class='minimal cls_showxoa'>
                                    </td>
                                    <td class="text-center">
                                        <input name="idme<?= $cl ?>" value="<?= $ida ?>" type="hidden">
                                        <?= $cl + 1 ?>
                                    </td>
                                    <td>
                                        <?php if (CHECK_key_setting("email-nhan-tin-name")) { ?>
                                            <div class="name">
                                                <input type="text" name="v_name<?= $cl ?>" value="<?= $v_name ?>">
                                            </div>
                                        <?php } ?>
                                        <div class="name">
                                            <input type="text" name="ncata_vi<?= $cl ?>" value="<?= $email ?>">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div id="cus" class="cus_menu">
                                            <label><input type="checkbox" name="showhi_<?= $cl ?>"
                                                          value="1" <?= (($showhi == 1) ? "checked='checked'" : "") ?>
                                                          class="minimal"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= $url_page . '&del=ok&catalogid=' . $ida . "&token=" . GET_token() ?>"
                                           class="do" title="Xóa" onclick="return confirm('Bạn thật sự muốn xóa?')"><i
                                                    class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                                <?php
                                $cl++;
                            }
                            ?>
                            </tbody>
                        </table>
                        <input type='hidden' value='<?= $cl ?>' name='maxvalu'>
                    </div>
                    <div class="box-header">
                        <div class="paging_simple_numbers">
                            <ul class="pagination">
                                <?php
                                PHANTRANG_admin($numshow, $url_page, $pz, $uri);
                                ?>
                            </ul>
                        </div>
                        <input type='hidden' value='<?= $cl ?>' name='maxvalu'>
                        <h3 class="box-title box-title-td pull-right">
                            <button type="submit" name="addgiatri" class="btn btn-primary"
                                    onclick="return CHECK_delimg()"><i class="fa fa-floppy-o"></i> <?= luu_lai ?>
                            </button>
                        </h3>
                    </div>
                </div>
            </section>
        </div>
    </section>
</form>