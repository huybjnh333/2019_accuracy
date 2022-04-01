<input type="hidden" name="anh_sp"
       value="<?= !empty($thongtin_step['size_img']) && $thongtin_step['size_img'] != '' ? $thongtin_step['size_img'] : '' ?>">
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab"> Tiếng Việt</a></li>
        <li class="tienganh"><a href="#tab_2" data-toggle="tab">English</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <div class="form-group">
                <label>Tên <?= getTypeTitle($step) ?></label>
                <input type="text" class="form-control"
                       value="<?= !empty($tenbaiviet_vi) ? SHOW_text($tenbaiviet_vi) : '' ?>" name="tenbaiviet_vi"
                       id="tenbaiviet_vi">
            </div>
           <!-- <div class="form-group">
                <label>Mô tả</label>
                <textarea id="mota_vi" name="mota_vi" rows="10"
                          cols="80"><?= !empty($mota_vi) ? SHOW_text($mota_vi) : '' ?></textarea>
            </div>-->
        </div>

        <div class="tab-pane" id="tab_2">
            <div class="form-group">
                <label>Tên <?= getTypeTitle($step) ?> (EN)</label>
                <input type="text" class="form-control"
                       value="<?= !empty($tenbaiviet_en) ? SHOW_text($tenbaiviet_en) : '' ?>" name="tenbaiviet_en"
                       id="tenbaiviet_en">
            </div>
          <!--  <div class="form-group">
                <label>Mô tả (EN)</label>
                <textarea id="mota_en" name="mota_en" rows="10"
                          cols="80"><?= !empty($mota_en) ? SHOW_text($mota_en) : '' ?></textarea>
            </div>-->
        </div>
    </div>
</div>
<?php


?>
<div class="box p10">
    <div class="form-group" style="display: none">
        <label>Seo name <a data-tooltip="Đường dẫn chuẩn bao gồm các ký tự [a-zA-Z0-9-]."> </a></label>
        <input type="text" class="form-control" name="seo_name" id="seo_name"
               value="<?= floor(time() / rand(1, 15)) ?>">
        <label class="noweight noweight-top checkbox-mini">
            <input class="minimal auto_get_link"
                   type="checkbox" <?= empty($id) || $id == 0 ? 'checked="checked"' : '' ?>> Lấy đường dẫn tự động
        </label>
    </div>
    <div class="form-group">
        <label for="exampleInputFile">File Dowload: Chỉ upload 1 file <?= implode(', ', $array_typefile) ?> dung lượng
            file tối
            đa 10MB.</label>
        <input name="dowload" type="file" class="form-control" id="exampleInputFile">
        <?= !empty($dowload) ? '<p style="margin: 7px 0;"><a href="' . $fullpath . "/datafiles/files/" . $dowload . '" download>' . $dowload . '</a></p>' : '' ?>
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
        <label>Số thứ tự</label>
        <input type="text" class="form-control" name="catasort" id="catasort" value="<?= SHOW_text($catasort) ?>"
               onkeyup="SetCurrency(this)">
    </div>
    <div class="form-group">
        <label class="mr-20">
            <input type="radio" name="showhi" class="minimal"
                   value="1" <?= $id > 0 ? LAY_checked($showhi, 1) : 'checked' ?>> Hiện thị
        </label>
        <label>
            <input type="radio" name="showhi" class="minimal" value="2" <?= $id > 0 ? LAY_checked($showhi, 2) : '' ?>>
            Ẩn
        </label>
    </div>
</div>
