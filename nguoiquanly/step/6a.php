<div class="box-body table-responsive no-padding table-danhsach-cont">
  <table class="table table-hover table-danhsach">
    <tbody>
      <tr>
        <th class="w50 text-center">
          <label>
            <input type='checkbox' class='minimal cls_showxoa_all'> Xóa
          </label>
        </th>
        <th class="w80 text-center">STT</th>
        <th>Tiêu đề</th>
        <th class="w100 text-center">Hình ảnh</th>
        <?php
          $album_tieubieu = CHECK_key_setting("album-tieu-bieu");
          if($album_tieubieu){ 
        ?>
        <th class="w100 text-center">Tiêu biểu</th>
        <?php } ?>
        <th class="w90 text-center">Hiển thị</th>
        <th class="w120 text-center">Tác vụ</th>
      </tr>
<?php
  $cl = 0;

  while($rows = mysql_fetch_assoc($sql))
  {
    $ida                = SHOW_text($rows['id']);
    $tenbaiviet_vi      = SHOW_text($rows['tenbaiviet_vi']);
    $tenbaiviet_en      = SHOW_text($rows['tenbaiviet_en']);
    $tenbaiviet_cn      = SHOW_text($rows['tenbaiviet_cn']);
    $icon               = SHOW_text($rows['icon']);
    $catasort           = number_format(SHOW_text($rows['catasort']),0,',','.');
    $id_parent          = SHOW_text($rows['id_parent']);
    $opt                = SHOW_text($rows['opt']);
    $opt1               = SHOW_text($rows['opt1']);
    $opt2               = SHOW_text($rows['opt2']);
    $showhi             = SHOW_text($rows['showhi']);

    $soluonganh_con = 0;
    if(is_array($list_bv_img)){
      foreach ($list_bv_img as $val) {
        if($val['id_parent'] == $ida) $soluonganh_con++;
      }  
    }
    
?>
      <tr>
        <td class="text-center">
          <input name='xoa_gr_arr_<?=$cl?>' type='checkbox' class='minimal cls_showxoa'>
        </td>
        <td class="text-center">
          <input name="idme<?=$cl?>" value="<?=$ida?>" type="hidden">
          <input type="text" class="text-center" name="sortby<?=$cl?>" value="<?=$catasort?>" onkeyup="SetCurrency(this)">
        </td>
        <td>
          <div class="name">
            <input type="text" name="ncata_vi<?=$cl?>" class="cls_emty_name" value="<?=$tenbaiviet_vi?>" placeholder="Tiêu đề (<?=_lang_nb1_key ?>)">
          </div>
          <?php if($lang_nb2){ ?>
          <div class="name" id="en">
            <input type="text" name="ncata_en<?=$cl?>" class="cls_emty_name" value="<?=$tenbaiviet_en ?>" placeholder="Tiêu đề (<?=_lang_nb2_key ?>)">
          </div>
          <?php } ?>
          <?php if($lang_nb3){ ?>
          <div class="name" id="en">
            <input type="text" name="ncata_cn<?=$cl?>" class="cls_emty_name" value="<?=$tenbaiviet_cn ?>" placeholder="Tiêu đề (<?=_lang_nb3_key ?>)">
          </div>
          <?php } ?>
<!--          <p style="margin: 5px 0;"><a href="--><?//=$url_page ?><!--&upload=true&step=--><?//=$step?><!--&id_step=--><?//=$id_step?><!--&edit=--><?//=$ida?><!--" title="Quản lý hình ảnh">[Hình ảnh] [--><?//=$soluonganh_con ?><!--]</a></p>-->
          <p class="p_chude_hienthi"><?=($id_parent == 0) ? '' : LAY_tieude_kietxuat($rows['id_parent'],"#_danhmuc") ?></p>
          <?php if(isset($_SESSION['admin'])){ ?>
          <label>
            <input name='coppy_row<?=$cl?>' type='checkbox' class='minimal'> [Coppy]
          </label>
          <?php } ?>
        </td>
        <td class="text-center">
          <img class='img_show_ds' src='<?=$fullpath."/".$rows['duongdantin']."/thumb_".$icon ?>'>
          <?php if(isset($_SESSION['admin'])){ ?>
          <input type="file" name="upload_<?=$cl?>">
          <input type="hidden" name="anh_sp_<?=$cl?>" value="<?=!empty($thongtin_step['size_img']) && $thongtin_step['size_img'] != '' ? $thongtin_step['size_img'] : '' ?>">
          <?php } ?>
        </td>
        <?php
          if($album_tieubieu){ 
        ?>
        <td class="text-center">
          <div id="cus" class="cus_menu">
            <label><input name='opt_<?=$cl?>' opt type='checkbox' class='minimal' value='1' <?=LAY_checked($opt, 1)?>></label>
          </div>
        </td>
        <?php } ?>
        <td class="text-center">
          <div id="cus" class="cus_menu">
            <label><input type="checkbox" class='minimal' name="showhi_<?=$cl ?>" value="1" <?=(($showhi == 1) ? "checked='checked'" : "" )?> ></label>
            </div>
        </td>
        <td class="text-center">
            <a href="<?=$url_page ?>&step=<?=$step?>&id_step=<?=$id_step?>&edit=<?=$ida?>" title="Cập nhật"><i class="fa fa-pencil-square-o"></i></a>
            <a href="<?=$url_page.'&del=ok&catalogid='.$ida.'&token='.GET_token() ?>&step=<?=$step?>&id_step=<?=$id_step?>" class="do" onclick="return confirm('Bạn thật sự muốn xóa?')"><i class="fa fa-times"></i></a>
        </td>
      </tr>
      <?php
            $cl++;
          }
      ?> 
    </tbody>
  </table>
  <input type='hidden' value='<?=$cl?>' name='maxvalu'>
</div>