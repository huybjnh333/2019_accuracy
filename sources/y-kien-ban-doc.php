<?php
$danhsachbl = DB_fet("*",
    "#_binhluan",
    'showhi=1 and id_sp=' . $arr_running['id'],
    "id desc",
    "",
    "arr",
    1);
?>

<div class="boxComment_danhgia <?= (empty($danhsachbl) && empty($_SESSION['id'])) ? "hidden" : "" ?>">
    <?php if (!empty($danhsachbl)) { ?>
        <h3><?= $glo_lang['ykienbandoc'] ?></h3>
        <?php foreach ($danhsachbl as $row) {
            $tenbl = $row['tenbaiviet_vi'];
            $noidungbl = SHOW_text($row['noidung_vi']);

            ?>
            <ul>
                <p><?= $noidungbl ?></p>
                <h5><?= $tenbl ?></h5>
            </ul>
        <?php }
    } ?>
    <?php if (!empty($_SESSION['id'])) { ?>
        <li><?= $glo_lang['vietnhanxetcuaban'] ?></li>
        <form action="" method="post" name="FormNamebinhluan" id="FormNamebinhluan">
            <input type="hidden" name="gui-binh-luan">
            <input type="hidden" class="lang_ok" value="<?= $glo_lang['yeu_cau_cua_ban_da_duoc_gui'] ?>">
            <input type="hidden" class="lang_false" value="<?= $glo_lang['nhap_ma_bao_ve_chua_dung'] ?>">
            <input type="hidden" name="idbv" value="<?= $arr_running['id'] ?>">
            <input type="hidden" name="id_parent" value="<?= $arr_running['id_parent'] ?>">
            <input type="hidden" name="bl_tieude" value="<?= $_SESSION['hoten'] ?>">
            <div class="col-md row-frm">
        <textarea name="s_message"
                  id="s_message"
                  class="form-control"
                  placeholder="<?= $glo_lang['viet_danh_gia'] ?>"
                  data-msso="Vui lòng nhập nội dung bình luận"
                  style="height:200px; padding-top:15px;"></textarea>
                <h4>
                    <a onclick="Checkbinhluan('#FormNamebinhluan', '<?= $full_url ?>/gui-binh-luan/')"><?= $glo_lang['goi-y-kien-cua-ban'] ?></a>
                </h4>
                <div class="clr"></div>
            </div>
        </form>
    <?php } ?>
</div>
