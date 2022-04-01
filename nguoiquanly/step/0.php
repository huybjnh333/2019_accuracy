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
                    <label>Tên <?= getTypeTitle($step) ?> (en)</label>
                    <input type="text" class="form-control"
                           value="<?= !empty($tenbaiviet_en) ? SHOW_text($tenbaiviet_en) : '' ?>" name="tenbaiviet_en"
                           id="tenbaiviet_en">
                </div>

                <div class="form-group">
                    <label>Nội dung (en)</label>
                    <textarea id="noidung_en" name="noidung_en" rows="10"
                              cols="80"><?= !empty($noidung_en) ? SHOW_text($noidung_en) : '' ?></textarea>
                </div>

                <div class="form-group">
                    <label>Seo Title (en)</label>
                    <input type="text" class="form-control" name="seo_title_en"
                           value="<?= !empty($seo_title_en) ? Show_text($seo_title_en) : "" ?>">
                </div>

                <div class="form-group">
                    <label>Seo Description (en)</label>
                    <input type="text" class="form-control" name="seo_description_en"
                           value="<?= !empty($seo_description_en) ? Show_text($seo_description_en) : "" ?>">
                </div>

                <div class="form-group">
                    <label>Seo keywords (en)</label>
                    <input type="text" class="form-control" name="seo_keywords_en"
                           value="<?= !empty($seo_keywords_en) ? Show_text($seo_keywords_en) : "" ?>">
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<div class="box p10">
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
        <label for="exampleInputFile">Hình đại diện</label>
        <?= !empty($icon) ? $icon : '' ?>
        <input name="icon" type="file" class="form-control" id="exampleInputFile">
    </div>
    <div class="form-group" style="display: none">
        <label>Nằm trong</label>
        <?= LAY_chude($id_parent, $step, 'id_parent', 'form-control', 0, $id_step, 0, 'false', 0) ?>
    </div>
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