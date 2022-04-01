<?php
$id_step = $_GET['step'];
if (isset($_GET['them-moi']) || (isset($_GET['edit']) && is_numeric($_GET['edit']))) {
    include "module-danh-sach-tinh-nang-add.php";
} else {
    $table = '#_baiviet_tinhnang';

    if (isset($_GET['del'])) {
        $sql_se = DB_que("SELECT * FROM `$table` WHERE `id`='" . $_GET['catalogid'] . "' LIMIT 1");

        if (mysql_num_rows($sql_se) > 0) {
            $del_name = @mysql_result($sql_se, 0, 'tenbaiviet_vi');
            $id = @mysql_result($sql_se, 0, 'id');

            $sql = DB_que("DELETE from $table WHERE `id` ='" . $_GET['catalogid'] . "' LIMIT 1");
            //xoa pr child
            $sql_se_c1 = DB_que("SELECT * FROM `$table` WHERE `id_parent`='" . $_GET['catalogid'] . "'");
            while ($row_1 = mysql_fetch_array($sql_se_c1)) {
                DB_que("DELETE from $table WHERE `id`  = '" . $row_1['id'] . "' LIMIT 1");
                DB_que("DELETE from $table WHERE `id_parent` ='" . $row_1['id'] . "'");
            }
            //
            $_SESSION['show_message_on'] = 'Đã xóa [<strong>' . $del_name . '</strong>] thành công';
        } else $_SESSION['show_message_off'] = 'Dữ liệu không hợp lệ!';
        LOCATION_js($url_page . "&step=" . @$step . "&id_step=" . @$id_step);
        exit();
    }

    if (isset($_REQUEST['addgiatri']) AND isset($_REQUEST['maxvalu'])) {
        for ($i = 1; $i <= $_REQUEST['maxvalu']; $i++) {
            $idofme = $_POST["idme$i"];
            $up_sort = "";
            if (isset($_POST["sortby$i"])) {
                $sort = str_replace(".", "", $_POST["sortby$i"]);
                $up_sort = ", `catasort`='$sort'";
            }

            if (isset($_POST["xoa_gr_arr_$i"])) {
                //xoa
                $sql_se = DB_que("SELECT * FROM `$table` WHERE `id`='" . $idofme . "' LIMIT 1");
                if (mysql_num_rows($sql_se) > 0) {
                    $del_name = @mysql_result($sql_se, 0, 'tenbaiviet_vi');
                    $id = @mysql_result($sql_se, 0, 'id');

                    $sql = DB_que("DELETE from $table WHERE `id` ='" . $idofme . "' LIMIT 1");
                    //xoa pr child
                    $sql_se_c1 = DB_que("SELECT * FROM `$table` WHERE `id_parent`='" . $idofme . "'");
                    while ($row_1 = mysql_fetch_array($sql_se_c1)) {
                        DB_que("DELETE from $table WHERE `id`  = '" . $row_1['id'] . "' LIMIT 1");
                        DB_que("DELETE from $table WHERE `id_parent` ='" . $row_1['id'] . "'");
                    }
                }
                //
            } else {
                $ncata_vi = isset($_POST["ncata_vi$i"]) ? $_POST["ncata_vi$i"] : "";
                $ncata_en = isset($_POST["ncata_en$i"]) ? $_POST["ncata_en$i"] : "";
                $showhi = isset($_POST["showhi_$i"]) ? "1" : "0";
                DB_que("UPDATE `$table` SET `tenbaiviet_vi`='$ncata_vi', `tenbaiviet_en`='$ncata_en', `showhi`='$showhi' $up_sort WHERE `id`='$idofme' LIMIT 1");
            }
        }
        $_SESSION['show_message_on'] = 'Cập nhật dữ liệu thành công!';
    }


    $sql = DB_que("SELECT * FROM `$table` WHERE `step` = '" . $step . "' ORDER BY `catasort` ASC");
    $sql_array = array();
    while ($r = mysql_fetch_assoc($sql)) {
        $sql_array[] = $r;
    }
    ?>
    <section class="content-header">
        <h1> Danh sách tính năng</h1>
        <ol class="breadcrumb">
            <li><a href="<?= $fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="active">Danh sách tính năng</li>
        </ol>
    </section>

    <form action="" method="post">
        <input type="hidden" name="token" value="<?= GET_token() ?>">
        <section class="content">
            <div class="row">
                <section class="col-lg-12">
                    <?php include _source . "mesages.php"; ?>
                    <div class="box">
                        <div class="box-header">
                            <h2 class="h2_title">
                                <i class="fa fa-pencil-square-o"></i> <?= GETNAME_step($id_step) ?>
                            </h2>
                            <h3 class="box-title box-title-td pull-right">
                                <button type="submit" name="addgiatri" class="btn btn-primary"
                                        onclick="return CHECK_name_emty()"><i class="fa fa-floppy-o"></i> <?= luu_lai ?>
                                </button>
                                <a href="<?= $url_page ?>&them-moi=true&step=<?= $step ?>&id_step=<?= $id_step ?>"
                                   class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                            </h3>
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

                                    <th>Tiêu đề</th>
<!--                                    <th class="w100 text-center">Hình ảnh</th>-->
                                    <th class="w100 text-center">Hiển thị</th>
                                    <th class="w120 text-center">Tác vụ</th>
                                </tr>
                                <?php
                                $cl = 0;
                                foreach ($sql_array as $rows) {
                                    if ($rows['id_parent'] != 0) continue;
                                    $cl++;
                                    $ida = SHOW_text($rows['id']);
                                    $tenbaiviet_vi = SHOW_text($rows['tenbaiviet_vi']);
                                    $tenbaiviet_en = SHOW_text($rows['tenbaiviet_en']);
                                    $catasort = number_format(SHOW_text($rows['catasort']), 0, ',', '.');
                                    $id_parent = SHOW_text($rows['id_parent']);
                                    $showhi = SHOW_text($rows['showhi']);
                                    $icon = SHOW_text($rows['icon']);
                                    ?>
                                    <tr>

                                        <td class="text-center">
                                            <?php if (!empty($_SESSION['admin'])) { ?>
                                                <input name='xoa_gr_arr_<?= $cl ?>' type='checkbox'
                                                       class='minimal cls_showxoa'>
                                            <?php } ?>
                                        </td>

                                        <td class="text-center">
                                            <input name="idme<?= $cl ?>" value="<?= $ida ?>" type="hidden">
                                            <input type="text" class="text-center" name="" value="<?= $catasort ?>"
                                                   onkeyup="SetCurrency(this)" readonly="readonly">
                                        </td>

                                        <td>
                                            <div class="name">
                                                <input type="text" name="ncata_vi<?= $cl ?>" class="cls_emty_name"
                                                       value="<?= $tenbaiviet_vi ?>"
                                                       placeholder="Tiêu đề (<?= _lang_nb1_key ?>)">
                                            </div>

                                            <?php if ($lang_nb2) { ?>
                                                <div class="name" id="en">
                                                    <input type="text" name="ncata_en<?= $cl ?>" class=""
                                                           value="<?= $tenbaiviet_en ?>"
                                                           placeholder="Tiêu đề (<?= _lang_nb2_key ?>)">
                                                </div>
                                            <?php } ?>
                                        </td>
<!--                                        <td class="text-center">-->
<!--                                            <img class='img_show_ds' src='--><?//=$fullpath."/".$rows['duongdantin']."/thumb_".$icon ?><!--'>-->
<!--                                        </td>-->
                                        <td class="text-center">
                                            <div id="cus" class="cus_menu">
                                                <label><input type="checkbox" class='minimal' name="showhi_<?= $cl ?>"
                                                              value="1" <?= (($showhi == 1) ? "checked='checked'" : "") ?> ></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= $url_page ?>&step=<?= $step ?>&id_step=<?= $id_step ?>&edit=<?= $ida ?>"
                                               title="<?= luu_lai ?>"><i class="fa fa-pencil-square-o"></i></a>
                                            <?php if (!empty($_SESSION['admin'])) { ?>
                                                <a href="<?= $url_page . '&del=ok&catalogid=' . $ida ?>&step=<?= $step ?>&id_step=<?= $id_step ?>&token=<?= GET_token() ?>"
                                                   class="do" onclick="return confirm('Bạn thật sự muốn xóa?')"><i
                                                            class="fa fa-times"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>

                                    <!--  -->
                                    <?php
                                    foreach ($sql_array as $rows_2) {
                                        if ($rows_2['id_parent'] != $rows['id']) continue;
                                        $cl++;
                                        $ida_2 = SHOW_text($rows_2['id']);
                                        $tenbaiviet_vi_2 = SHOW_text($rows_2['tenbaiviet_vi']);
                                        $tenbaiviet_en_2 = SHOW_text($rows_2['tenbaiviet_en']);
                                        $catasort_2 = number_format(SHOW_text($rows_2['catasort']), 0, ',', '.');
                                        $id_parent_2 = SHOW_text($rows_2['id_parent']);
                                        $showhi_2 = SHOW_text($rows_2['showhi']);
                                        $icon_2 = SHOW_text($rows_2['icon']);
                                        ?>
                                        <tr>
                                            <td class="text-center">
                                                <input name='xoa_gr_arr_<?= $cl ?>' type='checkbox'
                                                       class='minimal cls_showxoa'>
                                            </td>
                                            <td class="text-center">
                                                <input name="idme<?= $cl ?>" value="<?= $ida_2 ?>" type="hidden">
                                                <input type="text" class="text-center" name="sortby<?= $cl ?>"
                                                       value="<?= $catasort_2 ?>" onkeyup="SetCurrency(this)">
                                            </td>

                                            <td>
                                                <span class="sp-list-cap1">╚═►</span>
                                                <div class="name name_list_cap_1">
                                                    <input type="text" name="ncata_vi<?= $cl ?>" class="cls_emty_name"
                                                           value="<?= $tenbaiviet_vi_2 ?>"
                                                           placeholder="Tiêu đề (<?= _lang_nb1_key ?>)">
                                                </div>
                                                <?php if ($lang_nb2) { ?>
                                                    <div class="name name_list_cap_1">
                                                        <input type="text" name="ncata_en<?= $cl ?>"
                                                               value="<?= $tenbaiviet_en_2 ?>"
                                                               placeholder="Tiêu đề (<?= _lang_nb2_key ?>)">
                                                    </div>
                                                <?php } ?>

                                            </td>
<!--                                            <td class="text-center">-->
<!--                                                <img class='img_show_ds' src='--><?//=$fullpath."/". $rows_2['duongdantin']."/thumb_".$icon_2 ?><!--'>-->
<!--                                            </td>-->
                                            <td class="text-center">
                                                <div id="cus" class="cus_menu">
                                                    <label><input type="checkbox" class='minimal'
                                                                  name="showhi_<?= $cl ?>"
                                                                  value="1" <?= (($showhi_2 == 1) ? "checked='checked'" : "") ?> ></label>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= $url_page ?>&step=<?= $step ?>&id_step=<?= $id_step ?>&edit=<?= $ida_2 ?>"
                                                   title="Cập nhật"><i class="fa fa-pencil-square-o"></i></a>
                                                <a href="<?= $url_page . '&del=ok&catalogid=' . $ida_2 ?>&step=<?= $step ?>&id_step=<?= $id_step ?>&token=<?= GET_token() ?>"
                                                   class="do" onclick="return confirm('Bạn thật sự muốn xóa?')"><i
                                                            class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                        <!--  -->
                                        <?php
                                        foreach ($sql_array as $rows_3) {
                                            if ($rows_3['id_parent'] != $rows_2['id']) continue;
                                            $cl++;
                                            $ida_3 = SHOW_text($rows_3['id']);
                                            $tenbaiviet_vi_3 = SHOW_text($rows_3['tenbaiviet_vi']);
                                            $tenbaiviet_en_3 = SHOW_text($rows_3['tenbaiviet_en']);
                                            $catasort_3 = number_format(SHOW_text($rows_3['catasort']), 0, ',', '.');
                                            $id_parent_3 = SHOW_text($rows_3['id_parent']);
                                            $showhi_3 = SHOW_text($rows_3['showhi']);
                                            ?>
                                            <tr>
                                                <td class="text-center">
                                                    <input name='xoa_gr_arr_<?= $cl ?>' type='checkbox'
                                                           class='minimal cls_showxoa'>
                                                </td>
                                                <td class="text-center">
                                                    <input name="idme<?= $cl ?>" value="<?= $ida_3 ?>" type="hidden">
                                                    <input type="text" class="text-center" name="sortby<?= $cl ?>"
                                                           value="<?= $catasort_3 ?>" onkeyup="SetCurrency(this)">
                                                </td>

                                                <td>
                                                    <span class="sp-list-cap2">╚═►</span>
                                                    <div class="name name_list_cap_2">
                                                        <input type="text" name="ncata_vi<?= $cl ?>"
                                                               class="cls_emty_name" value="<?= $tenbaiviet_vi_3 ?>"
                                                               placeholder="Tiêu đề (<?= _lang_nb1_key ?>)">
                                                    </div>
                                                    <?php if ($lang_nb2) { ?>
                                                        <div class="name name_list_cap_2">
                                                            <input type="text" name="ncata_en<?= $cl ?>"
                                                                   value="<?= $tenbaiviet_en_3 ?>"
                                                                   placeholder="Tiêu đề (<?= _lang_nb2_key ?>)">
                                                        </div>
                                                    <?php } ?>

                                                </td>
                                                <td class="text-center">
                                                    <div id="cus" class="cus_menu">
                                                        <label><input type="checkbox" class='minimal'
                                                                      name="showhi_<?= $cl ?>"
                                                                      value="1" <?= (($showhi_3 == 1) ? "checked='checked'" : "") ?> ></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <a href="<?= $url_page ?>&step=<?= $step ?>&id_step=<?= $id_step ?>&edit=<?= $ida_3 ?>"
                                                       title="Cập nhật"><i class="fa fa-pencil-square-o"></i></a>
                                                    <a href="<?= $url_page . '&del=ok&catalogid=' . $ida_3 ?>&step=<?= $step ?>&id_step=<?= $id_step ?>&token=<?= GET_token() ?>"
                                                       class="do" onclick="return confirm('Bạn thật sự muốn xóa?')"><i
                                                                class="fa fa-times"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <!--  -->
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
                    </div>
                </section>
            </div>
        </section>
    </form>
<?php } ?>