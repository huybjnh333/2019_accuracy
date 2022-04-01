<?php
  $table = '#_form_danhmuc';
  $id    = isset($_GET['edit']) && is_numeric($_GET['edit']) ? SHOW_text($_GET['edit']) : 0;
  if($_SERVER['REQUEST_METHOD']=='POST')
    {
      $tenbaiviet_vi      = @$_REQUEST['tenbaiviet_vi'];
      $tenbaiviet_en      = @$_REQUEST['tenbaiviet_en'];
      $catasort           = str_replace(".", "", $_REQUEST['catasort']);
      $showhi             = $_REQUEST['showhi'];
    }

  if(!empty($_POST))
    {
      $data                     = array();
      $data['tenbaiviet_vi']    = $tenbaiviet_vi;
      $data['tenbaiviet_en']    = $tenbaiviet_en;
      $data['tenbaiviet_vi']    = $tenbaiviet_vi;
      $data['ngaydang']         = time();
      $data['showhi']           = $showhi;
      $data['catasort']         = $catasort;
 
      if($id == 0){
        $id                     = ACTION_db($data, $table , 'add',NULL,NULL);
        
        $_SESSION['show_message_on'] =  "Thêm form thành công!";
        LOCATION_js($url_page."&step=".@$_GET['step']."&id_step=".@$_GET['id_step']."&edit=".$id);
        exit();
      }else{
        ACTION_db($data, $table, 'update', NULL, "`id` = ".$id);
        $_SESSION['show_message_on'] =  "Cập nhật form thành công!";
      }
    }
 
    
  if($id > 0)
    {
      $sql_se             = DB_que("SELECT * FROM `$table` WHERE `id`='".$id."' LIMIT 1");
      $sql_se             = mysql_fetch_array($sql_se);
      foreach ($sql_se as $key => $value) {
        ${$key} = SHOW_text($value);
      }
      $catasort           = number_format(SHOW_text($sql_se['catasort']),0,',','.');
    }
    else 
    {
      $catasort   = layCatasort($table);
      $catasort   = number_format(SHOW_text($catasort),0,',','.');
    }
?>

<section class="content-header">
  <h1>Danh sách form</h1> 
  <ol class="breadcrumb">
      <li><a href="<?=$fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
      <li class="active">Quản lý form</li>
  </ol>
