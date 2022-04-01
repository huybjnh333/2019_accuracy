<?php
  $table = '#_form_lienhe';

  if(isset($_GET['edit']))
  {
    $sql_se       = DB_que("SELECT * FROM `$table` WHERE `id`='".$_GET['edit']."' LIMIT 1");
    $sql_se       = mysql_fetch_array($sql_se);
    $noi_dung_vn  = SHOW_text($sql_se['noi_dung_vn']);

    DB_que("UPDATE $table SET `showhi` = 1 WHERE `id` = ".$_GET['edit']." LIMIT 1");
  }
include _source . '/header_bar.php';
?>


<section class="content form_create">
  <div class="row">
    <section class="col-lg-12">
      <?php include _source."mesages.php"; ?>
      <div class="box">
          <div class="box-header with-border">
            <h2 class="h2_title">
                <i class="fa fa-pencil-square-o"></i> Xem liên hệ
            </h2>
            <h3 class="box-title box-title-td pull-right">
                <a href="?module=<?=$module ?>&action=<?=$action ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
            </h3>
        </div>
        <div class=" p10">
          <?=html_entity_decode($noi_dung_vn) ?>
        </div>
      </div>
    </section>
  </div>
</section>