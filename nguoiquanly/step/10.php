<input type="hidden" name="anh_sp"
       value="<?= !empty($thongtin_step['size_img']) && $thongtin_step['size_img'] != '' ? $thongtin_step['size_img'] : '' ?>">
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab"> Tiếng Việt</a></li>
        <?php if ($lang_en) { ?>
            <li class="tienganh"><a href="#tab_2" data-toggle="tab">English</a></li>
        <?php } ?>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <div class="form-group">
                <label>Tên <?= getTypeTitle($step) ?></label>
                <input type="text" class="form-control"
                       value="<?= !empty($tenbaiviet_vi) ? SHOW_text($tenbaiviet_vi) : '' ?>" name="tenbaiviet_vi"
                       id="tenbaiviet_vi">
            </div>
            <div class="form-group">
                <label>Ghi chú thêm</label>
                <textarea id="mota_vi" name="mota_vi" rows="10"
                          cols="80"><?= !empty($mota_vi) ? SHOW_text($mota_vi) : '' ?></textarea>
            </div>

            <div class="form-group">
                <label>Nội dung</label>
                <textarea id="noidung_vi" name="noidung_vi" rows="10"
                          cols="80"><?= !empty($noidung_vi) ? SHOW_text($noidung_vi) : '' ?></textarea>
            </div>

            <div class="form-group">
                <label>Seo Title</label>
                <input type="text" class="form-control" name="seo_title_vi"
                       value="<?= !empty($seo_title_vi) ? Show_text($seo_title_vi) : "" ?>">
            </div>

            <div class="form-group">
                <label>Seo Description</label>
                <input type="text" class="form-control" name="seo_description_vi"
                       value="<?= !empty($seo_description_vi) ? Show_text($seo_description_vi) : "" ?>">
            </div>

            <div class="form-group">
                <label>Seo keywords</label>
                <input type="text" class="form-control" name="seo_keywords_vi"
                       value="<?= !empty($seo_keywords_vi) ? Show_text($seo_keywords_vi) : "" ?>">
            </div>
        </div>
        <?php if ($lang_en) { ?>
            <div class="tab-pane" id="tab_2">
                <div class="form-group">
                    <label>Tên <?= getTypeTitle($_GET['step']) ?> (EN)</label>
                    <input type="text" class="form-control"
                           value="<?= !empty($tenbaiviet_en) ? SHOW_text($tenbaiviet_en) : '' ?>" name="tenbaiviet_en"
                           id="tenbaiviet_en">
                </div>

                <!-- <div class="form-group">
        <label>Mô tả (EN)</label>
        <textarea id="mota_en" name="mota_en" rows="10" cols="80"><?= !empty($mota_en) ? SHOW_text($mota_en) : '' ?></textarea>
      </div> -->
                <div class="form-group">
                    <label>Nội dung (EN)</label>
                    <textarea id="noidung_en" name="noidung_en" rows="10"
                              cols="80"><?= !empty($noidung_en) ? SHOW_text($noidung_en) : '' ?></textarea>
                </div>
                <div class="form-group">
                    <label>Seo Title (EN)</label>
                    <input type="text" class="form-control" name="seo_title_en"
                           value="<?= !empty($seo_title_en) ? Show_text($seo_title_en) : "" ?>">
                </div>

                <div class="form-group">
                    <label>Seo Description (EN)</label>
                    <input type="text" class="form-control" name="seo_description_en"
                           value="<?= !empty($seo_description_en) ? Show_text($seo_description_en) : "" ?>">
                </div>

                <div class="form-group">
                    <label>Seo keywords (EN)</label>
                    <input type="text" class="form-control" name="seo_keywords_en"
                           value="<?= !empty($seo_keywords_en) ? Show_text($seo_keywords_en) : "" ?>">
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<div class="box p10">
    <div class="form-group">
        <label>Họ tên <a data-tooltip="[Nội dung khóa]"> </a></label>
        <input type="text" class="form-control" name="mt_5_vi"
               value="<?= !empty($mt_5_vi) ? Show_text($mt_5_vi) : "" ?>">
    </div>
    <div class="form-group">
        <label>Số CMND <a data-tooltip="[Nội dung khóa]"> </a></label>
        <input type="text" class="form-control" name="mt_1_vi"
               value="<?= !empty($mt_1_vi) ? Show_text($mt_1_vi) : "" ?>">
    </div>
    <div class="form-group">
        <label>Năm sinh <a data-tooltip="[Nội dung khóa]"> </a></label>
        <input type="text" class="form-control" name="mt_2_vi"
               value="<?= !empty($mt_2_vi) ? Show_text($mt_2_vi) : "" ?>">
    </div>
    <div class="form-group">
        <label>Điện thoại <a data-tooltip="[Nội dung khóa]"> </a></label>
        <input type="text" class="form-control" name="mt_3_vi"
               value="<?= !empty($mt_3_vi) ? Show_text($mt_3_vi) : "" ?>">
    </div>
    <div class="form-group">
        <label>Email <a data-tooltip="[Nội dung khóa]"> </a></label>
        <input type="text" class="form-control" name="mt_4_vi"
               value="<?= !empty($mt_4_vi) ? Show_text($mt_4_vi) : "" ?>">
    </div>

    <div class="form-group">
        <label>Giá tiền</label>
        <input type="text" class="form-control cls_giatien_f" name="giatien"
               value="<?= !empty($giatien) ? Show_text($giatien) : "0" ?>" onkeyup="SetCurrency(this)">
    </div>

    <div class="form-group">
        <label>Số lần mua tối đa</label>
        <input type="text" class="form-control " name="giakm" value="<?= !empty($giakm) ? Show_text($giakm) : "0" ?>">
    </div>
    <div class="form-group">
        <label>Điểm mua tin</label>
        <input type="text" class="form-control " name="mt_8_vi"
               value="<?= !empty($mt_8_vi) ? Show_text($mt_8_vi) : "0" ?>">
    </div>
    <div class="form-group">
        <label>Điều kiện mua tin</label>
        <div class="dv-nd-tinhnang">
            <label style="margin-top: 8px; width: auto; margin-right: 50px;">
                <input type="checkbox" class="minimal"
                       name="opt" <?= isset($opt) && $opt == 1 ? 'checked="checked"' : '' ?>> Khác lĩnh vực
            </label>
            <label style="margin-top: 8px; width: auto;">
                <input type="checkbox" class="minimal"
                       name="opt1" <?= isset($opt1) && $opt1 == 1 ? 'checked="checked"' : '' ?>> Khác công ty
            </label>
            <div class="clear"></div>
        </div>
    </div>
    <div class="form-group">
        <label>Ngày hết hạn</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input name="mt_9_vi" type="text" class="form-control pull-right" id="datepicker2"
                   value='<?= !empty($mt_9_vi) ? $mt_9_vi : '' ?>'>
        </div>
    </div>

    <div class="form-group">
        <label>Seo name <a data-tooltip="Đường dẫn chuẩn bao gồm các ký tự [a-zA-Z0-9-]."> </a></label>
        <input type="text" class="form-control" name="seo_name" id="seo_name"
               value="<?= !empty($seo_name) ? Show_text($seo_name) : "" ?>">
        <label class="noweight noweight-top checkbox-mini">
            <input class="minimal auto_get_link"
                   type="checkbox" <?= empty($id) || $id == 0 ? 'checked="checked"' : '' ?>> Lấy đường dẫn tự động
        </label>
    </div>


    <div class="form-group">
        <label>Tỉnh / thành phố</label>
        <select name="mt_10_vi" id="mt_10_vi" class="form-control">
            <?php
            foreach ($tinnang as $val) {
                if ($val['id'] == 2) {
                    ?>
                    <option value="0"><?= SHOW_text($val['tenbaiviet_vi']) ?></option>
                    <?php
                    foreach ($tinnang as $val2) {
                        if ($val2['id_parent'] == $val['id']) {
                            ?>
                            <option value="<?= $val2['id'] ?>" <?= LAY_selected($val2['id'], $mt_10_vi) ?>><?= SHOW_text($val2['tenbaiviet_vi']) ?></option>
                        <?php }
                    }
                }
            } ?>
        </select>
    </div>

    <!-- <div class="form-group">
    <label for="exampleInputFile">Hình đại diện <?= !empty($thongtin_step['size_img']) && $thongtin_step['size_img'] != '' ? "(" . str_replace("x", "px x ", $thongtin_step['size_img']) . "px)" : '' ?></label>
    <?= !empty($icon) ? $icon : '' ?>
    <input name="icon" type="file" class="form-control" id="exampleInputFile">
  </div> -->

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

    <!-- <div class="form-group">
    <label>Toạ độ Google</label>
    <input type="text" class="form-control " name="mt_6_vi" value="<?= !empty($mt_6_vi) ? Show_text($mt_6_vi) : "" ?>">
  </div> -->
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
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
    $('#datepicker2').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    })
</script> 