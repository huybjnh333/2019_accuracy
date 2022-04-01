<?php
  $table = "#_members";
  $id    = isset($_GET['edit']) && is_numeric($_GET['edit']) ? SHOW_text($_GET['edit']) : 0;


  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    $email          = $_REQUEST['email'];
    $hoten          = $_REQUEST['hoten'];
    $sodienthoai    = $_REQUEST['sodienthoai'];
    $diachi         = $_REQUEST['diachi'];
    $gioitinh       = $_REQUEST['gioitinh'];
    $showhi         = isset($_POST['showhi']) ? 1 : 0;
    $phanquyen      = 0;
    $keypass        = RANDOM_chuoi(5);
    $matkhau        = create_pass($auto_key_pass.md5($auto_key_pass.$_POST['matkhau']),$keypass);

    $linh_vuc       = $_REQUEST['linh_vuc'];
    $cong_ty        = $_REQUEST['cong_ty'];
    $bd_date        = $_REQUEST['bd_date'];
    $bd_month       = $_REQUEST['bd_month'];
    $bd_year        = $_REQUEST['bd_year'];
    $ngaysinh       = $bd_date.'/'.$bd_month.'/'.$bd_year;
    

  }

  if(!empty($_POST))
  {
    $wh = '';
    if($id != 0) $wh = " AND `id` <> '".$id."'";
    $check_user = DB_que("SELECT * FROm $table WHERE `email` = '$email' $wh LIMIT 1");

    if(mysql_num_rows($check_user) != 0)
      {
        $_SESSION['show_message_off'] =  "Email đã tồn tại trong hệ thống!";
        if($id != 0)
          LOCATION_js($url_page."&edit=".$id);
        else
          LOCATION_js($url_page."&them-moi=true");
        exit();
      }
    else
      {
        $data                 = array();

        $data['tentruycap']   = str_replace(strstr($email, '@'),'',$email).(rand(999,9999));
        $data['hoten']        = $hoten;
        $data['email']        = $email;
        $data['diachi']       = $diachi;
        $data['sodienthoai']  = $sodienthoai;         
        $data['gioitinh']     = $gioitinh;
        $data['showhi']       = $showhi;
        $data['phanquyen']    = $phanquyen;
        $data['ngaysinh']     = $ngaysinh;
        $data['linh_vuc']     = $linh_vuc;
        $data['cong_ty']      = $cong_ty;


        if(trim($_POST['matkhau']) != '') 
        {
          $data['keypass']  = $keypass;
          $data['matkhau']  = $matkhau;
        }

        if($id == 0){
          $id  = ACTION_db($data, $table , 'add', NULL ,NULL);
          if($id != 0) {
            $_SESSION['show_message_on'] =  "Thêm thành viên thành công!";
            LOCATION_js($url_page."&edit=".$id);
            exit();
          }else{
            $_SESSION['show_message_off'] =  "Tên truy cập đã tồn tại!";

          }
        }else{
          ACTION_db($data, $table, 'update', NULL, "`id` = '".$id."'"); 
          $_SESSION['show_message_on'] =  "Cập nhật thành viên thành công!";
        }
      }
  }


  if($id > 0)
  {
    $sql_se     = DB_que("SELECT * FROM `$table` WHERE `id`='".$_GET['edit']."' LIMIT 1");
    $sql_se     = mysql_fetch_array($sql_se);

    foreach ($sql_se as $key => $value) {
      ${$key}        = SHOW_text($value);
    }
    // $hoten        = SHOW_text($sql_se['hoten']);
    // $sodienthoai  = SHOW_text($sql_se['sodienthoai']);
    // $email        = SHOW_text($sql_se['email']);
    // $diachi       = SHOW_text($sql_se['diachi']);
    // $gioitinh     = SHOW_text($sql_se['gioitinh']);
    // $showhi       = SHOW_text($sql_se['showhi']);

    $ngaysinh       = explode("/",SHOW_text($sql_se['ngaysinh']));
    $bd_date        = @$ngaysinh[0];
    $bd_month       = @$ngaysinh[1];
    $bd_year        = @$ngaysinh[2];
  }

?>