</section>
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
  $( "#sortable" ).sortable({
    placeholder: "ui-state-highlight",
    stop: function(event, ui) {
      SAP_XEP_STT();
    }
  });
  $( "#sortable" ).disableSelection();
} );
</script>
<style type="text/css">
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; max-width: 500px }
  #sortable li { border: 1px solid #ccc; position: relative; border-radius: 7px; padding: 10px; margin-top: 7px; }
  #sortable li p{font-weight: 600; margin: 0 0 6px;}
  #sortable li input[type="text"],
  #sortable li select{width: 100%; border: 1px solid #ccc; padding: 0 7px; height: 28px; outline: none}
  #sortable li a { position: absolute; top: 7px; right: 43px; }
  #sortable li a.cur.xoa { right: 10px; }
  .dv-popop { width: 350px; position: fixed; z-index: 999; box-shadow: 0 0 20px rgba(0, 0, 0, 0.47); top: 50%; left: 50%; background: #fff; transform: translate(-50%, -50%); padding: 12px; border-radius: 8px;  overflow: hidden; z-index: 99999; display: none}
  .dv-popop a { background: #3c8dbc; position: absolute; right: 0; top: 0; z-index: 9999; font-size: 16px; color: #fff; padding: 0; width: 30px; height: 26px; line-height: 20px; text-align: center; border-radius: 0 0 0 100px; }
  .dv-popop p { margin: 0; padding: 0; margin-bottom: 5px; }
  .dv-popop input[type="text"] ,
  .dv-popop textarea{ width: 100%; border: 1px solid #ccc; height: 26px; margin-bottom: 12px; padding: 0 6px}
  .dv-popop button { background: #3c8dbc; color: #fff; border: none; padding: 5px 10px; float: left; margin-right: 7px; border-radius: 4px; }
  .dv-popop textarea{height: 50px; outline: none}
  .dv-popop button:hover { background: #2d7fae }
  .dv-popop h3 { padding: 0; margin: 0; text-transform: uppercase; font-size: 17px; margin-bottom: 10px; border-bottom: 1px solid #e2e2e2; padding-bottom: 5px; background: #fff; }
  .add_gia { background: rgb(60, 141, 188); color: #fff !important; padding: 3px 10px; display: inline-block; margin-top: 10px; border-radius: 100px; font-size: 12px; font-weight: 700; }
  .add_gia:hover {    background: rgb(42, 117, 160);}
  #sortable li textarea { width: 100%; border: 1px solid #ccc; padding: 0 7px; height: 60px; outline: none}
  .dv-popop a.cur.them_option { position: relative; background: none; color: #d80d0d; font-size: 13px; top: -5px; }
  .dv-option { max-height: 150px; overflow-y: auto; }
  .mt_radio { margin: 10px 0 0px; }
  .mt_radio label { font-weight: 500; margin-right: 15px; line-height: 1; }
  .mt_radio label input { width: 17px; height: 17px; float: left; margin-right: 6px; position: relative; top: -5px; }
  .lb_checked { line-height: 1; margin-bottom: 5px; }
  .lb_checked input { width: 18px; height: 18px; float: left; margin-right: 7px; position: relative; top: -6px; }
</style>
<form id="form_submit" name="form_submit" action="" method="post"  enctype='multipart/form-data'>
  <section class="content form_create">
    <div class="row">
      <section class="col-lg-12">
        <?php include _source."mesages.php"; ?>
        <div class="box">
          <div class="box-header with-border">
            <h2 class="h2_title">
                <i class="fa fa-pencil-square-o"></i>Form > <?=$id > 0 ? 'Sửa' : 'Thêm' ?> form
            </h2>
            <h3 class="box-title box-title-td pull-right">
                <button onclick="return checkSubmit()" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
                <a href="<?=$url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                <a href="<?=$url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
            </h3>
          </div>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Tiếng Việt</a></li>
              <?php if($lang_en){ ?>
              <!-- <li class="tienganh"><a href="#tab_2" data-toggle="tab">English</a></li> -->
              <?php } ?>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div class="form-group">
                  <label>Tên form</label>
                  <input type="text" class="form-control" value="<?=(isset($_GET['edit'])) ? SHOW_text($tenbaiviet_vi) : ''?>" name="tenbaiviet_vi" id="tenbaiviet_vi">
                </div>
                <?php if($id > 0){ ?>
                <div class="form-group">
                  <label style="display: block; margin-bottom: 11px;">Loại form</label>
                  <label class="lable_radio"><input type="radio" name="loai_from"  class="minimal loai_from" value="1" checked="checked"> Input</label>
                  <label class="lable_radio"><input type="radio" name="loai_from"  class="minimal loai_from" value="2"> TextArea</label>
                  <label class="lable_radio"><input type="radio" name="loai_from"  class="minimal loai_from" value="3"> Select</label>
                  <label class="lable_radio"><input type="radio" name="loai_from"  class="minimal loai_from" value="4"> Checkbox</label>
                  <label class="lable_radio"><input type="radio" name="loai_from"  class="minimal loai_from" value="5"> Radio</label>
                  <div class="clr"></div>
                  <a class="cur add_gia" onclick="THEM_button(0)">+ Thêm</a>
                </div>
                <label>List Form <a data-tooltip="Di chuyển các div mục nếu muốn sắp xếp các vị trí."> </a></label>
                <ul id="sortable" class="sortable_jss">
                  <?php 
                    $list_form  = DB_que("SELECT * FROM `#_form_danhmuc` WHERE `id_parent` = '".$id."' ORDER BY `catasort` ASC");
                    while ($row = mysql_fetch_assoc($list_form)) {
                      if($row['loai_from'] == 1){
                  ?>
                  <li class="ui-state-default li_ac_id<?=$row['id'] ?>" data="<?=$row['id'] ?>"><p><?=SHOW_text($row['tenbaiviet_vi']) ?></p><input type='text' value='' placeholder="<?=$row['mota_vi'] ?>"><a class='cur' onclick="THEM_button('<?=$row['id'] ?>', 1)">[Chỉnh sửa]</a><a class='cur xoa' onclick="XOA_popp('<?=$row['id'] ?>')">[Xóa]</a></li>

                  <?php }if($row['loai_from'] == 2){ ?>
                  <li class="ui-state-default li_ac_id<?=$row['id'] ?>" data="<?=$row['id'] ?>"><p><?=SHOW_text($row['tenbaiviet_vi']) ?></p><textarea name='mota_vi' placeholder='<?=$row['mota_vi'] ?>'></textarea><a class='cur' onclick="THEM_button('<?=$row['id'] ?>', 2)">[Chỉnh sửa]</a><a class='cur xoa' onclick="XOA_popp('<?=$row['id'] ?>')">[Xóa]</a></li>
                  
                  <?php }if($row['loai_from'] == 3){ ?>
                  <li class="ui-state-default li_ac_id<?=$row['id'] ?>" data="<?=$row['id'] ?>"><p><?=SHOW_text($row['tenbaiviet_vi']) ?></p>
                  <select>
                    <option><?=SHOW_text($row['tenbaiviet_vi']) ?></option>
                    <?php 
                      $ds_option = DB_que("SELECT * FROM `#_form_danhmuc` WHERE `id_parent` = '".$row['id']."' ORDER BY `catasort` ASC ");
                      $list_option = "";
                      if(@mysql_num_rows($ds_option)){
                        while ($r  = mysql_fetch_assoc($ds_option)) {
                          echo '<option>'.SHOW_text($r['tenbaiviet_vi']).'</option>';
                        }
                      }
                    ?>
                  </select>
                  <a class='cur' onclick="THEM_button('<?=$row['id'] ?>', 3)">[Chỉnh sửa]</a><a class='cur xoa' onclick="XOA_popp('<?=$row['id'] ?>')">[Xóa]</a></li>

                  <?php }if($row['loai_from'] == 4){ ?>
                  <li class="ui-state-default li_ac_id<?=$row['id'] ?>" data="<?=$row['id'] ?>"><p><?=SHOW_text($row['tenbaiviet_vi']) ?></p>
                  <div class='mt_radio'>
                    <?php 
                      $ds_option = DB_que("SELECT * FROM `#_form_danhmuc` WHERE `id_parent` = '".$row['id']."' ORDER BY `catasort` ASC ");
                      if(@mysql_num_rows($ds_option)){
                        while ($r  = mysql_fetch_assoc($ds_option)) {
                          echo '<label><input type="checkbox">'.SHOW_text($r['tenbaiviet_vi']).'</label>';
                        }
                      }
                    ?>
                  </div>
                  <a class='cur' onclick="THEM_button('<?=$row['id'] ?>', 4)">[Chỉnh sửa]</a><a class='cur xoa' onclick="XOA_popp('<?=$row['id'] ?>')">[Xóa]</a></li>
             
                  <?php }if($row['loai_from'] == 5){ ?>
                  <li class="ui-state-default li_ac_id<?=$row['id'] ?>" data="<?=$row['id'] ?>"><p><?=SHOW_text($row['tenbaiviet_vi']) ?></p>
                  <div class='mt_radio'>
                    <?php 
                      $ds_option = DB_que("SELECT * FROM `#_form_danhmuc` WHERE `id_parent` = '".$row['id']."' ORDER BY `catasort` ASC ");
                      if(@mysql_num_rows($ds_option)){
                        while ($r  = mysql_fetch_assoc($ds_option)) {
                          echo '<label><input type="radio">'.SHOW_text($r['tenbaiviet_vi']).'</label>';
                        }
                      }
                    ?>
                  </div>
                  <a class='cur' onclick="THEM_button('<?=$row['id'] ?>', 5)">[Chỉnh sửa]</a><a class='cur xoa' onclick="XOA_popp('<?=$row['id'] ?>')">[Xóa]</a></li>
                  <?php } ?>
                  <?php } ?>
                </ul>
                <?php } ?>

              </div>

            </div>
          </div>
        </div>
      </section>
      <section class="col-lg-12">
        <div class="box p10">
          <div class="form-group">
            <label>Số thứ tự</label>
            <input type="text" class="form-control" name="catasort" id="catasort" value="<?=SHOW_text($catasort)?>" onkeyup="SetCurrency(this)">
          </div>
          <div class="form-group">
            <label class="lable_radio">
              <input type="radio" name="showhi" class="minimal " value="1" <?=(isset($_GET['edit'])) ? LAY_checked($showhi, 1) : 'checked' ?>> Hiện thị
            </label>
            <label class="lable_radio">
              <input type="radio" name="showhi" class="minimal " value="2" <?=(isset($_GET['edit'])) ? LAY_checked($showhi, 2) : '' ?>> Ẩn
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


<div class="dv-popop "></div>
<script type="text/javascript">

  function SEND_opp(){
    var id = $(".id_loai_js").val();
    var datastring = $("form[id='form_ajax_"+id+"']").serialize();
    $.ajax({
       type: "POST",
       url: "index.php",
       data: datastring,
       success: function(data)
       {
        console.log(data)
          try {
            data = JSON.parse(data);
            if($(".li_ac_id"+data.id).length == 0){
              $(".sortable_jss").append(data.text);
            }
            else{
              $(".li_ac_id"+data.id).html(data.text);
            }
            SAP_XEP_STT();
          } 
          catch (e) {
              alert("ERR!");
          }
          CLOSE_opp();
       }
    });
  }
  function THEM_button(id_edit, loai = 0){
    if(id_edit == 0){
      loai = $('.loai_from:checked').val();
    }

    //console.log("nguoiquanly/?module=check_form&edit="+<?//=$id ?>//+"&id="+id_edit);
    $(".dv-popop" ).load( "nguoiquanly/?module=check_form&edit=<?=$id ?>&id="+id_edit+"&loai="+loai+" .dv-load-"+loai);
    $(".dv-popop").show();
  }
  function CLOSE_opp(){
    $(".dv-popop").hide();
  }
  function XOA_popp(id){
    var cf = confirm("Bạn có chắc xóa?");
    if(cf) {
      $.ajax({
       type: "POST",
       url: "index.php",
       data: {"id": id, 'post_delete_form':"ok"},
       success: function(data)
       {
          $('.li_ac_id'+id).remove();
          SAP_XEP_STT();
       }
      });
    }
  }
  function SAP_XEP_STT(){
    var list_id     = "";
    $(".sortable_jss li").each(function(index){
      var id        = $(this).attr('data');
          list_id   = list_id + id + ":" + index + "_";
    });
    $.ajax({
       type: "POST",
       url: "index.php",
       data: {"list_id": list_id, 'post_delete_form':"update_poop"},
       success: function(data)
       {
        console.log(data)
       }
    });
  }
  function ADD_option(){
    $(".dv-option").append('<input type="text" name="option[]" value="" placeholder="Tiêu đề các option">');
  }

</script>

 