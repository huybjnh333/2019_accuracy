<?php
  if(isset($_GET['them-moi']) || (isset($_GET['edit']) && is_numeric($_GET['edit']))){
      include "module-danh-sach-don-hang-add.php";
  }else{


  $table = '#_order';

  if(isset($_GET['del']))
  {
    $sql_se     = DB_que("SELECT * FROM `$table` WHERE `id`='".$_GET['catalogid']."'  LIMIT 1");
    if(mysql_num_rows($sql_se) > 0)
    {
      $del_name   = @mysql_result($sql_se,0,'hoten');
      DB_que("DELETE FROM `$table` WHERE `id` = '".$_GET['catalogid']."' LIMIT 1");
      $_SESSION['show_message_on'] = 'Đã xóa [<strong>'.$del_name.'</strong>] thành công!';
        
    } else $_SESSION['show_message_off'] = 'Dữ liệu không hợp lệ!';
    LOCATION_js($url_page);
    exit();
  }

  if(isset($_REQUEST['addgiatri']) AND isset($_REQUEST['maxvalu']))
  {
      for($i = 0; $i < $_REQUEST['maxvalu']; $i++)
      {
          $idofme     = $_POST["idme$i"];
          $status     = $_POST["status_$i"];
          if(isset($_POST["xoa_gr_arr_$i"])){
            //xoa
            DB_que("DELETE FROM `$table` WHERE `id` = '".$idofme."' LIMIT 1");
            //
          }else{
            $data               = array();
            $data['trangthai']  = $status;
            ACTION_db($data, $table, 'update', NULL, "`id` = '$idofme'");
          }
      }
      $_SESSION['show_message_on'] = 'Cập nhật dữ liệu thành công!';
  }

  $mo       = '';
  $uri      = '';
  $numview  = 50;

  $s_trangthai = isset($_GET['trang-thai']) && is_numeric($_GET['trang-thai']) ? $_GET['trang-thai'] : 0;
  $s_hienthi   = isset($_GET['hien-thi']) && is_numeric($_GET['hien-thi']) ? $_GET['hien-thi'] : 0;

  if($s_hienthi == 1)      $numview = 15;
  else if($s_hienthi == 2) $numview = 30;
  else if($s_hienthi == 3) $numview = 60;
  else if($s_hienthi == 4) $numview = 100;
  else if($s_hienthi == 5) $numview = 200;

  $pz  = 0;
  $pzz = 0;

  if(isset($_GET['pz'])){
    $pz       = $_GET['pz'];
    if($pz    == "" || $pz == 0)  $pzz = 0;
    else $pzz = $pz * $numview;
  }

  if($s_trangthai != 0){
    $mo  .= ' AND `trangthai`='.$s_trangthai.' ';
    $uri .= '&trang-thai='.$s_trangthai;
  }

  $sql     = DB_que("SELECT * FROM `$table` WHERE 1 $mo ORDER BY `ngaydat` DESC LIMIT $pzz,$numview");
  $sql_num = DB_que("SELECT * FROM `$table` WHERE 1 $mo ");

  $numlist = @mysql_num_rows($sql_num);
  $numshow = ceil($numlist/$numview);
?>

<section class="content-header">
    <h1>Danh sách đơn hàng</h1> 
    <ol class="breadcrumb">
        <li><a href="<?=$fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Danh sách đơn hàng</li>
    </ol>
</section>
<form action="" method="post">
    <input type="hidden" name="token" value="<?=GET_token() ?>">
    <section class="content">
        <div class="row">
            <section class="col-lg-12">
              <?php include _source."mesages.php"; ?>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title box-title-td pull-right">
                          <button type="submit" name="addgiatri" class="btn btn-primary" onclick="return CHECK_delimg()"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
                        </h3>
                        <div class="box-tools">
                          <div class="dv-hd-locsds">
                            <div class="form-group">
                              <select class="js_trangthai_js form-control" onchange='SEARCH_jsstep()'>
                                <option selected="selected" value="0">Trạng thái</option>
                                <option value="1" <?=LAY_selected(1, $s_trangthai) ?>>Đơn hàng mới</option>
                                <option value="2" <?=LAY_selected(2, $s_trangthai) ?>>Đang xử lý</option>
                                <option value="3" <?=LAY_selected(3, $s_trangthai) ?>>Đã giao hàng</option>
                                <option value="4" <?=LAY_selected(4, $s_trangthai) ?>>Hủy đơn hàng</option>
                              </select>
                            </div>
                            <div class="form-group">
                                <select name="viewid" class="js_hienthi_ds form-control" onchange='SEARCH_jsstep()'>
                                  <option selected="selected" value="0">Hiển thị</option>
                                  <option value="1" <?=LAY_selected(1, $s_hienthi) ?>>15</option>
                                  <option value="2" <?=LAY_selected(2, $s_hienthi) ?>>30</option>
                                  <option value="3" <?=LAY_selected(3, $s_hienthi) ?>>60</option>
                                  <option value="4" <?=LAY_selected(4, $s_hienthi) ?>>100</option>
                                  <option value="5" <?=LAY_selected(5, $s_hienthi) ?>>200</option>
                              </select>
                            </div>
                          </div>
                        </div>
                    </div>
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
                            <th class="w100 text-center">Mã đơn hàng</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Ngày đặt</th>
                            <th>Trạng thái</th>
                            <th class="w100 text-center">Tác vụ</th>
                          </tr>
                          <?php
                            $cl = 0;
                            while($rows = mysql_fetch_array($sql))
                            {
                              $ida           = SHOW_text($rows['id']);
                              $madh          = SHOW_text($rows['madh']);
                              $email         = SHOW_text($rows['email']);
                              $so_dien_thoai = SHOW_text($rows['sodienthoai']);
                              $ngay_dat      = SHOW_text($rows['ngaydat']);
                              $trang_thai    = SHOW_text($rows['trangthai']); 
                          ?>
                          <tr>
                            <td class="text-center">
                              <input name='xoa_gr_arr_<?=$cl?>' type='checkbox' class='minimal cls_showxoa'>
                            </td>
                            <td class="text-center">
                              <input name="idme<?=$cl?>" value="<?=$ida?>" type="hidden">
                              <?=$cl+1?>
                            </td>
                            <td>
                              
                              <?=$madh?><br/>
                              <a href="<?=$url_page ?>&edit=<?=$ida?>">[Xem chi tiết]</i></a>
                            </td>
                            <td><?=$email?></td>
                            <td><?=$so_dien_thoai?></td>
                            <td><?=date('d/m/Y - H:i:s',$ngay_dat);?></td>
                            <td>
                              <select name="status_<?=$cl?>" class="form-control"">
                                  <option value="1" <?=LAY_selected(1, $trang_thai)?>>Đơn hàng mới</option>
                                  <option value="2" <?=LAY_selected(2, $trang_thai)?>>Đang xử lý</option>
                                  <option value="3" <?=LAY_selected(3, $trang_thai)?>>Đã giao hàng</option>
                                  <option value="4" <?=LAY_selected(4, $trang_thai)?>>Hủy đơn hàng</option>
                              </select>
                            </td>
                            <td class="text-center">
                                
                                <a href="<?=$url_page.'&del=ok&catalogid='.$ida ?>&token=<?=GET_token() ?>" class="do" onclick="return confirm('Bạn thật sự muốn xóa?')"><i class="fa fa-times"></i></a>
                            </td>
                          </tr>
                    <?
                          $cl++;
                        }
                    ?> 
                        </tbody>
                      </table>
                      <input type='hidden' value='<?=$cl?>' name='maxvalu'>
                    </div>
                    <div class="box-header">
                      <div class="paging_simple_numbers">
                        <ul class="pagination">
                          <?php
                            PHANTRANG_admin($numshow, $url_page, $pz, $uri);
                          ?>
                        </ul>
                      </div>
                      <h3 class="box-title box-title-td pull-right">
                          <button type="submit" name="addgiatri" class="btn btn-primary" onclick="return CHECK_delimg()"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
                      </h3>
                    </div>
                </div>
            </section>
        </div>
    </section>
</form>
<script type="text/javascript">
  function SEARCH_jsstep() {
      var url              = "";
      if($(".js_trangthai_js").length > 0){
        var js_trangthai_js  = $(".js_trangthai_js").val().trim();
        if(js_trangthai_js != 0) url += "&trang-thai="+js_trangthai_js;
      }
      if($(".js_hienthi_ds").length > 0){
        var js_hienthi_ds    = $(".js_hienthi_ds").val().trim();
        if(js_hienthi_ds != 0) url += "&hien-thi="+js_hienthi_ds;
      }
      window.location.href = "<?=$url_page ?>"+url;
  }
</script>
<?php } ?>