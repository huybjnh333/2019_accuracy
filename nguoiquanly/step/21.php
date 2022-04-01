

<input type="hidden" name="anh_sp" value="<?=$thongtin_step['size_img']  ?>">
<div class="nav-tabs-custom">
  <?php include _source."lang.php" ?>
  <div class="tab-content">
    <div class="tab-pane active" id="tab_1">
      <div class="form-group">
        <label>Tiêu đề</label>
        <input type="text" class="form-control" value="<?=!empty($tenbaiviet_vi) ? SHOW_text($tenbaiviet_vi) : ''?>" name="tenbaiviet_vi" id="tenbaiviet_vi">
      </div>
      <div class="form-group">
        <label>Mô tả ngắn</label>
        <textarea id="mota_vi" name="mota_vi" rows="10" cols="50"><?=!empty($mota_vi) ? SHOW_text($mota_vi) : ''?></textarea>
      </div>
      <div class="form-group">
        <label>Nội dung</label>
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
    <?php if($lang_nb2){ ?>
    <div class="tab-pane" id="tab_2">
      <div class="form-group">
        <label>Tiêu đề</label>
        <input type="text" class="form-control" value="<?=!empty($tenbaiviet_en) ? SHOW_text($tenbaiviet_en) : ''?>" name="tenbaiviet_en" id="tenbaiviet_en">
      </div>
      <div class="form-group">
        <label>Mô tả ngắn (<?=_lang_nb2_key ?>)</label>
        <textarea id="mota_en" name="mota_en" rows="10" cols="50"><?=!empty($mota_en) ? SHOW_text($mota_en) : ''?></textarea>
      </div>
      <div class="form-group">
        <label>Mô tả (<?=_lang_nb2_key ?>)</label>
        <textarea id="noidung_en" name="noidung_en" rows="10" cols="80"><?=!empty($noidung_en) ? SHOW_text($noidung_en) : ''?></textarea>
      </div>
      <div class="form-group">
        <label>Seo Title (<?=_lang_nb2_key ?>)</label>
        <input type="text" class="form-control" name="seo_title_en" value="<?=!empty($seo_title_en) ? Show_text($seo_title_en) : "" ?>">
      </div>

      <div class="form-group">
        <label>Seo Description (<?=_lang_nb2_key ?>)</label>
        <input type="text" class="form-control" name="seo_description_en" value="<?=!empty($seo_description_en) ? Show_text($seo_description_en) : "" ?>">
      </div>

      <div class="form-group">
        <label>Seo keywords (<?=_lang_nb2_key ?>)</label>
        <input type="text" class="form-control" name="seo_keywords_en" value="<?=!empty($seo_keywords_en) ? Show_text($seo_keywords_en) : "" ?>">
      </div>
    </div>
    <?php } ?>
    <?php if($lang_nb3){ ?>
    <div class="tab-pane" id="tab_3">
      <div class="form-group">
        <label>Tên <?=getTypeTitle($_GET['step'])?> (<?=_lang_nb3_key ?>)</label>
        <input type="text" class="form-control" value="<?=!empty($tenbaiviet_cn) ? SHOW_text($tenbaiviet_cn) : ''?>" name="tenbaiviet_cn" id="tenbaiviet_cn">
      </div>

      <div class="form-group">
        <label>Mô tả (<?=_lang_nb3_key ?>)</label>
        <textarea id="mota_cn" name="mota_cn" rows="10" cols="80"><?=!empty($mota_cn) ? SHOW_text($mota_cn) : ''?></textarea>
      </div>
      <?php if(CHECK_key_setting("noi-dung-san-pham")){ ?>
      <div class="form-group">
        <label>Nội dung (<?=_lang_nb3_key ?>)</label>
        <textarea id="noidung_cn" name="noidung_cn" rows="10" cols="80"><?=!empty($noidung_cn) ? SHOW_text($noidung_cn) : ''?></textarea>
      </div>
      <?php } ?>

      <div class="form-group">
        <label>Seo Title (<?=_lang_nb3_key ?>)</label>
        <input type="text" class="form-control" name="seo_title_cn" value="<?=!empty($seo_title_cn) ? Show_text($seo_title_cn) : "" ?>">
      </div>

      <div class="form-group">
        <label>Seo Description (<?=_lang_nb3_key ?>)</label>
        <input type="text" class="form-control" name="seo_description_cn" value="<?=!empty($seo_description_cn) ? Show_text($seo_description_cn) : "" ?>">
      </div>

      <div class="form-group">
        <label>Seo keywords (<?=_lang_nb3_key ?>)</label>
        <input type="text" class="form-control" name="seo_keywords_cn" value="<?=!empty($seo_keywords_cn) ? Show_text($seo_keywords_cn) : "" ?>">
      </div>
    </div>
    <?php } ?>
  </div>
