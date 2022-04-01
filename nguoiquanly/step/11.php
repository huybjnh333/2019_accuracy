<input type="hidden" name="anh_sp" value="<?=!empty($thongtin_step['size_img']) && $thongtin_step['size_img'] != '' ? $thongtin_step['size_img'] : '' ?>">
<div class="nav-tabs-custom">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab_1" data-toggle="tab"> Tiếng Việt</a></li>
    <?php if($lang_en){ ?>
    <li class="tienganh"><a href="#tab_2" data-toggle="tab">English</a></li>
    <?php } ?>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab_1">
      <div class="form-group">
        <label>Tên tour</label>
        <input type="text" class="form-control" value="<?=!empty($tenbaiviet_vi) ? SHOW_text($tenbaiviet_vi) : ''?>" name="tenbaiviet_vi" id="tenbaiviet_vi">
      </div>
      <div class="form-group">
        <label>Chương trình tour</label>
        <textarea id="mota_vi" name="mota_vi" rows="10" cols="80"><?=!empty($mota_vi) ? SHOW_text($mota_vi) : ''?></textarea>
      </div>
      <div class="form-group">
        <label>Chi tiết tour</label>
        <textarea id="noidung_vi" name="noidung_vi" rows="10" cols="80"><?=!empty($noidung_vi) ? SHOW_text($noidung_vi) : ''?></textarea>
      </div>
      <div class="form-group">
        <label>Seo Title</label>
        <input type="text" class="form-control" name="seo_title_vi" value="<?=!empty($seo_title_vi) ? Show_text($seo_title_vi) : "" ?>">
      </div>

      <div class="form-group">
        <label>Seo Description</label>
        <input type="text" class="form-control" name="seo_description_vi" value="<?=!empty($seo_description_vi) ? Show_text($seo_description_vi) : "" ?>">
      </div>

      <div class="form-group">
        <label>Seo keywords</label>
        <input type="text" class="form-control" name="seo_keywords_vi" value="<?=!empty($seo_keywords_vi) ? Show_text($seo_keywords_vi) : "" ?>">
      </div>
    </div>
    <?php if($lang_en){ ?>
    <div class="tab-pane" id="tab_2">
      <div class="form-group">
        <label>Tên tour (EN)</label>
        <input type="text" class="form-control" value="<?=!empty($tenbaiviet_en) ? SHOW_text($tenbaiviet_en) : ''?>" name="tenbaiviet_en" id="tenbaiviet_en">
      </div>

      <div class="form-group">
        <label>Chương trình tour (EN)</label>
        <textarea id="mota_en" name="mota_en" rows="10" cols="80"><?=!empty($mota_en) ? SHOW_text($mota_en) : ''?></textarea>
      </div>
      <div class="form-group">
        <label>Chi tiết tour (EN)</label>
        <textarea id="noidung_en" name="noidung_en" rows="10" cols="80"><?=!empty($noidung_en) ? SHOW_text($noidung_en) : ''?></textarea>
      </div>

      <div class="form-group">
        <label>Seo Title (EN)</label>
        <input type="text" class="form-control" name="seo_title_en" value="<?=!empty($seo_title_en) ? Show_text($seo_title_en) : "" ?>">
      </div>

      <div class="form-group">
        <label>Seo Description (EN)</label>
        <input type="text" class="form-control" name="seo_description_en" value="<?=!empty($seo_description_en) ? Show_text($seo_description_en) : "" ?>">
      </div>

      <div class="form-group">
        <label>Seo keywords (EN)</label>
        <input type="text" class="form-control" name="seo_keywords_en" value="<?=!empty($seo_keywords_en) ? Show_text($seo_keywords_en) : "" ?>">
      </div>
    </div>
    <?php } ?>
  </div>
