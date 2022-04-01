<?php
  $table = '#_menu';
  $id    = isset($_GET['edit']) && is_numeric($_GET['edit']) ? $_GET['edit'] : 0;
  if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      foreach ($_POST as $key => $value) {
        ${$key}           = $value;
      }
      $catasort         = str_replace(".", "", $_REQUEST['catasort']);
      $showhi           = isset($_POST['showhi']) ? 1 : 0;
      $cua_so_moi       = isset($_POST['cua_so_moi']) ? 1 : 0;
       
    }
  if(!empty($_POST))
    {
      $data                   = array();
      $data['catasort']       = @$catasort;
      $data['showhi']         = @$showhi;
      $data['cua_so_moi']     = @$cua_so_moi;
      $data['id_parent']      = @$id_parent;
      $data['tenbaiviet_vi']  = @$tenbaiviet_vi;
      $data['tenbaiviet_en']  = @$tenbaiviet_en;
      $data['tenbaiviet_cn']  = @$tenbaiviet_cn;
      $data['seo_name']       = @$seo_name;
      $data['step']           = @$step;
      $data['danhmuc']        = @$danhmuc;
      $data['kieu_hien_thi']  = @$kieu_hien_thi;
      $data['kieu_chon']      = @$kieu_chon;
      
      if($id == 0){
        $id = ACTION_db($data, $table , 'add', NULL,NULL);
        $_SESSION['show_message_on'] =  "Thêm menu thành công!";
        LOCATION_js($url_page."&edit=".$id);
        exit();
      }else{
        ACTION_db($data, $table, 'update', NULL, "`id` = '".$id."'");
        $_SESSION['show_message_on'] =  "Cập nhật menu thành công!";
      }
    }

  if($id > 0)
    {
      $sql_se           = DB_que("SELECT * FROM `$table` WHERE `id`='".$id."' LIMIT 1");
      $sql_se           = mysql_fetch_array($sql_se);
      foreach ($sql_se as $key => $value) {
        ${$key} = SHOW_text($value);
      }
      $catasort         = number_format($catasort,0,',','.');
    }
  else 
    {
      $catasort   = layCatasort($table);
      $catasort   = number_format(SHOW_text($catasort),0,',','.');
    }
?>
 
<section class="content-header">
    <h1>Thiết lập menu</h1> 
    <ol class="breadcrumb">
        <li><a href="<?=$fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Thiết lập menu</li>
    </ol>
