<?php
  $table = '#_magiamgia';
  $id    = isset($_GET['edit']) && is_numeric($_GET['edit']) ? SHOW_text($_GET['edit']) : 0;
  if($_SERVER['REQUEST_METHOD']=='POST')
    {
      foreach ($_POST as $key => $value) {
        ${$key}           = str_replace(".", "", $value);
      }

      $bat_dau            = @explode("/", $bat_dau);
      $ket_thuc           = @explode("/", $ket_thuc);
      $ngay_tao           = @explode("/", $ngay_tao);

      $bat_dau            = @strtotime($bat_dau[2] . "-" . $bat_dau[1] . "-" . $bat_dau[0] . " " . date("00:00:1"));
      $ket_thuc           = @strtotime($ket_thuc[2] . "-" . $ket_thuc[1] . "-" . $ket_thuc[0] . " " . $gio);
      $ngay_tao           = @strtotime($ngay_tao[2] . "-" . $ngay_tao[1] . "-" . $ngay_tao[0] . " " . date("23:59:59"));


    }

  if(!empty($_POST))
    {
        if($id == 0) {
      $khong_gioi_han               = isset($_POST['khong_gioi_han']) ? 1 : 0;

            $data = array();
            $data['tenbaiviet_vi'] = $tenbaiviet_vi;
//      $data['so_lan_su_dung']       = $so_lan_su_dung;
      $data['khong_gioi_han']       = $khong_gioi_han;
//      $data['loai_km']              = $loai_km;
//      $data['gia_tri_giam']         = $gia_tri_giam;
//      $data['ap_dung_cho']          = $ap_dung_cho;
//      $data['gia_tri_ap_dung']      = $gia_tri_ap_dung;
            $data['so_tien'] = $so_tien;
            $data['ma_giam_gia'] = $ma_giam_gia;

//      $data['ap_dung_khuyen_mail_tren_don_hang'] = $ap_dung_khuyen_mail_tren_don_hang;

            $data['bat_dau'] = $bat_dau;
            $data['ket_thuc'] = $ket_thuc;
            $data['ngay_tao'] = $ngay_tao;
//      $data['catasort']             = $catasort;

            $id = ACTION_db($data, $table, 'add', NULL, NULL);
            $_SESSION['show_message_on'] = "Thêm mã giảm giá thành công!";

            LOCATION_js($url_page);
            exit();
        }else {
            $data = array();
            $data['tenbaiviet_vi'] = $tenbaiviet_vi;
            $data['so_tien'] = $so_tien;
            $data['ma_giam_gia'] = $ma_giam_gia;
            $data['bat_dau'] = $bat_dau;
            $data['ket_thuc'] = $ket_thuc;

            $id = ACTION_db($data, $table, 'update', NULL, "`id` = '".$id."'");
            $_SESSION['show_message_on'] = "Lưu thành công";
        }
    }
 
    
  if($id > 0)
    {
      $sql_se             = DB_que("SELECT * FROM `$table` WHERE `id`='".$id."' LIMIT 1");
      $sql_se             = mysql_fetch_array($sql_se);
      foreach ($sql_se as $key => $value) {
        ${$key} = SHOW_text($value);
      }
      $catasort           = number_format($catasort,0,',','.');
    }
    else
    {
      $catasort   = layCatasort($table);
      $catasort   = number_format(SHOW_text($catasort),0,',','.');
      $id_parent  = 0;
      $edit       = 0;
    }
?>

<section class="content-header">
  <h1>Danh sách mã giảm giá</h1> 
  <ol class="breadcrumb">
      <li><a href="<?=$fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
      <li class="active">Quản lý mã giảm giá</li>
  </ol>