<section class="content-header">
    <h1>Danh sách thành viên đăng ký</h1> 
    <ol class="breadcrumb">
        <li><a href="<?=$fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Danh sách thành viên đăng ký</li>
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
                  <i class="fa fa-pencil-square-o"></i> <?=$id > 0 ? 'Sửa' : 'Thêm' ?> thành viên đăng ký
              </h2>
              <h3 class="box-title box-title-td pull-right">
                <button onclick="return RETURN_checkSubmit()" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
                <a href="<?=$url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                <a href="<?=$url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
              </h3>
          </div>
          <div class="box p10">
            <div class="form-group">
              <label>Email (*)</label>
              <input type="text" class="form-control" id="email" name="email" value="<?=(isset($email)) ? $email : ''?>">
            </div>

            <div class="form-group">
              <label>Mật khẩu <?=$id == 0 ? '(*)' : '' ?></label>
              <input type="password" class="form-control" id="matkhau" name="matkhau" value="">
            </div>

            <div class="form-group">
              <label>Nhập lại mật khẩu <?=$id == 0 ? '(*)' : '' ?></label>
              <input type="password" class="form-control" id="matkhau_cf" value="">
            </div>

            <div class="form-group">
              <label>Họ tên</label>
              <input type="text" class="form-control" id="hoten" name="hoten" value="<?=!empty($hoten) ? $hoten : ''?>">
            </div>

            <div class="form-group">
              <label>Số điện thoại</label>
              <input type="text" class="form-control" id="sodienthoai" name="sodienthoai" value="<?=!empty($sodienthoai) ? $sodienthoai : ''?>">
            </div>

            <div class="form-group">
              <label>Địa chỉ</label>
              <input type="text" class="form-control" id="diachi" name="diachi" value="<?=!empty($diachi) ? $diachi : ''?>">
            </div>

            <!-- <div class="form-group">
              <label>Ngày sinh: </label>
              <select name="bd_date" id="bd_date" class="form-control">
                <option>Ngày</option>
                <?php
                    for($i=1;$i<=31;$i++)
                    {
                ?>
                        <option value="<?=$i?>" <?php if($i==@$bd_date) echo 'selected'; ?>><?=$i?></option>
                <?php } ?>
              </select>
              <select name="bd_month" id="bd_month" class="form-control">
                <option>Tháng</option>
                <?php
                    for($i=1;$i<=12;$i++)
                    {
                ?>
                        <option value="<?=$i?>" <?php if($i==@$bd_month) echo 'selected'; ?>><?=$i?></option>
                <?php } ?>
              </select>
              <select name="bd_year" id="bd_year" class="form-control">
                <option>Năm</option>
                <?php
                    for($i=date("Y")-5;$i>=1900;$i--)
                    {
                ?>
                        <option value="<?=$i?>" <?php if($i==@$bd_year) echo 'selected'; ?>><?=$i?></option>
                <?php } ?>
              </select>
            </div> -->


            <div class="form-group">
              <label class="mr-20 checkbox-mini">
              <input type="checkbox" name="showhi" class="minimal" <?=isset($showhi) && $showhi == 0 ? '' : 'checked="checked"' ?>> Hiển thị
            </label>
            </div>
          </div>
        </div>
      </section>
    </div>
  </section>
  <div class="box-header mb-60">
  <h3 class="box-title box-title-td pull-right">
    <button onclick="return RETURN_checkSubmit()" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
    <a href="<?=$url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
    <a href="<?=$url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
  </h3>
</div>
</form>
<script>
  function RETURN_checkSubmit(){
    if($("#email").val() == '')
    {
      alert("Nhập email!");
      $("#email").focus();
      return false;
    }

    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!regex.test($("#email").val())) 
    {
        alert("Email không hợp lệ!");
        $("#email").focus();
        return false;
    }
    
    <?php if($id > 0){ ?>
      if($("#matkhau").val() != $("#matkhau_cf").val())
      {
        alert("Mật khẩu nhập lại chưa đúng!");
        $("#matkhau_cf").focus();
        return false;
      }
    <?php }else{ ?>
      if($("#matkhau").val() == '')
      {
        alert("Nhập mật khẩu!");
        $("#matkhau").focus();
        return false;
      }
      if($("#matkhau").val().length < 6) 
      {
        alert("Mật khẩu phải ít nhất 6 ký tự!");
        $("#matkhau").focus();
        return false;
      }
      else if($("#matkhau").val() != $("#matkhau_cf").val())
      {
        alert("Mật khẩu nhập lại chưa đúng!");
        $("#matkhau_cf").focus();
        return false;
      }
    <?php } ?>
    if($('#sodienthoai').val() != '' && !CHECK_phone("#sodienthoai")){
      alert("Số điện thoại không hợp lệ!");
      $("#sodienthoai").focus();
      return false;
    }
    document.getElementById("form_submit").submit();
  }
</script>