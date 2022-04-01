<?php
if (isset($_GET['them-moi']) || (isset($_GET['edit']) && is_numeric($_GET['edit']))) {
    include "module-quan-ly-ngon-ngu-add.php";
} else {
    $table = '#_clanguage';
    if (isset($_GET['del'])) {
        $sql_se = DB_que("SELECT * FROM `$table` WHERE `id`='" . $_GET['catalogid'] . "' LIMIT 1");
        $del_name = @mysql_result($sql_se, 0, 'lang_vi');
        DB_que("DELETE from $table WHERE id='" . $_GET['catalogid'] . "' limit 1");
        $_SESSION['show_message_on'] = 'Đã xóa [<strong>' . $del_name . '</strong>] thành công!';
        LOCATION_js($url_page);
        exit();
    }

    if (isset($_REQUEST['addgiatri']) AND isset($_REQUEST['maxvalu'])) {
        for ($i = 0; $i < $_REQUEST['maxvalu']; $i++) {
            $idofme = $_POST["idme$i"];
            $tenbv_vi = $_POST["ncata_vi$i"];

            if (isset($_POST["xoa_gr_arr_$i"])) {
                DB_que("DELETE from $table WHERE id='" . $idofme . "' limit 1");
            } else {
                $where = '';
                if (isset($_SESSION['admin'])) {
                    $showhi = isset($_POST["showhi_$i"]) ? 1 : 0;
                    $where .= " , `showhi` = '$showhi' ";
                }
                if ($lang_nb2) {
                    $tenbv_en = $_POST["ncata_en$i"];
                    $where .= ", `lang_en`='$tenbv_en'";
                }
                if ($lang_nb3) {
                    $tenbv_cn = $_POST["ncata_cn$i"];
                    $where .= ", `lang_cn`='$tenbv_cn'";
                }
                DB_que("UPDATE `$table` SET `lang_vi`='$tenbv_vi' $where WHERE `id`='$idofme' LIMIT 1");
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
                        <div class="box-header with-border">
                            <h2 class="h2_title">
                                <i class="fa fa-pencil-square-o"></i> Danh sách
                            </h2>
                            <h3 class="box-title box-title-td pull-right">
                                <button type="submit" name="addgiatri" class="btn btn-primary"
                                        onclick="return CHECK_delimg()"><i class="fa fa-floppy-o"></i> <?= luu_lai ?>
                                </button>
                                <?php if (isset($_SESSION['admin'])) { ?>
                                    <a href="<?= $url_page ?>&them-moi=true" class="btn btn-primary"><i
                                                class="fa fa-plus"></i> Thêm mới</a>
                                    <?php
                                }
                                ?>
                            </h3>
                        </div>
                        <div class="box-body table-responsive no-padding table-danhsach-cont">
                            <table class="table table-hover table-danhsach">
                                <tbody>
                                <tr>
                                    <?php if (isset($_SESSION['admin'])) { ?>
                                        <th class="w50 text-center">
                                            <label>
                                                <input type='checkbox' class='minimal cls_showxoa_all'> Xóa
                                            </label>
                                        </th>
                                    <?php } ?>
                                    <th class="w80 text-center">STT</th>
                                    <?php if (isset($_SESSION['admin'])) { ?>
                                        <th>Mã ngôn ngữ</th>
                                    <?php } ?>
                                    <th>Ngôn ngữ (<?= _lang_nb1_key ?>)</th>
                                    <?php if ($lang_nb2) { ?>
                                        <th class="tienganh">Ngôn ngữ (<?= _lang_nb2_key ?>)</th>
                                    <?php } ?>
                                    <?php if ($lang_nb3) { ?>
                                        <th class="tienganh">Ngôn ngữ (<?= _lang_nb3_key ?>)</th>
                                    <?php } ?>
                                    <?php if (isset($_SESSION['admin'])) { ?>
                                        <th class="w90 text-center">Hiển thị</th>
                                    <?php } ?>
                                    <th class="w100 text-center">Tác vụ</th>
                                </tr>
                                <?php
                                $where = ' WHERE `showhi` = 1';
                                if (isset($_SESSION['admin'])) {
                                    $where = "";
                                }
                                $sql = DB_que("SELECT * FROM `$table` $where ORDER BY `showhi` DESC, `id` ASC");
                                $cl = 0;
                                while ($rows = mysql_fetch_assoc($sql)) {
                                    $ida = $rows['id'];
                                    $code_lang = SHOW_text($rows['code_lang']);
                                    $text_lang_vi = SHOW_text($rows['lang_vi']);
                                    $text_lang_en = SHOW_text($rows['lang_en']);
                                    $text_lang_cn = SHOW_text($rows['lang_cn']);
                                    $showhi = SHOW_text($rows['showhi']);
                                    ?>
                                    <tr>
                                        <?php if (isset($_SESSION['admin'])) { ?>
                                            <td class="text-center">
                                                <input name='xoa_gr_arr_<?= $cl ?>' type='checkbox'
                                                       class='minimal cls_showxoa'>
                                            </td>
                                        <?php } ?>
                                        <td class="text-center">
                                            <input name="idme<?= $cl ?>" value="<?= $ida ?>" type="hidden">
                                            <?= $cl + 1 ?>
                                        </td>
                                        <?php if (isset($_SESSION['admin'])) { ?>
                                            <td><?= $code_lang ?></td>
                                        <?php } ?>
                                        <td>
                                            <div class="name">
                                                <input type="text" name="ncata_vi<?= $cl ?>"
                                                       value="<?= $text_lang_vi ?>">
                                            </div>
                                        </td>
                                        <?php if ($lang_nb2) { ?>
                                            <td class="tienganh">
                                                <div class="name">
                                                    <input type="text" name="ncata_en<?= $cl ?>"
                                                           value="<?= $text_lang_en ?>">
                                                </div>
                                            </td>
                                        <?php } ?>
                                        <?php if ($lang_nb3) { ?>
                                            <td class="tienganh">
                                                <div class="name">
                                                    <input type="text" name="ncata_cn<?= $cl ?>"
                                                           value="<?= $text_lang_cn ?>">
                                                </div>
                                            </td>
                                        <?php } ?>
                                        <?php if (isset($_SESSION['admin'])) { ?>
                                            <td class="text-center">
                                                <div id="cus" class="cus_menu">
                                                    <label><input type="checkbox" class='minimal'
                                                                  name="showhi_<?= $cl ?>"
                                                                  value="1" <?= (($showhi == 1) ? "checked='checked'" : "") ?> ></label>
                                                </div>
                                            </td>
                                        <?php } ?>
                                        <td class="text-center">
                                            <a href="<?= $url_page ?>&edit=<?= $ida ?>"><i
                                                        class="fa fa-pencil-square-o"></i></a>
                                            <?php if (isset($_SESSION['admin'])) { ?>
                                                <a href="<?= $url_page ?>&del=ok&catalogid=<?= $ida ?>&token=<?= GET_token() ?>"
                                                   class="do" onclick="return confirm('Bạn thật sự muốn xóa?')"><i
                                                            class="fa fa-times"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php $cl++;
                                } ?>
                                </tbody>
                            </table>
                            <input type='hidden' value='<?= $cl ?>' name='maxvalu'>
                        </div>
                        <div class="box-header">
                            <h3 class="box-title box-title-td pull-right">
                                <button type="submit" name="addgiatri" class="btn btn-primary"
                                        onclick="return CHECK_delimg()"><i class="fa fa-floppy-o"></i> <?= luu_lai ?>
                                </button>
                                <?php if (isset($_SESSION['admin'])) { ?>
                                    <a href="<?= $url_page ?>&them-moi=true" class="btn btn-primary"><i
                                                class="fa fa-plus"></i> Thêm mới</a>
                                <?php } ?>
                            </h3>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </form>
<?php } ?>