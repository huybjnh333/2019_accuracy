<input type="hidden" name="anh_sp"
       value="<?= !empty($thongtin_step['size_img']) && $thongtin_step['size_img'] != '' ? $thongtin_step['size_img'] : '' ?>">
<div class="nav-tabs-custom">
    <?php include _source . "lang.php" ?>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <div class="form-group">
                <label>Tên <?= $thongtin_step['tenbaiviet_vi'] ?></label>
                <input type="text" class="form-control"
                       value="<?= !empty($tenbaiviet_vi) ? SHOW_text($tenbaiviet_vi) : '' ?>" name="tenbaiviet_vi"
                       id="tenbaiviet_vi">
            </div>

            <div class="form-group">
                <label>Nội dung</label>
                <textarea id="noidung_vi" name="noidung_vi" rows="10"
                          cols="80"><?= !empty($noidung_vi) ? SHOW_text($noidung_vi) : '' ?></textarea>
            </div>

        </div>
        <?php if ($lang_nb2) { ?>
            <div class="tab-pane" id="tab_2">
                <div class="form-group">
                    <label>Tên <?= $thongtin_step['tenbaiviet_vi'] ?> (<?= _lang_nb2_key ?>)</label>
                    <input type="text" class="form-control"
                           value="<?= !empty($tenbaiviet_en) ? SHOW_text($tenbaiviet_en) : '' ?>" name="tenbaiviet_en"
                           id="tenbaiviet_en">
                </div>

                <div class="form-group">
                    <label>Nội dung (<?= _lang_nb2_key ?>)</label>
                    <textarea id="noidung_en" name="noidung_en" rows="10"
                              cols="80"><?= !empty($noidung_en) ? SHOW_text($noidung_en) : '' ?></textarea>
                </div>

            </div>
        <?php } ?>
        <?php if ($lang_nb3) { ?>
            <div class="tab-pane" id="tab_3">
                <div class="form-group">
                    <label>Tên <?= $thongtin_step['tenbaiviet_vi'] ?> (<?= _lang_nb3_key ?>)</label>
                    <input type="text" class="form-control"
                           value="<?= !empty($tenbaiviet_cn) ? SHOW_text($tenbaiviet_cn) : '' ?>" name="tenbaiviet_cn"
                           id="tenbaiviet_cn">
                </div>

                <div class="form-group">
                    <label>Nội dung (<?= _lang_nb3_key ?>)</label>
                    <textarea id="noidung_cn" name="noidung_cn" rows="10"
                              cols="80"><?= !empty($noidung_cn) ? SHOW_text($noidung_cn) : '' ?></textarea>
                </div>

            </div>
        <?php } ?>
    </div>
</div>
<div class="box p10">
    <!-- <div class="form-group">
    <label>Seo name <a data-tooltip="Đường dẫn chuẩn bao gồm các ký tự [a-zA-Z0-9-]."> </a></label>
    <input type="text" class="form-control" name="seo_name" id="seo_name" value="<?= !empty($seo_name) ? Show_text($seo_name) : "" ?>">
    <label class="noweight noweight-top checkbox-mini">
      <input class="minimal auto_get_link" type="checkbox" <?= empty($id) || $id == 0 ? 'checked="checked"' : '' ?>> Lấy đường dẫn tự động
    </label>
  </div> -->

    <!-- <div class="form-group">
    <label for="exampleInputFile">Hình đại diện <?= !empty($thongtin_step['size_img']) && $thongtin_step['size_img'] != '' ? "(" . str_replace("x", "px x ", $thongtin_step['size_img']) . "px)" : '' ?></label>
    <?= !empty($icon) ? $icon : '' ?>
    <input name="icon" type="file" class="form-control" id="exampleInputFile" multiple="multiple">
  </div>
 -->
    <?php
    $data = DB_fet("*", "#_module_setting", 'id=38', "", "1", "arr", 1);
    $data = reset($data);
    $array_dm = explode(',', $data['ten_key']);
    if (in_array($step, $array_dm)) {
        ?>
        <div class="form-group">
            <label>Thuộc chủ đề</label>
            <?= LAY_chude($id_parent, $step, 'id_parent', 'form-control', 0, $id_step, 0, 'true', 1) ?>
        </div>
    <?php } ?>

    <div class="form-group">
        <label>Ngày đăng</label>

        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input name="ngaydang" type="text" class="form-control pull-right" id="datepicker" value='<?= $ngaydang ?>'>
        </div>
    </div>
    <div class="form-group">
        <label>Số thứ tự</label>
        <input type="text" class="form-control" name="catasort" id="catasort" value="<?= SHOW_text($catasort) ?>"
               onkeyup="SetCurrency(this)">
    </div>
    <div class="form-group">
        <label class="mr-20 checkbox-mini">
            <input type="checkbox" name="showhi"
                   class="minimal" <?= isset($showhi) && $showhi == 0 ? '' : 'checked="checked"' ?>> Hiển thị
        </label>
    </div>
</div>