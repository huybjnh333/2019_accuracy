 -->
<?php 
  $id_parent = isset($_GET['edit']) ? $_GET['edit'] : 0;
  $id        = isset($_GET['id']) ? $_GET['id'] : 0;
  $loai      = isset($_GET['loai']) ? $_GET['loai'] : 0;
  if($loai == 0)
    $loai    = 1;

  if($id != 0) {
    $sql_se = DB_que("SELECT * FROM `#_form_danhmuc` WHERE `id`='".$id."' LIMIT 1");
    $sql_se = mysql_fetch_array($sql_se);
    foreach ($sql_se as $key => $value) {
      ${$key} = SHOW_text($value);
    }
  }
?>
<!--  -->
<div class="dv-load-1">
  <a onclick="CLOSE_opp()" class="cur">x</a>
  <h3>Tạo Input</h3>
  <form id="form_ajax_1" name="form_ajax_1" method="post" action="">
    <div class="dv-gr">
      <p>Tiêu đề</p>
      <input type="text" name="tenbaiviet_vi" value="<?=!empty($tenbaiviet_vi) ? $tenbaiviet_vi : '' ?>" >  
      </div>
      <div class="dv-gr">
      <p>Mô tả</p>
      <input type="text" name="mota_vi" value="<?=!empty($mota_vi) ? $mota_vi : '' ?>" >  
      <label class="lb_checked"><input type="checkbox" name="active" <?=!empty($active) && $active == 1 ? 'checked="checked"' : '' ?>> Điều kiện (*)</label>
    </div>
    <div class="dv-gr">
      <button type="button" onclick="SEND_opp()">Cập nhật</button>
      <button type="button" onclick="CLOSE_opp()">Hủy bỏ</button>
    </div>
    <input type="hidden" name="ac_form_loai" class="id_loai_js" value="<?=$loai ?>">
    <input type="hidden" name="id_parent" value="<?=$id_parent ?>">
    <input type="hidden" name="id" value="<?=$id ?>">
  </form>
</div>
<!--  -->
<!--  -->
<div class="dv-load-2">
  <a onclick="CLOSE_opp()" class="cur">x</a>
  <h3>Tạo TextArea</h3>
  <form id="form_ajax_2" name="form_ajax_2" method="post" action="">
    <div class="dv-gr">
      <p>Tiêu đề</p>
      <input type="text" name="tenbaiviet_vi" value="<?=!empty($tenbaiviet_vi) ? $tenbaiviet_vi : '' ?>" >  
      </div>
      <div class="dv-gr">
      <p>Mô tả</p>
      <textarea name="mota_vi"><?=!empty($mota_vi) ? $mota_vi : '' ?></textarea>
    </div>
    <div class="dv-gr">
      <button type="button" onclick="SEND_opp()">Cập nhật</button>
      <button type="button" onclick="CLOSE_opp()">Hủy bỏ</button>
    </div>
    <input type="hidden" name="ac_form_loai" class="id_loai_js" value="<?=$loai ?>">
    <input type="hidden" name="id_parent" value="<?=$id_parent ?>">
    <input type="hidden" name="id" value="<?=$id ?>">
  </form>
</div>
<!--  -->
<!--  -->
<div class="dv-load-3">
  <a onclick="CLOSE_opp()" class="cur">x</a>
  <h3>Tạo Select</h3>
  <form id="form_ajax_3" name="form_ajax_3" method="post" action="">
    <div class="dv-gr">
      <p>Tiêu đề</p>
      <input type="text" name="tenbaiviet_vi" value="<?=!empty($tenbaiviet_vi) ? $tenbaiviet_vi : '' ?>" >  
      </div>
      <div class="dv-gr">
      <p>Mô tả</p>
      <input type="text" name="mota_vi" value="<?=!empty($mota_vi) ? $mota_vi : '' ?>" > 
      <a class="cur them_option" onclick="ADD_option()">Thêm option</a>
      <div class="dv-option">
        <?php 
          if($id != 0) {
            $sql_se = DB_que("SELECT * FROM `#_form_danhmuc` WHERE `id_parent`='".$id."' ORDER BY `catasort` ASC");
            while ($r = mysql_fetch_assoc($sql_se)) {
              echo '<input type="text" name="option[]" value="'.$r['tenbaiviet_vi'].'" placeholder="Tiêu đề các option">';
            }
          }
        ?>
        <input type="text" name="option[]" value="" placeholder="Tiêu đề các option">
        <input type="text" name="option[]" value="" placeholder="Tiêu đề các option">
        <input type="text" name="option[]" value="" placeholder="Tiêu đề các option">
        <input type="text" name="option[]" value="" placeholder="Tiêu đề các option">
      </div>
    </div>
    <div class="dv-gr">
      <button type="button" onclick="SEND_opp()">Cập nhật</button>
      <button type="button" onclick="CLOSE_opp()">Hủy bỏ</button>
    </div>
    <input type="hidden" name="ac_form_loai" class="id_loai_js" value="<?=$loai ?>">
    <input type="hidden" name="id_parent" value="<?=$id_parent ?>">
    <input type="hidden" name="id" value="<?=$id ?>">
  </form>