</div>
<div class="box p10">
  <div class="form-group">
    <label>Mã BĐS</label>
    <input type="text" class="form-control" name="p1" value="<?=!empty($p1) ? Show_text($p1) : "" ?>">
  </div>
  <div class="form-group">
    <label>Giá bán</label>
    <input type="text" class="form-control " name="giatien" value="<?=!empty($giatien) ? Show_text($giatien) : "0" ?>" onkeyup="SetCurrency(this)">
  </div>
  <div class="form-group">
    <label>Giá/M2</label>
    <input type="text" class="form-control " name="giakm" value="<?=!empty($giakm) ? Show_text($giakm) : "0" ?>" onkeyup="SetCurrency(this)">
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

  <div class="form-group">
    <label>Nằm trong</label>
    <?=LAY_chude($id_parent, $step , 'id_parent', 'form-control', 0, $id_step, 0, 'false', 0) ?>
  </div>
</div>
<div class="box p10">
  <div class="form-group">
    <label>Tỉnh/Thành phố</label>
    <select name="num_1" class="form-control" onchange="GET_diadiem(this, '.cls_diadiem2', 'Chọn Quận/Huyện')">
      <option value="0">Chọn Tỉnh/Thành phố</option>
      <?php 
        $diadiem = LAY_diadiem();
        foreach ($diadiem as $val_1) { 
          if($val_1['id_parent'] != 0) continue;
      ?>
      <option value="<?=$val_1['id'] ?>" <?=LAY_selected(@$num_1, $val_1['id']) ?>><?=$val_1['tenbaiviet_vi'] ?></option>
      <?php } ?>
    </select>
  </div>
  <div class="form-group">
    <label>Quận/Huyện </label>
    <select name="num_2" class="form-control cls_diadiem2" onchange="GET_diadiem(this, '.cls_diadiem3', 'Chọn Phường/Xã')">
      <option value="0">Chọn Quận/Huyện</option>
      <?php
        foreach ($diadiem as $val_2) { 
          if($val_2['id_parent'] != @$num_1) continue;
      ?>
      <option value="<?=$val_2['id'] ?>" <?=LAY_selected(@$num_2, $val_2['id']) ?>><?=$val_2['tenbaiviet_vi'] ?></option>
      <?php } ?>
    </select>
  </div>
  <div class="form-group">
    <label>Phường/Xã</label>
    <select name="num_3" class="form-control cls_diadiem3">
      <option value="0">Chọn Phường/Xã</option>
      <?php
        foreach ($diadiem as $val_3) { 
          if($val_3['id_parent'] != @$num_2) continue;
      ?>
      <option value="<?=$val_3['id'] ?>" <?=LAY_selected(@$num_3, $val_3['id']) ?>><?=$val_3['tenbaiviet_vi'] ?></option>
      <?php } ?>
    </select>
  </div>
</div>
<div class="box p10">
  <div class="form-group">
    <label>Tọa độ Google map</label>
    <input type="text" class="form-control " name="mt_2_vi" value="<?=!empty($mt_2_vi) ? Show_text($mt_2_vi) : "" ?>" >
  </div>
  
  <?php 
    $tinhnang   = LAY_bv_tinhnang($step);
    $detail_vi  = @explode(",", $detail_vi);
    foreach ($tinhnang as $value) {
      if($value['id_parent'] != 0) continue;
  ?>
  <div class="form-group">
    <label><?=$value['tenbaiviet_vi'] ?></label>
    <select name="detail_vi[]" class="form-control">
      <option value="0"><?=$value['tenbaiviet_vi'] ?></option>
      <?php 
        foreach ($tinhnang as $val2) {  
          if($val2['id_parent'] != $value['id']) continue;
      ?>
      <option value="<?=$val2['id'] ?>" <?=in_array($val2['id'], $detail_vi) ? "selected" : "" ?>><?=$val2['tenbaiviet_vi'] ?></option>
      <?php } ?>
    </select>
  </div>
  <?php } ?>
</div>
<div class="box p10">
  <div class="form-group">
    <label>Ngày đăng</label>
    <div class="input-group date">
      <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
      </div>
      <input name="ngaydang" type="text" class="form-control pull-right" id="datepicker" value='<?=$ngaydang?>'>
    </div>
    <label class="noweight noweight-top checkbox-mini">
      <input class="minimal auto_get_load_time" data1="#datepicker" data="<?=date('d/m/Y') ?>" type="checkbox"> Lấy ngày hiện tại
    </label>
  </div>
  <div class="form-group">
    <label>Ngày cập nhật</label>
    <div class="input-group date">
      <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
      </div>
      <input name="capnhat" type="text" class="form-control pull-right" id="datepicker2" value='<?=$capnhat?>'>
    </div>
    <label class="noweight noweight-top checkbox-mini">
      <input class="minimal auto_get_load_time" data1="#datepicker2" data="<?=date('d/m/Y') ?>" type="checkbox"> Lấy ngày hiện tại
    </label>
    <script>
      $('.auto_get_load_time').on('ifChecked', function(event) {
          $($(this).attr("data1")).val($(this).attr("data"));
      });
    </script>
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
<script>
  function GET_diadiem(obj, cls, text){
    $.ajax({
      type: "POST",
      url: "index.php",
      data: {'action_s': 'get_diadiem', "id": $(obj).val(), "text": text },
      success: function(data) {
         $(cls).html(data);
      }
    });
  }
</script>