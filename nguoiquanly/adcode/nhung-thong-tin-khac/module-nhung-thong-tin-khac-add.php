<?php
  $table = '#_seo_name';
  $id    = isset($_GET['edit']) && is_numeric($_GET['edit']) ? SHOW_text($_GET['edit']) : 0;
  if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      foreach ($_POST as $key => $value) {
        ${$key}           = $value;
      }
    }
  if(!empty($_POST))
    {
      $data                   = array();
      $data['tenbaiviet_vi']  = @$tenbaiviet_vi;
      $data['tenbaiviet_en']  = @$tenbaiviet_en;
      $data['tenbaiviet_cn']  = @$tenbaiviet_cn;
      $data['p1_vi']          = @$p1_vi;
      $data['p1_en']          = @$p1_en;
      $data['p1_cn']          = @$p1_cn;
      $data['noidung_vi']     = @$noidung_vi;
      $data['noidung_en']     = @$noidung_en;
      $data['noidung_cn']     = @$noidung_cn;
      $data['lien_ket']       = @$lien_ket;

      $hinhanh            = UPLOAD_image("icon", "../".$duongdantin."/", time());
      if($hinhanh != false)
        {
          $data['icon']   = $hinhanh;
          TAO_anhthumb("../".$duongdantin."/".$hinhanh, "../".$duongdantin."/thumb_".$hinhanh, 400, 256); 
          if($id > 0){
            //xoa anh
            $sql_thongtin = DB_que("SELECT * FROM `$table` WHERE `id`='".$id."' LIMIT 1");
            @unlink("../".mysql_result($sql_thongtin, 0, "duongdantin")."/".mysql_result($sql_thongtin, 0, "icon"));
            @unlink("../".mysql_result($sql_thongtin, 0, "duongdantin")."/thumb_".mysql_result($sql_thongtin, 0, "icon"));
            //end
          }
        }
        if($id == 0){
          ACTION_db($data, $table , 'add', NULL, NULL);
          $_SESSION['show_message_on'] =  "Thêm thông tin khác thành công!";
        }else{
          ACTION_db($data, $table, 'update', NULL, "`id` = '".$id."'");
          $_SESSION['show_message_on'] =  "Cập nhật thông tin khác thành công!";
        }
      
    }

  if($id > 0)
  {
    $sql_se       = DB_que("SELECT * FROM `$table` WHERE `id`='".$id."' LIMIT 1");
    $sql_se       = mysql_fetch_array($sql_se);
    foreach ($sql_se as $key => $value) {
      ${$key} = SHOW_text($value);
    }


    if($icon != '') {
      $icon   = "<img src='../$duongdantin/thumb_$icon' width='255' height='auto' style='display:block'>";
    }
      
  }
?>

<section class="content-header">
    <h1>Quản lý thông tin khác</h1> 
    <ol class="breadcrumb">
        <li><a href="<?=$fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Quản lý thông tin khác</li>
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
                  <i class="fa fa-pencil-square-o"></i> <?=$id > 0 ? 'Sửa' : 'Thêm' ?> thông tin khác
              </h2>
              <h3 class="box-title box-title-td pull-right">
                <button onclick="return checkSubmit()" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
                <a href="<?=$url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
              </h3>
          </div>
          <div class="nav-tabs-custom">
            <?php include _source."lang.php" ?>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div class="form-group">
                  <label>Tên bài viết</label>
                  <input type="text" class="form-control" value="<?=!empty($tenbaiviet_vi) ? SHOW_text($tenbaiviet_vi) : ''?>" name="tenbaiviet_vi" id="tenbaiviet_vi">
                </div>

                <div class="form-group">
                  <label>Mô tả</label>
                  <input type="text" class="form-control" value="<?=!empty($p1_vi) ? SHOW_text($p1_vi) : ''?>" name="p1_vi" id="p1_vi">
                </div>

                <div class="form-group">
                  <label>Nội dung bài viết</label>
                  <textarea id="noidung_vi" name="noidung_vi" rows="10" cols="80"><?=!empty($noidung_vi) ? SHOW_text($noidung_vi) : ''?></textarea>
                </div>
              </div>
              <?php if($lang_nb2){ ?>
              <div class="tab-pane" id="tab_2">
                <div class="form-group">
                  <label>Tên bài viết (<?=_lang_nb2_key ?>)</label>
                  <input type="text" class="form-control" value="<?=!empty($tenbaiviet_en) ? SHOW_text($tenbaiviet_en) : ''?>" name="tenbaiviet_en" id="tenbaiviet_en">
                </div>

                <div class="form-group">
                  <label>Mô tả (<?=_lang_nb2_key ?>)</label>
                  <input type="text" class="form-control" value="<?=!empty($p1_en) ? SHOW_text($p1_en) : ''?>" name="p1_en" id="p1_en">
                </div>

                <div class="form-group">
                  <label>Nội dung bài viết (<?=_lang_nb2_key ?>)</label>
                  <textarea id="noidung_en" name="noidung_en" rows="10" cols="80"><?=!empty($noidung_en) ? SHOW_text($noidung_en) : ''?></textarea>
                </div>
              </div>
              <?php } ?>
              <?php if($lang_nb3){ ?>
              <div class="tab-pane" id="tab_3">
                <div class="form-group">
                  <label>Tên bài viết (<?=_lang_nb3_key ?>)</label>
                  <input type="text" class="form-control" value="<?=!empty($tenbaiviet_cn) ? SHOW_text($tenbaiviet_cn) : ''?>" name="tenbaiviet_cn" id="tenbaiviet_cn">
                </div>

                <div class="form-group">
                  <label>Mô tả (<?=_lang_nb3_key ?>)</label>
                  <input type="text" class="form-control" value="<?=!empty($p1_cn) ? SHOW_text($p1_cn) : ''?>" name="p1_cn" id="p1_cn">
                </div>

                <div class="form-group">
                  <label>Nội dung bài viết (<?=_lang_nb3_key ?>)</label>
                  <textarea id="noidung_cn" name="noidung_cn" rows="10" cols="80"><?=!empty($noidung_cn) ? SHOW_text($noidung_cn) : ''?></textarea>
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
            <label for="exampleInputFile">Hình đại diện</label>
            <?=($id > 0) ? $icon : '' ?>
            <input name="icon" type="file" class="form-control" id="exampleInputFile">
          </div>
          <div class="form-group">
            <label>Liên kết <a data-tooltip="Nếu Link đến URL của Web khác thì phải có http:// ở đầu."> </a></label>
            <input type="text" class="form-control" name="lien_ket" id="lien_ket" value="<?=($id > 0) ? SHOW_text($lien_ket) : ''?>"> 
          </div>
        </div>
      </section>
    </div>
  </section>
  <div class="box-header mb-60">
    <h3 class="box-title box-title-td pull-right">
      <button onclick="return checkSubmit()" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
      <a href="<?=$url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
    </h3>
  </div>
</form>

<script>
  function checkSubmit(){
    if($("#tenbaiviet_vi").val() == '')
    {
      alert("Hãy nhập tên bài viết!");
      $("#tenbaiviet_vi").focus();
      return false;
    }
    document.getElementById("form_submit").submit();
  }
</script>
<?php $ckeditor->replace('noidung_vi'); ?>
<?php if($lang_nb2) { $ckeditor->replace('noidung_en'); } ?>
<?php if($lang_nb3) { $ckeditor->replace('noidung_cn'); } ?>