</div>
<!--  -->
<!--  -->
<div class="dv-load-4">
  <a onclick="CLOSE_opp()" class="cur">x</a>
  <h3>Tạo Checkbox</h3>
  <form id="form_ajax_4" name="form_ajax_4" method="post" action="">
    <div class="dv-gr">
      <p>Tiêu đề</p>
      <input type="text" name="tenbaiviet_vi" value="<?=!empty($tenbaiviet_vi) ? $tenbaiviet_vi : '' ?>" >  
      </div>
      <div class="dv-gr">
      <!-- <p>Mô tả</p> -->
      <!-- <input type="text" name="mota_vi" value="<?=!empty($mota_vi) ? $mota_vi : '' ?>" >  -->
      <a class="cur them_option" onclick="ADD_option()">Thêm checkbox</a>
      <div class="dv-option">
        <?php 
          if($id != 0) {
            $sql_se = DB_que("SELECT * FROM `#_form_danhmuc` WHERE `id_parent`='".$id."' ORDER BY `catasort` ASC");
            while ($r = mysql_fetch_assoc($sql_se)) {
              echo '<input type="text" name="option[]" value="'.$r['tenbaiviet_vi'].'" placeholder="Tiêu đề các option">';
            }
          }
        ?>
        <input type="text" name="option[]" value="" placeholder="Tiêu đề các checkbox">
        <input type="text" name="option[]" value="" placeholder="Tiêu đề các checkbox">
        <input type="text" name="option[]" value="" placeholder="Tiêu đề các checkbox">
        <input type="text" name="option[]" value="" placeholder="Tiêu đề các checkbox">
      </div>
    </div>
    <div class="dv-gr">
      <button type="button" onclick="SEND_opp()">Cập nhật</button>
      <button type="button" onclick="CLOSE_opp()">Hủy bỏ</button>
    </div>
    <input type="hidden" name="ac_form_loai" class="id_loai_js" value="<?=$loai ?>">
    <input type="hidden" name="id_parent" value="<?=$id_parent ?>">
    <input type="hidden" name="id" value="<?=$id ?>">
  </form>
</div>
<!--  -->
<!--  -->
<div class="dv-load-5">
  <a onclick="CLOSE_opp()" class="cur">x</a>
  <h3>Tạo Radio</h3>
  <form id="form_ajax_5" name="form_ajax_5" method="post" action="">
    <div class="dv-gr">
      <p>Tiêu đề</p>
      <input type="text" name="tenbaiviet_vi" value="<?=!empty($tenbaiviet_vi) ? $tenbaiviet_vi : '' ?>" >  
      </div>
      <div class="dv-gr">
      <!-- <p>Mô tả</p> -->
      <!-- <input type="text" name="mota_vi" value="<?=!empty($mota_vi) ? $mota_vi : '' ?>" >  -->
      <a class="cur them_option" onclick="ADD_option()">Thêm radio</a>
      <div class="dv-option">
        <?php 
          if($id != 0) {
            $sql_se = DB_que("SELECT * FROM `#_form_danhmuc` WHERE `id_parent`='".$id."' ORDER BY `catasort` ASC");
            while ($r = mysql_fetch_assoc($sql_se)) {
              echo '<input type="text" name="option[]" value="'.$r['tenbaiviet_vi'].'" placeholder="Tiêu đề các option">';
            }
          }
        ?>
        <input type="text" name="option[]" value="" placeholder="Tiêu đề các radio">
        <input type="text" name="option[]" value="" placeholder="Tiêu đề các radio">
        <input type="text" name="option[]" value="" placeholder="Tiêu đề các radio">
        <input type="text" name="option[]" value="" placeholder="Tiêu đề các radio">
      </div>
    </div>
    <div class="dv-gr">
      <button type="button" onclick="SEND_opp()">Cập nhật</button>
      <button type="button" onclick="CLOSE_opp()">Hủy bỏ</button>
    </div>
    <input type="hidden" name="ac_form_loai" class="id_loai_js" value="<?=$loai ?>">
    <input type="hidden" name="id_parent" value="<?=$id_parent ?>">
    <input type="hidden" name="id" value="<?=$id ?>">
  </form>
</div>
<!--  -->