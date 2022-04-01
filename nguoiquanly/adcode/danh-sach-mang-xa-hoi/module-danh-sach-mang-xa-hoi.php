<?php
if (isset($_GET['them-moi']) || (isset($_GET['edit']) && is_numeric($_GET['edit']))) {
    include "module-danh-sach-mang-xa-hoi-add.php";
} else {
    $table = '#_mangxahoi';
    if (isset($_GET['del'])) {
        $sql_se = DB_que("SELECT * FROM `$table` WHERE `id`='" . $_GET['catalogid'] . "' LIMIT 1");

        if (mysql_num_rows($sql_se) > 0) {
            $icon = @mysql_result($sql_se, 0, 'icon');
            $duongdantin = @mysql_result($sql_se, 0, 'duongdantin');
            $del_name = @mysql_result($sql_se, 0, 'tenbaiviet_vi');
            $id = @mysql_result($sql_se, 0, 'id');

            @unlink("../" . $duongdantin . "/" . $icon);
            DB_que("DELETE from $table WHERE `id` ='" . $_GET['catalogid'] . "' LIMIT 1");

            $_SESSION['show_message_on'] = 'Xóa mạng xã hội [<strong>' . $del_name . '</strong>] thành công';
        } else $_SESSION['show_message_off'] = 'Dữ liệu không hợp lệ!';
        LOCATION_js($url_page);
        exit();
    }


    if (isset($_REQUEST['addgiatri']) AND isset($_REQUEST['maxvalu'])) {
        for ($i = 1; $i <= $_REQUEST['maxvalu']; $i++) {
            $idofme = $_POST["idme$i"];
            $tenbaiviet_vi = isset($_POST["tenbaiviet_vi$i"]) ? $_POST["tenbaiviet_vi$i"] : "";
            $tenbaiviet_en = isset($_POST["tenbaiviet_en$i"]) ? $_POST["tenbaiviet_en$i"] : "";
            $tenbaiviet_cn = isset($_POST["tenbaiviet_cn$i"]) ? $_POST["tenbaiviet_cn$i"] : "";
            $link_vi = $_POST["link_vi$i"];
            $fontawesome = $_POST["fontawesome$i"];

            if (isset($_POST["xoa_gr_arr_$i"])) {

                $sql_se = DB_que("SELECT * FROM `$table` WHERE `id`='" . $idofme . "' LIMIT 1");
                if (mysql_num_rows($sql_se) > 0) {
                    $icon = @mysql_result($sql_se, 0, 'icon');
                    $duongdantin = @mysql_result($sql_se, 0, 'duongdantin');
                    $del_name = @mysql_result($sql_se, 0, 'tenbaiviet_vi');
                    $id = @mysql_result($sql_se, 0, 'id');

                    @unlink("../" . $duongdantin . "/" . $icon);
                    DB_que("DELETE from $table WHERE `id` ='" . $idofme . "' LIMIT 1");

                    $_SESSION['show_message_on'] = 'Xóa mạng xã hội [<strong>' . $del_name . '</strong>] thành công';
                }

            } else {
                $sort = str_replace(".", "", $_POST["sortby$i"]);
                $showhi = isset($_POST["showhi_$i"]) ? "1" : "0";
                DB_que("UPDATE `$table` SET `tenbaiviet_vi`='$tenbaiviet_vi',`tenbaiviet_en`='$tenbaiviet_en',`tenbaiviet_cn`='$tenbaiviet_cn', `link_vi`='$link_vi', `fontawesome`='$fontawesome', `catasort`='$sort', `showhi`='$showhi' WHERE `id`='$idofme' LIMIT 1");
            }

        }
        $_SESSION['show_message_on'] = 'Cập nhật dữ liệu thành công!';
    }


    $sql = DB_que("SELECT * FROM `$table`   ORDER BY `catasort` ASC ");
    $sql_array = array();
    while ($r = mysql_fetch_assoc($sql)) {
        $sql_array[] = $r;
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
                                <i class="fa fa-pencil-square-o"></i> Mạng xã hội
                            </h2>
                            <h3 class="box-title box-title-td pull-right">
                                <button type="submit" name="addgiatri" class="btn btn-primary"
                                        onclick="return CHECK_delimg()"><i class="fa fa-floppy-o"></i> <?= luu_lai ?>
                                </button>
                                <a href="<?= $url_page ?>&them-moi=true" class="btn btn-primary"><i
                                            class="fa fa-plus"></i> Thêm mới</a>
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
                                    <th class="w100 text-center">Hình ảnh</th>
                                    <th class="w100 text-center">Hiển thị</th>
                                    <th class="w120 text-center">Tác vụ</th>
                                </tr>
                                <?php
                                $cl = 0;
                                foreach ($sql_array as $rows) {
                                    $cl++;

                                    $ida = SHOW_text($rows['id']);
                                    $tenbaiviet_vi = SHOW_text($rows['tenbaiviet_vi']);
                                    $tenbaiviet_en = SHOW_text($rows['tenbaiviet_en']);
                                    $tenbaiviet_cn = SHOW_text($rows['tenbaiviet_cn']);
                                    $link_vi = SHOW_text($rows['link_vi']);
                                    $fontawesome = SHOW_input($rows['fontawesome']);
                                    $icon = SHOW_text($rows['icon']);
                                    $catasort = number_format(SHOW_text($rows['catasort']), 0, ',', '.');
                                    $showhi = SHOW_text($rows['showhi']);

                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <input name='xoa_gr_arr_<?= $cl ?>' type='checkbox'
                                                   class='minimal cls_showxoa'>
                                        </td>
                                        <td class="text-center">
                                            <input name="idme<?= $cl ?>" value="<?= $ida ?>" type="hidden">
                                            <input type="text" class="text-center" name="sortby<?= $cl ?>"
                                                   value="<?= $catasort ?>" onkeyup="SetCurrency(this)">
                                        </td>

                                        <td>
                                            <div class="name">
                                                <input type="text" name="tenbaiviet_vi<?= $cl ?>" class="cls_emty_name"
                                                       value="<?= $tenbaiviet_vi ?>"
                                                       placeholder="Tiêu đề (<?= _lang_nb1_key ?>)">
                                            </div>
                                            <?php if ($lang_nb2) { ?>
                                                <div class="name" id="en">
                                                    <input type="text" name="tenbaiviet_en<?= $cl ?>"
                                                           class="cls_emty_name" value="<?= $tenbaiviet_en ?>"
                                                           placeholder="Tiêu đề (<?= _lang_nb2_key ?>)">
                                                </div>
                                            <?php } ?>
                                            <?php if ($lang_nb3) { ?>
                                                <div class="name" id="en">
                                                    <input type="text" name="tenbaiviet_cn<?= $cl ?>"
                                                           class="cls_emty_name" value="<?= $tenbaiviet_cn ?>"
                                                           placeholder="Tiêu đề (<?= _lang_nb3_key ?>)">
                                                </div>
                                            <?php } ?>
                                            <div class="name">
                                                <input type="text" class="cls_emty_name" name="link_vi<?= $cl ?>"
                                                       value="<?= $link_vi ?>" placeholder="Liên kết">
                                            </div>
                                            <div class="name">
                                                <input type="text" class="cls_emty_name" name="fontawesome<?= $cl ?>"
                                                       value="<?= $fontawesome ?>" placeholder="Fontawesome">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <img class='img_show_ds'
                                                 src='<?= $fullpath . "/" . $rows['duongdantin'] . "/thumb_" . $icon ?>'>
                                        </td>
                                        <td class="text-center">
                                            <div id="cus" class="cus_menu">
                                                <label><input type="checkbox" class='minimal' name="showhi_<?= $cl ?>"
                                                              value="1" <?= (($showhi == 1) ? "checked='checked'" : "") ?> ></label>
                                            </div>
                                        </td>

                                        <td class="text-center">
                                            <a href="<?= $url_page ?>&edit=<?= $ida ?>" title="Cập nhật"><i
                                                        class="fa fa-pencil-square-o"></i></a>
                                            <a href="<?= $url_page . '&del=ok&token=' . GET_token() . '&catalogid=' . $ida ?>"
                                               class="do" title="Xóa" onclick="return confirm('Bạn thật sự muốn xóa?')"><i
                                                        class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    <!--  -->
                                <?php } ?>
                                </tbody>
                            </table>
                            <input type='hidden' value='<?= $cl ?>' name='maxvalu'>
                        </div>
                        <div class="box-header">
                            <h3 class="box-title box-title-td pull-right">
                                <button type="submit" name="addgiatri" class="btn btn-primary"
                                        onclick="return CHECK_delimg()"><i class="fa fa-floppy-o"></i> <?= luu_lai ?>
                                </button>
                                <a href="<?= $url_page ?>&them-moi=true" class="btn btn-primary"><i
                                            class="fa fa-plus"></i> Thêm mới</a>
                            </h3>
                        </div>
                        <!--  -->
                    </div>
                </section>
            </div>
        </section>
    </form>
<?php } ?>