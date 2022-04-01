<?php
  if(isset($_GET['them-moi']) || (isset($_GET['edit']) && is_numeric($_GET['edit']))){
      include "module-danh-sach-thanh-vien-add.php";
  }else{
    $table = '#_members';


    if(isset($_GET['del']))
        {   
            DB_que("DELETE from $table WHERE `id` ='".$_GET['catalogid']."' LIMIT 1");
            $_SESSION['show_message_on'] = 'Đã xóa thành viên thành công!';
            LOCATION_js($url_page);
            exit();
        }

    if(isset($_REQUEST['addgiatri']) AND isset($_REQUEST['maxvalu']))
    {
        for($i=0;$i<$_REQUEST['maxvalu'];$i++)
        {
            $idofme     = $_POST["idme$i"];
            $showhi     = isset($_POST["showhi_$i"]) ? "1": "0";
            $diem       = is_numeric($_POST["diem$i"]) ? $_POST["diem$i"] : 0;
            $wh         = "";
            if($diem != 0){
                $wh         = ", `diem` = `diem` + $diem";
            }
            if(isset($_POST["xoa_gr_arr_$i"])){
                //xoa
                DB_que("DELETE from $table WHERE `id` ='".$idofme."' LIMIT 1");
                //
            }else{
                if($diem != 0){
                    $data = array();
                    $data['log']        = "Thêm $diem điểm";
                    $data['time_log']   = time();
                    $data['id_user']    = $_SESSION['luluwebproadmin'];
                    $data['id_mb']      = $idofme;
                    ACTION_db($data, '#_members_log', 'add'); 
                }
                DB_que("UPDATE `$table` SET `showhi`='$showhi' $wh WHERE `id`='$idofme' LIMIT 1");
            }
        }
         $_SESSION['show_message_on'] = 'Cập nhật dữ liệu thành công!';
    } 
    
?>

<section class="content-header">
    <h1> Danh sách thành viên</h1> 
    <ol class="breadcrumb">
        <li><a href="<?=$fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active"> Danh sách thành viên</li>
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
                        <div class="box-tools">
                        <?php 
                            $ksearch = isset($_GET['ksearch']) ? str_replace("+", " ", $_GET['ksearch']) : '';
                        ?>
                          <div class="input-group input-group-sm input-group-sm-timkiem">
                              <input name="ksearch" type="text" value="<?=$ksearch ?>" class="form-control pull-right key_search" placeholder="Nhập từ khóa tìm kiếm">
                              <div class="input-group-btn">
                                  <button name="search" type="button" class="btn btn-default btn_search_ds" onclick="SEARCH_jsstep()"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                            <?php 
                                $s_chude = isset($_GET['chu-de']) ? $_GET['chu-de']: "";
                                $mt_11_vi = isset($_GET['hien-thi']) ? $_GET['hien-thi']: "";
                                $trangthai = isset($_GET['trang-thai']) ? $_GET['trang-thai']: "";
                            ?>
                            <div class="dv-hd-locsds">
                                <div class="form-group">
                                    <select name="docid" class="js_trangthai_js form-control" onchange="SEARCH_jsstep()">
                                        <option selected="selected" value="0">Trạng thái</option>
                                        <option value="1" <?=LAY_selected(1, @$trangthai) ?>>Hiện</option>
                                        <option value="2" <?=LAY_selected(2, @$trangthai) ?>>Ẩn</option>
                                    </select>
                                </div>
                            </div>
                            <script type="text/javascript">
                                function SEARCH_jsstep() {
                                    var url              = "";
                                    if($(".key_search").length > 0){
                                      var key_search       = $(".key_search").val().trim().replace(/ /g,"+");
                                      if(key_search != "") url += "&ksearch="+key_search;
                                    }
                                    if($(".cls_chude").length > 0){
                                      var cls_chude        = $(".cls_chude").val().trim();
                                      if(cls_chude != 0) url += "&chu-de="+cls_chude;
                                    }
                                    if($(".js_trangthai_js").length > 0){
                                      var js_trangthai_js  = $(".js_trangthai_js").val().trim();
                                      if(js_trangthai_js != 0) url += "&trang-thai="+js_trangthai_js;
                                    }
                                    if($(".js_hienthi_ds").length > 0){
                                      var js_hienthi_ds    = $(".js_hienthi_ds").val().trim();
                                      if(js_hienthi_ds != 0) url += "&hien-thi="+js_hienthi_ds;
                                    }
                                    window.location.href = "?module=quan-ly-thanh-vien&action=danh-sach-thanh-vien"+url;
                                }
                            </script>
                        </div>
                        <h3 class="box-title box-title-td pull-right">
                            <button type="submit" name="addgiatri" class="btn btn-primary"  onclick="return CHECK_delimg()"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
                            <a href="<?=$url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                        </h3>
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
                                    <th>Email</th> 
                                    <th class="w100 text-center">Hiển thị</th>
                                    <th class="w120 text-center">Tác vụ</th>
                                </tr>
                                <?php
                                    $whe = "";
                                    if($s_chude != "") $whe .= " AND `linh_vuc` = '$s_chude'";
                                    if($mt_11_vi != "") $whe .= " AND `cong_ty` = '$mt_11_vi'";
                                    if($trangthai == 1) $whe .= " AND `showhi` = 1";
                                    else if($trangthai == 2) $whe .= " AND `showhi` = 0";
                                    else if($trangthai == 3) $whe .= " AND `diem` <> 0";
                                    else if($trangthai == 4) $whe .= " AND `diem` = 0";
                                        
                                    
                                    if($ksearch != ''){
                                        $whe .= " AND (`email` LIKE '%".$ksearch."%' OR `sodienthoai` LIKE '%".$ksearch."%' OR `hoten` LIKE '%".$ksearch."%' OR `diachi` LIKE '%".$ksearch."%') ";
                                    }
                                    $numview        = 20;


                                    $pz  = 0;
                                    $pzz = 0;
                                    $uri = "";
                                    if(isset($_GET['pz'])){
                                      $pz       = $_GET['pz'];
                                      if($pz    == "" || $pz == 0)  $pzz = 0;
                                      else $pzz = $pz * $numview;
                                    }
                                    if($mt_11_vi != ""){
                                      $uri .= '&hien-thi='.$mt_11_vi;
                                    }

                                    if($ksearch != ""){
                                      $uri .= '&ksearch='.str_replace(" ", "+", $ksearch);
                                    }

                                    if($trangthai != ""){
                                      $uri             .= '&trang-thai='.$trangthai;
                                    }
                                    if($s_chude != ""){
                                      $uri             .= '&chu-de='.$s_chude;
                                    }


                                    $sql            = DB_que("SELECT * FROM `$table` WHERE `phanquyen` = 0 $whe ORDER BY `id` DESC LIMIT $pzz,$numview");
                                    $sql_num        = DB_que("SELECT * FROM `$table` WHERE `phanquyen` = 0 $whe ");
                                    $numlist        = @mysql_num_rows($sql_num);
                                    $numshow        = ceil($numlist/$numview);

                                    $cl = 0;
                                    $i = $pzz;
                                    while($rows = mysql_fetch_assoc($sql))
                                    {
                                        $i++;
                                        $ida                = $rows['id'];
                                        $email              = SHOW_text($rows['email']);
                                        $hoten              = SHOW_text($rows['hoten']);
                                        $sodienthoai        = SHOW_text($rows['sodienthoai']);
                                        $showhi             = SHOW_text($rows['showhi']);
                                        $diem             = SHOW_text($rows['diem']);
                                        $keypass            = md5(SHOW_text($rows['keypass']));

                                ?>
                                <tr>
                                    <td class="text-center">
                                      <input name='xoa_gr_arr_<?=$cl?>' type='checkbox' class='minimal cls_showxoa'>
                                    </td>
                                    <td class="text-center">
                                        <?=$cl+1 ?>
                                        <input name="idme<?=$cl?>" value="<?=$ida?>" type="hidden">
                                    </td>
                                    <td>
                                        <?=$email ?></br>
                                    </td> 
                                    <td class="text-center">
                                      <div id="cus" class="cus_menu">
                                        <label><input type="checkbox" name="showhi_<?=$cl ?>" value="1" <?=(($showhi == 1) ? "checked='checked'" : "" )?> class="minimal"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?=$url_page ?>&edit=<?=$ida?>" title="Cập nhật"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="<?=$url_page.'&del=ok&catalogid='.$ida.'&token='.GET_token() ?>" class="do" title="Xóa" onclick="return confirm('Bạn thật sự muốn xóa?')"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                        <?
                                $cl++;
                            }
                        ?> 
                            </tbody>
                        </table>
                    </div>
                    <div class="box-header">
                        <div class="paging_simple_numbers">
                            <ul class="pagination">
                              <?php
                                PHANTRANG_admin($numshow, $url_page, $pz, $uri);
                              ?>
                            </ul>
                          </div>
                        <input type='hidden' value='<?=$cl?>' name='maxvalu'>
                        <h3 class="box-title box-title-td pull-right">
                            <button type="submit" name="addgiatri" class="btn btn-primary"  onclick="return CHECK_delimg()"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
                            <a href="<?=$url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                        </h3>
                    </div>
                    <!--  -->
                </div>
            </section>
        </div>
    </section>
</form>
<?php } ?>
<script type="text/javascript">
    function ADD_DIEM(id, loai) {
        var diem = $(".add_diem_"+id).val();
        diem     = parseInt(diem);
        if(loai == "+")diem = diem + 1000;
        else diem = diem - 1000;
        $(".add_diem_"+id).val(diem);
    }
</script>