<?php
  $table = '#_form_danhmuc_nd';
  $id    = isset($_GET['edit']) && is_numeric($_GET['edit']) ? SHOW_text($_GET['edit']) : 0;
  
    
  if($id > 0)
    {
      $sql_se             = DB_que("SELECT * FROM `$table` WHERE `id`='".$id."' LIMIT 1");
      $sql_se             = mysql_fetch_assoc($sql_se);
      DB_que("UPDATE `$table` SET `showhi` = 1 WHERE `id`='$id' LIMIT 1");
    }
    else 
    {
      exit();
    }
?>

<section class="content-header">
  <h1>Danh sách liên hệ</h1> 
  <ol class="breadcrumb">
      <li><a href="<?=$fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
      <li class="active">Danh sách liên hệ</li>
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
                <i class="fa fa-pencil-square-o"></i>Danh sách liên hệ
            </h2>
            <h3 class="box-title box-title-td pull-right">
                <a href="<?=$url_page ?>&noi-dung=true" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
            </h3>
          </div>
          <div class="nav-tabs-custom">
            <?php 
              $noidung_vi = unserialize($sql_se['noidung_vi']);
              foreach ($noidung_vi as $key => $value) {
                if($value['nd'] != ''){
            ?>
            <div style="margin: 0 15px 10px; border-bottom: 1px dashed #e6e6e6; padding-bottom: 10px;">
              <p style="margin: 0 0 5px; font-weight: 700;"><?=SHOW_text($value['td']) ?></p>
              <div><?=SHOW_text($value['nd']) ?></div>
            </div>
            <?php }} ?>
          </div>
        </div>
      </section>
    </div>
  </section>

  <div class="box-header mb-60">
  <h3 class="box-title box-title-td pull-right">
    <a href="<?=$url_page ?>&noi-dung=true" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
  </h3>
</div>
</form>