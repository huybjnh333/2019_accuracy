<?php
$table = '#_binhluan';
$table_slug = str_replace("#_", "", $table);
if (isset($_GET['del'])) {
    $sql_se = DB_que("SELECT * FROM `$table` WHERE `id`='" . $_GET['catalogid'] . "' LIMIT 1");

    if (mysql_num_rows($sql_se) > 0) {
        DB_que("DELETE FROM $table WHERE `id` ='" . $_GET['catalogid'] . "' LIMIT 1");
//        DB_que("DELETE from $table WHERE `id_parent`  = '" . $row_1['id'] . "' LIMIT 1");
        //xoa pr child
        $_SESSION['show_message_on'] = 'Xóa bình luận thành công';
    } else $_SESSION['show_message_off'] = 'Dữ liệu không hợp lệ!';
    LOCATION_js($url_page);
    exit();
}

if (isset($_REQUEST['addgiatri']) AND isset($_REQUEST['maxvalu'])) {
    for ($i = 1; $i <= $_REQUEST['maxvalu']; $i++) {
        $idofme = $_POST["idme$i"];
        $showhi = isset($_POST["showhi_$i"]) ? "1" : "0";

        if (isset($_POST["xoa_gr_arr_$i"])) {
            //xoa
            DB_que("DELETE FROM $table WHERE `id` ='" . $idofme . "' LIMIT 1");
            DB_que("DELETE FROM $table WHERE `id_parent` ='" . $idofme . "' LIMIT 1");
            //
        } else {
            DB_que("UPDATE `$table` SET `showhi`='$showhi'  WHERE `id`='$idofme' LIMIT 1");
        }
    }
    $_SESSION['show_message_on'] = 'Cập nhật dữ liệu thành công!';
}


$sql = DB_que("SELECT * FROM `$table`  ORDER BY `id` DESC ");
$sql_array = array();
while ($r = mysql_fetch_assoc($sql)) {
    $sql_array[] = $r;
}
$list_bv_img = DB_fet("*", "#_danhmuc_img", '', '`id` ASC', '', 'arr');
?>
<section class="content-header">
    <h1> Quản lý bình luận</h1>
    <ol class="breadcrumb">
        <li><a href="<?= $fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Quản lý bình luận</li>
    </ol>
</section>

