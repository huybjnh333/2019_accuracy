<?php
  $table = "#_sponline";
  $id    = isset($_GET['edit']) && is_numeric($_GET['edit']) ? SHOW_text($_GET['edit']) : 0;
  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    $support_name_vi    = $_REQUEST['support_name_vi'];
    $support_name_en    = $_REQUEST['support_name_en'];
 
    $contact_name_vi    = $_REQUEST['contact_name_vi'];
    $contact_name_en    = $_REQUEST['contact_name_en'];
    $email              = $_REQUEST['email'];
    $phone              = $_REQUEST['phone'];
    $catasort           = str_replace(".", "", $_REQUEST['catasort']);
    $showhi             = isset($_POST['showhi']) ? 1 : 0;
    $ngaydang           = time();
  }

  if(!empty($_POST))
  {
      $data                     = array();
  
      $data['support_name_vi']  = $support_name_vi;
      $data['support_name_en']  = $support_name_en;
 
      $data['contact_name_vi']  = $contact_name_vi;
      $data['contact_name_en']  = $contact_name_en;
      $data['email']            = $email;
      $data['phone']            = $phone;
      $data['catasort']         = $catasort;
      $data['ngaydang']         = $ngaydang;
      $data['showhi']           = $showhi;

      if($id  == 0){
        $id = ACTION_db($data, $table, 'add',NULL,NULL);
        $_SESSION['show_message_on'] =  "Thêm hỗ trợ thành công!";
        LOCATION_js($url_page."&edit=".$id);
        exit();
      }else{
        ACTION_db($data, $table,'update',NULL,"`id` = ".$id);
        $_SESSION['show_message_on'] =  "Cập nhật hỗ trợ thành công!";
      }
      
      
  }

  if($id > 0)
  {
    $sql_se     = DB_que("SELECT * FROM `$table` WHERE `id`='".$id."' LIMIT 1");
    $sql_se     = mysql_fetch_array($sql_se);

    $support_name_vi  = Show_text($sql_se['support_name_vi']);
    $support_name_en  = Show_text($sql_se['support_name_en']); 
 
    $contact_name_vi  = Show_text($sql_se['contact_name_vi']);
    $contact_name_en  = Show_text($sql_se['contact_name_en']);
    $email            = Show_text($sql_se['email']);
    $phone            = Show_text($sql_se['phone']);
    $catasort         = number_format(SHOW_text($sql_se['catasort']),0,',','.');
    $showhi           = SHOW_text($sql_se['showhi']);
    
  }
  else 
  {
    $catasort   = layCatasort($table);
    $catasort   = number_format(SHOW_text($catasort),0,',','.');
  }
?>
<section class="content-header">
    <h1>Danh sách hỗ trợ</h1> 
    <ol class="breadcrumb">
        <li><a href="<?=$fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Danh sách hỗ trợ</li>
    </ol>
</section>

<form id="form_submit" name="form_submit" action="" method="post">
  <section class="content form_create">
    <div class="row">
      <section class="col-lg-12">
        <?php include _source."mesages.php"; ?>
          <div class="box">
            <div class="box-header with-border">
              <h2 class="h2_title">
                  <i class="fa fa-pencil-square-o"></i> <?=$id > 0 ? 'Sửa' : 'Thêm' ?> hỗ trợ
              </h2>
              <h3 class="box-title box-title-td pull-right">
                <button onclick="return checkSubmit()" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
                <a href="<?=$url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                <a href="<?=$url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
              </h3>
          </div>
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
                  <label>Tên hỗ trợ</label>
                  <input type="text" class="form-control" name="support_name_vi" id="support_name_vi" value="<?=(isset($support_name_vi)) ? $support_name_vi : '' ?>">
                </div>
                <!-- <div class="form-group">
                  <label>Nhân viên hỗ trợ</label>
                  <input type="text" class="form-control" name="contact_name_vi" value="<?=(isset($contact_name_vi)) ? $contact_name_vi : ''?>">
                </div> -->
              </div>
              <?php if($lang_en){ ?>
              <div class="tab-pane" id="tab_2">
                <div class="form-group">
                  <label>Tên hỗ trợ (EN)</label>
                  <input type="text" class="form-control" name="support_name_en" value="<?=(isset($support_name_en)) ? $support_name_en : '' ?>">
                </div>
                <!-- <div class="form-group">
                  <label>Nhân viên hỗ trợ (EN)</label>
                  <input type="text" class="form-control" name="contact_name_en" value="<?=(isset($contact_name_en)) ? $contact_name_en : ''?>">
                </div> -->
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </section>
      <section class="col-lg-12">
        <div class="box p10">
          <!-- <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" name="email" value="<?=(isset($email)) ? $email : ''?>">
          </div> -->
          <div class="form-group">
            <label>Số điện thoại 1</label>
            <input type="text" class="form-control" name="email" value="<?=(isset($email)) ? $email : ''?>">
          </div>
          <div class="form-group">
            <label>Số điện thoại 2</label>
            <input type="text" class="form-control" name="phone" value="<?=(isset($phone)) ? $phone : ''?>">
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
      </section>
    </div>
  </section>
  <div class="box-header mb-40" style="margin-bottom: 60px;">
    <h3 class="box-title box-title-td pull-right">
      <button onclick="return checkSubmit()" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
      <a href="<?=$url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
      <a href="<?=$url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
    </h3>
  </div>
</form>
<script>
  function checkSubmit(){
    if($("#support_name_vi").val() == '')
    {
      alert("Hãy nhập Tài khoản hỗ trợ!");
      $("#support_name_vi").focus();
      return false;
    }
    document.getElementById("form_submit").submit();
  }
</script>