</section>
<form id="form_submit" name="form_submit" action="" method="post"  enctype='multipart/form-data'>
  <section class="content form_create">
    <div class="row">
      <section class="col-lg-12">
        <?php include _source."mesages.php"; ?>
        <div class="box">
          <div class="box-header with-border">
              <h2 class="h2_title">
                  <i class="fa fa-pencil-square-o"></i> <?=$id > 0 ? 'Sửa' : 'Thêm' ?> menu
              </h2>
              <h3 class="box-title box-title-td pull-right">
                <button onclick="return checkSubmit()" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
                <a href="<?=$url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                <a href="<?=$url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
                
              </h3>
          </div>
          <div class="nav-tabs-custom">
            <?php include _source."lang.php" ?>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div class="form-group">
                  <label>Tên menu</label>
                  <input type="text" class="form-control" value="<?=!empty($tenbaiviet_vi) ? SHOW_text($tenbaiviet_vi) : ''?>" name="tenbaiviet_vi" id="tenbaiviet_vi">
                </div>
              </div>
              <?php if($lang_nb2){ ?>
              <div class="tab-pane" id="tab_2">
                <div class="form-group">
                  <label>Tên menu (<?=_lang_nb2_key ?>)</label>
                  <input type="text" class="form-control" value="<?=!empty($tenbaiviet_en) ? SHOW_text($tenbaiviet_en) : ''?>" name="tenbaiviet_en" id="tenbaiviet_en">
                </div>
              </div>
              <?php } ?>
              <?php if($lang_nb3){ ?>
              <div class="tab-pane" id="tab_3">
                <div class="form-group">
                  <label>Tên menu (<?=_lang_nb3_key ?>)</label>
                  <input type="text" class="form-control" value="<?=!empty($tenbaiviet_cn) ? SHOW_text($tenbaiviet_cn) : ''?>" name="tenbaiviet_cn" id="tenbaiviet_cn">
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </section>
      <section class="col-lg-12">
        <div class="box p10">
          <div class="form-group">
            <label>Loại menu</label>
            <?=LAY_menu(@$id_parent, 'id_parent', 'form-control', 0, $id_step, $id, 'true') ?>
          </div>
          <div class="form-group">
            <label>Số thứ tự</label>
            <input type="text" class="form-control" name="catasort" id="catasort" value="<?=SHOW_text($catasort)?>" onkeyup="SetCurrency(this)">
          </div>
          <div class="form-group">
            <label class="mr-20 checkbox-mini noweight">
              <input class="minimal auto_menu_lienket" type="radio" name="kieu_chon" value="0" <?=!isset($kieu_chon) || $kieu_chon == 0 ? 'checked="checked"' : '' ?>> Nhập liên kết
            </label>
            <label class="mr-20 checkbox-mini noweight">
              <input class="minimal auto_menu_module" type="radio" name="kieu_chon" value="1" <?=isset($kieu_chon) && $kieu_chon == 1 ? 'checked="checked"' : '' ?>> Chọn module
            </label>
          </div>

          <div class="form-group form-group-none nhom_lienket">
            <label>Liên kết <a data-tooltip="Nếu Link đến URL của Web khác thì phải có http:// ở đầu."> </a></label>
            <input type="text" class="form-control" name="seo_name" id="seo_name" value="<?=!empty($seo_name) ? SHOW_text($seo_name) : ''?>">
          </div>
          <div class="form-group form-group-none nhom_module_menu">
            <label>Module <a data-tooltip="Lấy liên kết theo module chọn."> </a></label>
            <select name="step" class="form-control" onchange="LOAD_danhmuc_mn(this)">
              <option value="0">Chọn module</option>
              <?php 
                $loaibanner = DB_que('SELECT * FROM `#_step` WHERE `showhi` = 1 ORDER BY `catasort` ASC');
                while($r    = mysql_fetch_array($loaibanner))
                  {
                    echo '<option value="'.$r['id'].'" '.LAY_selected($r['id'], $step).'>'.$r['tenbaiviet_vi'].'</option>';
                  }
              ?>
            </select>
          </div>
          <div class="form-group form-group-none nhom_module_menu">
            <label>Danh mục <a data-tooltip="Lấy liên kết theo danh mục chọn."> </a></label>
            <select name="danhmuc" class="form-control form-control-dm-menu" >
              <option value="0">Chọn danh mục</option>
              <?php 
                if(!empty($step) && $step != 0){
                    $chude_arr  = DB_fet("*","#_danhmuc", "`showhi` = '1' AND `step` = ".$step."", "`catasort` ASC","", "arr");
                    foreach ($chude_arr as $row_1)
                          {   
                            if($row_1['id_parent'] != 0) continue;
                              echo  '<option value="'.$row_1['id'].'" '.LAY_selected($row_1['id'], @$danhmuc).'>'.$row_1['tenbaiviet_vi'].'</option> ';
                              foreach ($chude_arr as $row_2) 
                              { 
                                if($row_2['id_parent'] != $row_1['id']) continue; 
                                  echo  '<option value="'.$row_2['id'].'" '.LAY_selected($row_2['id'], @$danhmuc).'>╚═►'.$row_2['tenbaiviet_vi'].'</option> ';
                                  foreach ($chude_arr as $row_3)
                                  { 
                                    if($row_3['id_parent'] != $row_2['id']) continue;
                                      echo  '<option value="'.$row_3['id'].'" '.LAY_selected($row_3['id'], @$danhmuc).'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;╙─►'.$row_3['tenbaiviet_vi'].'</option> ';
                                      foreach ($chude_arr as $row_4) 
                                      { 
                                        if($row_4['id_parent'] != $row_3['id']) continue;
                                      echo  '<option value="'.$row_4['id'].'" '.LAY_selected($row_4['id'], @$danhmuc).'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;╙─►'.$row_4['tenbaiviet_vi'].'</option> ';

                                }
                            }
                        }
                    }
                  }
                else if(!empty($step) && $step != -1){
                    $baiviet_arr  = DB_fet("*","#_baiviet", "`showhi` = '1' AND `step` = 0", "`catasort` DESC","", "arr");
                    foreach ($baiviet_arr as $row_1)
                      {
                        echo  '<option value="'.$row_1['id'].'" '.LAY_selected($row_1['id'], @$danhmuc).'>'.$row_1['tenbaiviet_vi'].'</option> ';
                      }
                }
              ?>
            </select>
          </div>
          <div class="form-group form-group-none nhom_module_menu">
            <label>Kiểu hiển thị <a data-tooltip="Tư động hiển thị các cấp con của danh mục hoặc danh sách bài viết của danh mục."> </a></label>
            <select name="kieu_hien_thi" class="form-control">
              <option value="0" <?=LAY_selected(0, @$kieu_hien_thi) ?>>Chọn kiểu hiển thị</option>
              <option value="1" <?=LAY_selected(1, @$kieu_hien_thi) ?>>Tự động theo danh mục</option>
              <option value="2" <?=LAY_selected(2, @$kieu_hien_thi) ?>>Tự động theo bài viết</option>
            </select>
          </div>
          <div class="form-group">
            <label class="mr-20 checkbox-mini noweight" style="display: block; margin-bottom: 10px">
              <input type="checkbox" name="cua_so_moi" class="minimal" <?=isset($cua_so_moi) && $cua_so_moi == 1 ? 'checked="checked"' : '' ?>> Hiển thị cửa sổ mới
            </label>
            <label class="mr-20 checkbox-mini noweight">
              <input type="checkbox" name="showhi" class="minimal" <?=isset($showhi) && $showhi == 0 ? '' : 'checked="checked"' ?>> Hiển thị
            </label>
          </div>
        </div>
      </section>
    </div>
  </section>
  <div class="box-header mb-60">
    <h3 class="box-title box-title-td pull-right">
      <button onclick="return checkSubmit()" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
      <a href="<?=$url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
      <a href="<?=$url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
    </h3>
  </div>
</form>

<script>
  function checkSubmit(){
    if($("#tenbaiviet_vi").val() == '')
    {
      alert("Hãy nhập tên menu!");
      $("#tenbaiviet_vi").focus();
      return false;
    }
    // document.getElementById("form_submit").submit();
  }
</script>