<form action="" method="post">
    <section class="content">
        <div class="row">
            <section class="col-lg-12">
                <?php include _source . "mesages.php"; ?>
                <div class="box">
                    <div class="box-header">
                        <h2 class="h2_title">
                            <i class="fa fa-pencil-square-o"></i> Quản lý bình luận
                        </h2>
                        <h3 class="box-title box-title-td pull-right">
                            <button type="submit" name="addgiatri" class="btn btn-primary"
                                    onclick="return CHECK_name_emty()"><i class="fa fa-floppy-o"></i> <?= luu_lai ?>
                            </button>
                            <a href="<?= $url_page ?>&them-moi=true&step=<?= $step ?>&id_step=<?= $id_step ?>"
                               class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                        </h3>
                    </div>
                    <style>
                        .hide_url {
                            display: none
                        }

                        .table-danhsach tr:hover .hide_url {
                            display: block
                        }
                    </style>
                    <div class="box-body table-responsive no-padding table-danhsach-cont">
                        <table class="table table-hover table-danhsach">
                            <tbody>
                            <tr>
                                <th class="w50 text-center">
                                    <label>
                                        <input type='checkbox' class='minimal cls_showxoa_all'> Xóa
                                        <input type="hidden" name="token" value="<?= GET_token() ?>">
                                    </label>
                                </th>
                                <th class="w80 text-center">STT</th>
                                <th>Tiêu đề</th>
                                <th>Họ tên</th>
                                <th>Số điện thoại</th>
                                <th class="w100 text-center">Hiển thị</th>
                                <th class="w120 text-center">Tác vụ</th>
                            </tr>
                            <?php
                            $cl = 0;
                            $token = GET_token();
                            foreach ($sql_array as $rows) {
                                if ($rows['id_parent'] != 0) continue;
                                $cl++;

                                $ida = SHOW_text($rows['id']);
                                $tenbaiviet_vi = SHOW_text($rows['tenbaiviet_vi']);
                                $noidung_vi = SHOW_text($rows['noidung_vi']);
                                $showhi = SHOW_text($rows['showhi']);
                                $hoten = SHOW_text($rows['hoten']);
                                $sodienthoai = SHOW_text($rows['sodienthoai']);

                                $sanpham = DB_que("SELECT * FROM `#_baiviet` WHERE `id` = '" . $rows['id_sp'] . "' LIMIT 1");
                                $sanpham = mysql_fetch_assoc($sanpham);
                                ?>
                                <tr>
                                    <td class="text-center">
                                        <input name='xoa_gr_arr_<?= $cl ?>' type='checkbox' class='minimal cls_showxoa'>
                                    </td>
                                    <td class="text-center">
                                        <input name="idme<?= $cl ?>" value="<?= $ida ?>" type="hidden">
                                        <?= $cl ?>
                                    </td>

                                    <td>
                                        <div><b><?= $tenbaiviet_vi ?></b></div>
                                        <div><a style="font-size: 12px; display: block;"
                                                href="../<?= $sanpham['seo_name'] ?>/"
                                                target="_blank"><?= $sanpham['tenbaiviet_vi'] ?></a></div>
                                        <div class="hide_url"><?= $noidung_vi ?></div>
                                    </td>
                                    <td>
                                        <div><b><?= $hoten ?></b></div>
                                    </td>
                                    <td>
                                        <div><b><?= $sodienthoai ?></b></div>
                                    </td>
                                    <td class="text-center">
                                        <div id="cus" class="cus_menu">
                                            <label><input type="checkbox" class='minimal' name="showhi_<?= $cl ?>"
                                                          value="1" <?= (($showhi == 1) ? "checked='checked'" : "") ?> ></label>
                                        </div>
                                    </td>
                                    <td class="text-center">

                                        <a href="<?= $url_page . '&del=ok&catalogid=' . $ida . '&token=' . $token ?>&step=<?= $step ?>&id_step=<?= $id_step ?>"
                                           class="do" title="Xóa" onclick="return confirm('Bạn thật sự muốn xóa?')"><i
                                                    class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                                <!-- c1 -->
                                <?php
                                foreach ($sql_array as $rows_1) {
                                    if ($rows_1['id_parent'] != $rows['id']) continue;
                                    $cl++;
                                    $ida_1 = SHOW_text($rows_1['id']);
                                    $tenbaiviet_vi_1 = SHOW_text($rows_1['tenbaiviet_vi']);
                                    $noidung_vi_1 = SHOW_text($rows_1['noidung_vi']);
                                    $showhi_1 = SHOW_text($rows_1['showhi']);
                                    $hoten_1 = SHOW_text($rows['hoten']);
                                    $sodienthoai_1 = SHOW_text($rows['sodienthoai']);

                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <input name='xoa_gr_arr_<?= $cl ?>' type='checkbox'
                                                   class='minimal cls_showxoa'>
                                        </td>
                                        <td class="text-center">
                                            <input name="idme<?= $cl ?>" value="<?= $ida_1 ?>" type="hidden">
                                            <?= $cl ?>
                                        </td>
                                        <td>
                                            <span class="sp-list-cap1">╚═►</span>
                                            <div class="name name_list_cap_1">
                                                <div><b><?= $tenbaiviet_vi_1 ?></b></div>
                                                <div><a style="font-size: 12px; display: block;"
                                                        href="../<?= $sanpham['seo_name'] ?>/"
                                                        target="_blank"><?= $sanpham['tenbaiviet_vi'] ?></a></div>
                                                <div class="hide_url"><?= $noidung_vi_1 ?></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div><b><?= $hoten_1 ?></b></div>
                                        </td>
                                        <td>
                                            <div><b><?= $sodienthoai_1 ?></b></div>
                                        </td>

                                        <td class="text-center">
                                            <div id="cus" class="cus_menu">
                                                <label><input type="checkbox" class='minimal' name="showhi_<?= $cl ?>"
                                                              value="1" <?= (($showhi_1 == 1) ? "checked='checked'" : "") ?> ></label>
                                            </div>
                                        </td>
                                        <td class="text-center">

                                            <a href="<?= $url_page . '&del=ok&catalogid=' . $ida_1 . '&token=' . $token ?>&step=<?= $step ?>&id_step=<?= $id_step ?>"
                                               class="do" title="Xóa" onclick="return confirm('Bạn thật sự muốn xóa?')"><i
                                                        class="fa fa-times"></i></a>
                                        </td>
                                    </tr>

                                <?php } ?>
                                <!--  -->
                            <?php } ?>
                            </tbody>
                        </table>
                        <input type='hidden' value='<?= $cl ?>' name='maxvalu'>
                    </div>
                    <div class="box-header">
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