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
                <label>Hiển thị</label>
                <input type="text" class="form-control" value="<?= !empty($mt_1_vi) ? SHOW_text($mt_1_vi) : '' ?>"
                       name="mt_1_vi" id="mt_1_vi">
            </div>

            <div class="form-group">
                <label>Mô tả 1</label>
                <textarea id="mt_2_vi" name="mt_2_vi" rows="10"
                          cols="80"><?= !empty($mt_2_vi) ? SHOW_text($mt_2_vi) : '' ?></textarea>
            </div>
            <div class="form-group">
                <label>Mô tả 2</label>
                <textarea id="mt_3_vi" name="mt_3_vi" rows="10"
                          cols="80"><?= !empty($mt_3_vi) ? SHOW_text($mt_3_vi) : '' ?></textarea>
            </div>
            <div class="form-group">
                <label>Mô tả chi tiết</label>
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
        <?php if ($lang_nb2) { ?>
            <div class="tab-pane" id="tab_2">
                <div class="form-group">
                    <label>Tên <?= getTypeTitle($_GET['step']) ?> (<?= _lang_nb2_key ?>)</label>
                    <input type="text" class="form-control"
                           value="<?= !empty($tenbaiviet_en) ? SHOW_text($tenbaiviet_en) : '' ?>" name="tenbaiviet_en"
                           id="tenbaiviet_en">
                </div>
                <div class="form-group">
                    <label>Hiển thị (<?= _lang_nb2_key ?>)</label>
                    <input type="text" class="form-control" value="<?= !empty($mt_1_en) ? SHOW_text($mt_1_en) : '' ?>"
                           name="mt_1_en" id="mt_1_en">
                </div>
                <div class="form-group">
                    <label>Mô tả 1 (<?= _lang_nb2_key ?>)</label>
                    <textarea id="mt_2_en" name="mt_2_en" rows="10"
                              cols="80"><?= !empty($mt_2_en) ? SHOW_text($mt_2_en) : '' ?></textarea>
                </div>
                <div class="form-group">
                    <label>Mô tả 2(<?= _lang_nb2_key ?>)</label>
                    <textarea id="mt_3_en" name="mt_3_en" rows="10"
                              cols="80"><?= !empty($mt_3_en) ? SHOW_text($mt_3_en) : '' ?></textarea>
                </div>

                <div class="form-group">
                    <label>Mô tả chi tiết (<?= _lang_nb2_key ?>)</label>
                    <textarea id="mota_en" name="mota_en" rows="10"
                              cols="80"><?= !empty($mota_en) ? SHOW_text($mota_en) : '' ?></textarea>
                </div>
                <?php if (CHECK_key_setting("noi-dung-san-pham")) { ?>
                    <div class="form-group">
                        <label>Nội dung (<?= _lang_nb2_key ?>)</label>
                        <textarea id="noidung_en" name="noidung_en" rows="10"
                                  cols="80"><?= !empty($noidung_en) ? SHOW_text($noidung_en) : '' ?></textarea>
                    </div>
                <?php } ?>

                <div class="form-group">
                    <label>Seo Title (<?= _lang_nb2_key ?>)</label>
                    <input type="text" class="form-control" name="seo_title_en"
                           value="<?= !empty($seo_title_en) ? Show_text($seo_title_en) : "" ?>">
                </div>

                <div class="form-group">
                    <label>Seo Description (<?= _lang_nb2_key ?>)</label>
                    <input type="text" class="form-control" name="seo_description_en"
                           value="<?= !empty($seo_description_en) ? Show_text($seo_description_en) : "" ?>">
                </div>

                <div class="form-group">
                    <label>Seo keywords (<?= _lang_nb2_key ?>)</label>
                    <input type="text" class="form-control" name="seo_keywords_en"
                           value="<?= !empty($seo_keywords_en) ? Show_text($seo_keywords_en) : "" ?>">
                </div>
            </div>
        <?php } ?>
        <?php if ($lang_nb3) { ?>
            <div class="tab-pane" id="tab_3">
                <div class="form-group">
                    <label>Tên <?= getTypeTitle($_GET['step']) ?> (<?= _lang_nb3_key ?>)</label>
                    <input type="text" class="form-control"
                           value="<?= !empty($tenbaiviet_cn) ? SHOW_text($tenbaiviet_cn) : '' ?>" name="tenbaiviet_cn"
                           id="tenbaiviet_cn">
                </div>

                <div class="form-group">
                    <label>Mô tả (<?= _lang_nb3_key ?>)</label>
                    <textarea id="mota_cn" name="mota_cn" rows="10"
                              cols="80"><?= !empty($mota_cn) ? SHOW_text($mota_cn) : '' ?></textarea>
                </div>
                <?php if (CHECK_key_setting("noi-dung-san-pham")) { ?>
                    <div class="form-group">
                        <label>Nội dung (<?= _lang_nb3_key ?>)</label>
                        <textarea id="noidung_cn" name="noidung_cn" rows="10"
                                  cols="80"><?= !empty($noidung_cn) ? SHOW_text($noidung_cn) : '' ?></textarea>
                    </div>
                <?php } ?>

                <div class="form-group">
                    <label>Seo Title (<?= _lang_nb3_key ?>)</label>
                    <input type="text" class="form-control" name="seo_title_cn"
                           value="<?= !empty($seo_title_cn) ? Show_text($seo_title_cn) : "" ?>">
                </div>

                <div class="form-group">
                    <label>Seo Description (<?= _lang_nb3_key ?>)</label>
                    <input type="text" class="form-control" name="seo_description_cn"
                           value="<?= !empty($seo_description_cn) ? Show_text($seo_description_cn) : "" ?>">
                </div>

                <div class="form-group">
                    <label>Seo keywords (<?= _lang_nb3_key ?>)</label>
                    <input type="text" class="form-control" name="seo_keywords_cn"
                           value="<?= !empty($seo_keywords_cn) ? Show_text($seo_keywords_cn) : "" ?>">
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<div class="box p10">
    <!-- <div class="form-group">
    <label>Mã sản phẩm</label>
    <input type="text" class="form-control" name="p1" value="<?= !empty($p1) ? Show_text($p1) : "" ?>">
  </div> -->
    <div class="form-group">
        <label>Giá thuê</label>
        <input type="text" class="form-control cls_giatien_f" name="giatien"
               value="<?= !empty($giatien) ? Show_text($giatien) : "0" ?>" onkeyup="SetCurrency(this)">
    </div>
    <div class="form-group">
        <label>Đơn vị tính</label>
        <input type="text" class="form-control" name="p1" value="<?= !empty($p1) ? Show_text($p1) : "" ?>">
    </div>
    <!-- <div class="form-group">
    <label>Giá khuyến mãi: </label>
    <input type="text" class="form-control cls_giatien_khuyenmai_f" name="giakm" value="<?= !empty($giakm) ? Show_text($giakm) : "0" ?>" onkeyup="SetCurrency(this)">

    <label style=" margin-top: 10px; margin-bottom: 0;"><input type="checkbox" class="minimal" name="opt_km" value="1" <?= LAY_checked(@$opt_km, 1) ?>> Áp dụng khuyến mãi</label>
  </div> -->

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
        <label for="exampleInputFile">Hình đại
            diện <?= !empty($thongtin_step['size_img']) && $thongtin_step['size_img'] != '' ? "(" . str_replace("x", "px x ", $thongtin_step['size_img']) . "px)" : '' ?></label>
        <?= !empty($icon) ? $icon : '' ?>
        <input name="icon" type="file" class="form-control" id="exampleInputFile">
    </div>
    <div class="form-group">
        <label>Tọa độ Google map</label>
        <input type="text" class="form-control" name="p3" value="<?= !empty($p3) ? Show_text($p3) : "" ?>">
    </div>
    <!-- <div class="form-group">
    <label for="exampleInputFile2">Hình đại diện hover <?= !empty($thongtin_step['size_img']) && $thongtin_step['size_img'] != '' ? "(" . str_replace("x", "px x ", $thongtin_step['size_img']) . "px)" : '' ?></label>
    <?= !empty($icon_hover) ? $icon_hover : '' ?>
    <input name="icon_hover" type="file" class="form-control" id="exampleInputFile2">
  </div> -->

    <!-- <div class="form-group">
    <label for="exampleInputFile">File Dowload: <span>Chỉ upload 1 file [*.pdf] [*.docx] [*.rar] [*.zip] [*.xlsx] dung lượng file tối đa 10MB.</span></label>
    <?= !empty($dowload) ? '</br>' . $dowload : '' ?>
    <input name="dowload" type="file" class="form-control" id="exampleInputFile">
  </div> -->
    <?php
    $tinhnang = GET_tinhnang();
    if (!empty($detail_vi)) {
        $detail_vi = explode(",", $detail_vi);
    }
    foreach ($tinhnang as $value) {
        if ($value['id_parent'] != 0) continue;
        ?>
        <div class="form-group">
            <label><?= $value['tenbaiviet_vi'] ?></label>
            <select name="detail_vi[]" id="id_parent" class="form-control">
                <option value="">Chọn <?= strtolower($value['tenbaiviet_vi']) ?></option>
                <?php
                foreach ($tinhnang as $value1) {
                    if ($value1['id_parent'] != $value['id']) continue;
                    ?>
                    <option value="<?= $value1['id'] ?>" <?= !empty($detail_vi) && in_array($value1['id'], $detail_vi) ? "selected='selected'" : "" ?>><?= $value1['tenbaiviet_vi'] ?></option>
                <?php } ?>
            </select>
        </div>
    <?php } ?>

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
<?php $ckeditor->replace('mt_2_vi'); ?>
<?php $ckeditor->replace('mt_2_en'); ?>
<?php $ckeditor->replace('mt_3_vi'); ?>
<?php $ckeditor->replace('mt_3_en'); ?>