</section>
<style>
  label {margin-bottom: 10px !important}
  .dv-gr-lb { display: inline-block; border: 1px solid #ccc; background: #f5f5f5; }
  .dv-gr-lb > input { width: 180px; float: left; border: none; border-right: 1px solid #ccc; }
  .dv-gr-lb > label { float: left; padding: 7px; margin: 0 !important; font-weight: 500; }
  .mauxam { background: #f5f5f5 !important; }
  .dv-grp-left{}
  .dv-grp-left select{float: left;}
  .dv-grp-left span { padding: 7px 10px; display: inline-block; float: left; }
  .dv-grp-left input{}
  .dv-grp-left .dv-gr-lb { float: left; }
  .js_ap_dung_cho{display: none; margin-left: 10px; float: left;}
  .dv-full-task { width: 100%; float: left; margin-top: 10px; display: none}
  .dv-full-task span { padding-left: 0; min-width: 162px; display: inline-block; }
  .dv-grp-left select { float: left; width: auto; }
  .input-group-date label{ margin-right: 10px; font-weight: 500 }
  .dv-magiamgia-nhom { display: none; border: 1px dashed #ccc; padding: 10px; border-radius: 7px; margin-top: 10px; }
  .p_chuthich { color: #a0a0a0; }
  p.p_chuthich { margin-bottom: 0; margin-top: 3px; }
</style>
<form id="form_submit" name="form_submit" action="" method="post"  enctype='multipart/form-data'>
  <section class="content form_create">
    <div class="row">
      <section class="col-lg-12">
        <?php include _source."mesages.php"; ?>
        <div class="box">
          <div class="box-header with-border">
            <h2 class="h2_title">
                <i class="fa fa-pencil-square-o"></i>Danh sách mã giảm giá > <?=$id > 0 ? 'Sửa' : 'Thêm' ?> mã giảm giá
            </h2>
            <h3 class="box-title box-title-td pull-right">
                <button onclick="return checkSubmit()" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
                <a href="<?=$url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                <a href="<?=$url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
            </h3>
          </div>
          <div class="nav-tabs-custom"> 
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div class="form-group">
                  <label>Tên chiến dịch khuyến mãi</label>
                  <input type="text" class="form-control" value="<?=!empty($tenbaiviet_vi) ? SHOW_text($tenbaiviet_vi) : ''?>" name="tenbaiviet_vi" id="tenbaiviet_vi">
                </div>
                  <div class="form-group">
                      <label>Mã giảm giá</label>
                      <input type="text" class="form-control" value="<?=!empty($ma_giam_gia) ? SHOW_text($ma_giam_gia) : ''?>" name="ma_giam_gia" id="ma_giam_gia">
                  </div>
                  <div class="form-group">
                      <label>Số tiền</label>
                      <input type="text" class="form-control cls_giatien_f" onkeyup="SetCurrency(this)" value="<?=!empty($so_tien) ? SHOW_text($so_tien) : ''?>" name="so_tien" id="so_tien">
                  </div>
              </div>
            </div>
            <div class="box p10">
              <div class="form-group">
                <label>Bắt đầu khuyến mãi</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input name="bat_dau" type="text" class="form-control pull-right" id="datepicker2" value='<?=!empty($bat_dau) ? SHOW_text(date("d-m-Y", $bat_dau)) : ''?>'>
                </div>
              </div>
              <div class="form-group">
                <label>Hết hạn khuyến mãi</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input name="ket_thuc" type="text" class="form-control pull-right" id="datepicker3" value='<?=!empty($ket_thuc) ? SHOW_text(date("d-m-Y", $ket_thuc)) : ''?>'>
                </div>
              </div>
            </div>
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
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
  function checkSubmit(){
    if($("#tenbaiviet_vi").val().trim() == '')
    {
      alert("Hãy nhập tên mã giảm giá!");
      $("#tenbaiviet_vi").focus();
      return false;
    }
      if($("#ma_giam_gia").val().trim() == '')
      {
          alert("Hãy nhập mã giảm giá!");
          $("#ma_giam_gia").focus();
          return false;
      }
      if($("#so_tien").val().trim() == '')
      {
          alert("Hãy nhập số tiền!");
          $("#so_tien").focus();
          return false;
      }
      if($("#datepicker2").val().trim() == '')
      {
          alert("Hãy nhập ngày bắt đầu giảm giá!");
          $("#datepicker2").focus();
          return false;
      }
      if($("#datepicker3").val().trim() == '')
      {
          alert("Hãy nhập ngày kết thúc giảm giá!");
          $("#datepicker3").focus();
          return false;
      }
    // document.getElementById("form_submit").submit();
  };

  var currentDate = new Date();
  $('#datepicker3').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
      startDate: '-0d',
      changeMonth: true,
  });
  $('#datepicker2').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
      startDate: '-0d',
      changeMonth: true,
  });
</script>