</div>
<div class="box p10">
 
  <div class="form-group">
    <label>Mã tours</label>
    <input type="text" class="form-control" name="p1" value="<?=!empty($p1) ? Show_text($p1) : "" ?>">
  </div>
  <div class="form-group">
    <label>Ngày khởi hành</label>
    <div class="input-group date">
      <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
      </div>
      <input name="mt_9_vi" type="text" class="form-control pull-right time_js_date_1" id="datepicker1" value='<?=$mt_9_vi?>'>
    </div>
  </div>
  <div class="form-group">
    <label>Ngày kết thúc</label>
    <div class="input-group date">
      <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
      </div>
      <input name="mt_10_vi" type="text" class="form-control pull-right time_js_date_2" id="datepicker2" value='<?=$mt_10_vi?>'>
    </div>
  </div>
  <div class="form-group">
    <label>Giá tiền</label>
    <input type="text" class="form-control cls_giatien_f" name="giatien" value="<?=!empty($giatien) ? Show_text($giatien) : "0" ?>" onkeyup="SetCurrency(this)">
  </div>
  <div class="form-group">
    <label>Giá khuyến mãi: </label>
    <input type="text" class="form-control cls_giatien_khuyenmai_f" name="giakm" value="<?=!empty($giakm) ? Show_text($giakm) : "0" ?>" onkeyup="SetCurrency(this)">

    <label style=" margin-top: 10px; margin-bottom: 0;"><input type="checkbox" class="minimal" name="opt_km" value="1" <?=LAY_checked(@$opt_km, 1) ?>> Áp dụng khuyến mãi</label>
  </div>
  
  <div class="form-group">
    <label>Seo name <a data-tooltip="Đường dẫn chuẩn bao gồm các ký tự [a-zA-Z0-9-]."> </a></label>
    <input type="text" class="form-control" name="seo_name" id="seo_name" value="<?=!empty($seo_name) ? Show_text($seo_name) : "" ?>">
    <label class="noweight noweight-top checkbox-mini">
      <input class="minimal auto_get_link" type="checkbox" <?=empty($id) || $id == 0 ? 'checked="checked"' : '' ?>> Lấy đường dẫn tự động
    </label>
  </div>
 

  <div class="form-group">
    <label for="exampleInputFile">Hình đại diện <?=!empty($thongtin_step['size_img']) && $thongtin_step['size_img'] != '' ? "(".str_replace("x", "px x ", $thongtin_step['size_img'])."px)" : '' ?></label>
    <?=!empty($icon) ? $icon : '' ?>
    <input name="icon" type="file" class="form-control" id="exampleInputFile">
  </div>
  <!-- <div class="form-group">
    <label for="exampleInputFile2">Hình đại diện hover <?=!empty($thongtin_step['size_img']) && $thongtin_step['size_img'] != '' ? "(".str_replace("x", "px x ", $thongtin_step['size_img'])."px)" : '' ?></label>
    <?=!empty($icon_hover) ? $icon_hover : '' ?>
    <input name="icon_hover" type="file" class="form-control" id="exampleInputFile2">
  </div> -->
  
  <?php 
    $ds_tinhnang = DB_fet("*","#_baiviet_tinhnang","`showhi` = 1 AND `step` = 2 AND `id` <> 107","`catasort` ASC,`id` DESC","","arr");
    foreach ($ds_tinhnang as $value) {
      if($value['id_parent'] != 0) continue;
      if($value['id'] == 87) $name = "mt_1_vi";
      if($value['id'] == 88) $name = "mt_2_vi";
      if($value['id'] == 89) $name = "mt_3_vi";
      if($value['id'] == 90) $name = "mt_4_vi"; 
  ?>
  <div class="form-group">
    <label><?=$value['tenbaiviet_vi'] ?></label>
    <select name="<?=$name ?>"  class="form-control">
      <option value="0">Chọn <?=$value['tenbaiviet_vi'] ?></option>
      <?php 
        foreach ($ds_tinhnang as $val2) {
          if($val2['id_parent'] != $value['id']) continue;
      ?>
      <option value="<?=$val2['id'] ?>" <?=LAY_selected(${$name}, $val2['id']) ?>><?=$val2['tenbaiviet_vi'] ?></option>
      <?php 
        foreach ($ds_tinhnang as $val3) {
          if($val3['id_parent'] != $val2['id']) continue;
      ?>
      <option value="<?=$val3['id'] ?>" <?=LAY_selected(${$name}, $val3['id']) ?>>==> <?=$val3['tenbaiviet_vi'] ?></option>
      <?php } ?>
      <?php } ?>
    </select>
      
  </div>
  <?php } ?>

  <div class="form-group">
    <label>Nơi đến</label>
    <div class="form-group">
      <div class="dv-thuoctour">
      <?php 
        $ds_tinhnang = DB_fet("*","#_baiviet_tinhnang"," `showhi` = 1 AND `step` = 2","`catasort` ASC,`id` DESC","","arr");

        if(!empty($detail_vi)){
          $detail_vi = explode(",", $detail_vi);
        }
        foreach ($ds_tinhnang as $value) {
          if($value['id'] != 107) continue;
      ?>
      <div class="dv-noiden">
          <?php 
            foreach ($ds_tinhnang as $val2) {
              if($val2['id_parent'] != $value['id']) continue;
          ?> 
          <label>
            <input type="checkbox" name="detail_vi[]" value="<?=$val2['id'] ?>" <?=!empty($detail_vi) && in_array($val2['id'], $detail_vi) ? "checked='checked'" : "" ?>> <?=$val2['tenbaiviet_vi'] ?>
          </label>
          <?php 
            foreach ($ds_tinhnang as $val3) {
              if($val3['id_parent'] != $val2['id']) continue;
          ?>
          <label>
            <input type="checkbox" name="detail_vi[]" value="<?=$val3['id'] ?>" <?=!empty($detail_vi) && in_array($val3['id'], $detail_vi) ? "checked='checked'" : "" ?>>==>  <?=$val3['tenbaiviet_vi'] ?>
          </label>
          <?php } ?>
          <?php } ?>
        </select>
          
      </div>
      <?php } ?>
      <div class="clear"></div>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label>Thuộc tour</label>
    <div class="dv-thuoctour">
      <?php
        $ds_danhmuc = DB_fet("*","#_danhmuc"," `showhi` = 1 AND `step` = 2","`catasort` ASC,`id` DESC","","arr");
        if(!empty($detail_en)){
          $detail_en = explode(",", $detail_en);
        }
        foreach ($ds_danhmuc as $value) {
            if($value['id_parent'] != 0) continue;
        ?>
        <div class="dv-noiden">
            <label>
              <input type="checkbox" name="detail_en[]" value="<?=$value['id'] ?>" <?=!empty($detail_en) && in_array($value['id'], $detail_en) ? "checked='checked'" : "" ?>> <b><?=$value['tenbaiviet_vi'] ?></b>
            </label>
            <?php 
              foreach ($ds_danhmuc as $val2) {
                if($val2['id_parent'] != $value['id']) continue;
            ?> 
            <label>
              <input type="checkbox" name="detail_en[]" value="<?=$val2['id'] ?>" <?=!empty($detail_en) && in_array($val2['id'], $detail_en) ? "checked='checked'" : "" ?>>==> <?=$val2['tenbaiviet_vi'] ?>
            </label>
            <?php 
              foreach ($ds_danhmuc as $val3) {
                if($val3['id_parent'] != $val2['id']) continue;
            ?>
            <label>
              <input type="checkbox" name="detail_en[]" value="<?=$val3['id'] ?>" <?=!empty($detail_en) && in_array($val3['id'], $detail_en) ? "checked='checked'" : "" ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;==> <?=$val3['tenbaiviet_vi'] ?>
            </label>
            <?php } ?>
            <?php } ?>
          </select>
            
        </div>
        <?php } ?>
        <div class="clear"></div>
    </div>
  </div>
  <div class="form-group">
    <label>Ngày đăng</label>
    <div class="input-group date">
      <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
      </div>
      <input name="ngaydang" type="text" class="form-control pull-right" id="datepicker" value='<?=$ngaydang?>'>
    </div>
  </div>
 
  <div class="form-group">
    <label>Số thứ tự</label>
    <input type="text" class="form-control" name="catasort" id="catasort" value="<?=SHOW_text($catasort)?>" onkeyup="SetCurrency(this)">
  </div>
  <div class="form-group">
    <label class="mr-20 checkbox-mini">
      <input type="checkbox" name="showhi" class="minimal" <?=isset($showhi) && $showhi == 0 ? '' : 'checked="checked"' ?>> Hiển thị
    </label>
  </div>
</div>
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
  $('#datepicker1').datepicker({
    autoclose: true,
    format: 'dd/mm/yyyy'
  });
  $('#datepicker2').datepicker({
    autoclose: true,
    format: 'dd/mm/yyyy'
  });
  
</script>
