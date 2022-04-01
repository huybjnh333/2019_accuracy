<?php
  if($_SESSION['phanquyen'] != 1)
  {
    LOCATION_js("index.php");
    exit();
  }
  if(isset($_GET['upload']) && (isset($_GET['edit']) && is_numeric($_GET['edit']))){
      include "module-danh-sach-main-menu-upload.php";
  }
  else if(isset($_GET['them-moi']) || (isset($_GET['edit']) && is_numeric($_GET['edit']))){
      include "module-danh-sach-main-menu-add.php";
  }
  else{
    $table      = '#_step';
    $table_slug = str_replace("#_", "", $table);
    if(isset($_GET['del']) && isset($_GET['catalogid']) && isset($_SESSION['admin']))
      {
        $sql_se   = DB_que("SELECT * FROM `$table` WHERE `id`='".$_GET['catalogid']."' LIMIT 1"); 
        if(mysql_num_rows($sql_se) > 0)
        {
          $del_name = @mysql_result($sql_se,0,'tenbaiviet_vi');
          @unlink("../".@mysql_result($sql_se,0,'duongdantin')."/".@mysql_result($sql_se,0,'icon'));
          @unlink("../".@mysql_result($sql_se,0,'duongdantin')."/thumb_".@mysql_result($sql_se,0,'icon'));

          DB_que("DELETE FROM $table WHERE `id` ='".@$_GET['catalogid']."' LIMIT 1");
          DB_que("DELETE FROM `#_slug` WHERE `bang` = '$table_slug' AND `id_bang` = ".@mysql_result($sql_se,0,'id')." LIMIT 1");
          $_SESSION['show_message_on'] = 'Đã xóa [<strong>'.$del_name.'</strong>] thành công!';

          // Xóa ảnh con
          $sql_img    = DB_que("SELECT * FROM `#_step_img` WHERE `id_parent` ='".$_GET['catalogid']."'");
          if(mysql_num_rows($sql_img) > 0)
          {
            while($row = mysql_fetch_assoc($sql_img))
            {
              $p_name   = $row['p_name'];
              $path_img = $row['duongdantin'];
              @unlink("../datafiles/".$path_img."/".$p_name);
              @unlink("../datafiles/".$path_img."/thumb_".$p_name);
            }
            DB_que("DELETE FROM `#_step_img` WHERE `id_parent` = '".$_GET['catalogid']."'");;
          }
          // End xóa ảnh con  
        }
        else $_SESSION['show_message_off'] = 'Dữ liệu không hợp lệ!';
        LOCATION_js($url_page);
        exit();
      }

    if(isset($_REQUEST['addgiatri']) AND $_REQUEST['maxvalu'])
      {
        for($i=0; $i < $_REQUEST['maxvalu']; $i++)
          {
            $idofme     = @$_POST["idme$i"];
            $sort       = str_replace(".", "", $_POST["sortby$i"]);
            $ncata_vi   = @isset($_POST["ncata_vi$i"]) ? $_POST["ncata_vi$i"] : '';
            $ncata_en   = @isset($_POST["ncata_en$i"]) ? $_POST["ncata_en$i"] : '';
            $ncata_cn   = @isset($_POST["ncata_cn$i"]) ? $_POST["ncata_cn$i"] : '';
            
            $option_1   = isset($_POST["opt_1_$i"]) ? "1": "0";
            $option_2   = isset($_POST["opt1_1_$i"]) ? "1": "0";
            $showhi     = isset($_POST["showhi_$i"]) ? "1": "0";

            $add_admin = "";
            if(isset($_SESSION['admin'])){
              $size_img   = @$_POST["size_img$i"];
              $add_admin .= ", `size_img` = '$size_img'";

              $size_img_dm   = @$_POST["size_img_dm$i"];
              $add_admin    .= ", `size_img_dm` = '$size_img_dm'";
            }
            
            DB_que("UPDATE `$table` SET `tenbaiviet_vi`='$ncata_vi',`tenbaiviet_en`='$ncata_en',`tenbaiviet_cn`='$ncata_cn',`catasort`='$sort',`opt` = '$option_1', `opt1` = '$option_2', `showhi` = '$showhi' $add_admin WHERE `id`='$idofme' limit 1");
          }
        $_SESSION['show_message_on'] = 'Cập nhật dữ liệu thành công!';
      }


      $sql         = DB_que("SELECT * FROM `$table`  ORDER BY `catasort` ASC");
      $check_foot  = CHECK_key_setting("main-menu-footer");
      $list_bv_img = DB_fet("*", "#_step_img",'','`id` ASC', '', 'arr');                    
?>

<section class="content-header">
    <h1>Main module</h1> 
    <ol class="breadcrumb">
        <li><a href="<?=$fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Quản lý main module</li>
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
                        <h2 class="h2_title">
                            <i class="fa fa-pencil-square-o"></i> Danh sách
                        </h2>
                        <h3 class="box-title box-title-td pull-right">
                          <button type="submit" name="addgiatri" class="btn btn-primary" onclick="return CHECK_name_emty()"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
                          <?php
                            if(isset($_SESSION['admin'])) echo '<a href="?module='.$module.'&action='.$action.'&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i>Thêm mới</a>';
                          ?>
                        </h3>
                    </div>
                    <div class="box-body table-responsive no-padding table-danhsach-cont">
                      <table class="table table-hover table-danhsach">
                        <tbody>
                          <tr>
                            <th class="w80 text-center">STT</th>
                            <th>Tiêu đề</th>
                            <th class="w80 text-center">Hình ảnh</th>
                            <!-- <th class="w80 text-center">Menu </th> -->
                            <?php if($check_foot){ ?>
                            <th class="w80 text-center">Footer </th>
                            <?php } ?>
                            <th class="w80 text-center">Hiển thị</th>
                            <th class="w100 text-center">Tác vụ</th>
                          </tr>
                    <?php
                      $cl = 0;
                      

                      while($rows = mysql_fetch_array($sql))
                      {
                        $ida                = SHOW_text($rows['id']);
                        $tenbaiviet_vi      = SHOW_text($rows['tenbaiviet_vi']);
                        $tenbaiviet_en      = SHOW_text($rows['tenbaiviet_en']);
                        $tenbaiviet_cn      = SHOW_text($rows['tenbaiviet_cn']);
                        $icon               = SHOW_text($rows['icon']);
                        $catasort           = number_format(SHOW_text($rows['catasort']),0,',','.');

                        $step               = SHOW_text($rows['step']);
                        $showhi             = SHOW_text($rows['showhi']);
                        $size_img           = SHOW_text($rows['size_img']);
                        $size_img_dm        = SHOW_text($rows['size_img_dm']);

                        $soluonganh_con = 0;
                        if(is_array($list_bv_img)){
                          foreach ($list_bv_img as $val) {
                            if($val['id_parent'] == $ida) $soluonganh_con++;
                          }  
                        }
                    ?>
                          <tr >
                            <td class="text-center">
                              <input name="idme<?=$cl?>" value="<?=$ida?>" type="hidden">
                              <input type="text" class="text-center" name="sortby<?=$cl?>" value="<?=$catasort?>" onkeyup="SetCurrency(this)">
                            </td>
                            
                            <td>
                              <div class="name">
                                <input type="text" name="ncata_vi<?=$cl?>" class="cls_emty_name" value="<?=$tenbaiviet_vi?>" placeholder="Tiêu đề (<?=_lang_nb1_key ?>)">
                              </div>
                              <?php if($lang_nb2){ ?>
                              <div class="name" id="en">
                                <input type="text" name="ncata_en<?=$cl?>" class="cls_emty_name" value="<?=$tenbaiviet_en ?>" placeholder="Tiêu đề (<?=_lang_nb2_key ?>)">
                              </div>
                              <?php } ?>
                              <?php if($lang_nb3){ ?>
                              <div class="name" id="en">
                                <input type="text" name="ncata_cn<?=$cl?>" class="cls_emty_name" value="<?=$tenbaiviet_cn ?>" placeholder="Tiêu đề (<?=_lang_nb3_key ?>)">
                              </div>
                              <?php } ?>

                              <?php if(CHECK_key_setting("main-menu-anh-slider")){ ?>
                              <p style="margin: 5px 0;"><a href="?module=<?=$module ?>&action=<?=$action ?>&edit=<?=$ida?>&step=<?=$step?>&upload=true">[Ảnh slider] [<?=$soluonganh_con ?>]</a></p>
                              <?php } ?>

                              <?php  if(isset($_SESSION['admin'])) { ?>
                                  <div class="name" id="en">
                                    <input type="text" name="size_img<?=$cl?>" class="" value="<?=$size_img ?>" placeholder="Kích thước ảnh bài viết" >
                                  </div>
                                  <p style="padding: 0; margin: 0"><?php 
                                      if(trim($size_img) != ''){
                                        $file = "images/trang_".str_replace("x", "_", trim($size_img)).".png";
                                        if(is_file($file)){
                                          echo '<span style="font-size: 12px; color: #2247fd; display: block; margin: 4px 0px 0;">File OK<span>';
                                        }else{
                                          echo '<span style="font-size: 12px; color: #ff1212; display: block; margin: 4px 0px 0;">File không tồn tại<span>';
                                        }
                                      }
                                  ?></p>
                                  <div class="name" id="en">
                                    <input type="text" name="size_img_dm<?=$cl?>" class="" value="<?=$size_img_dm ?>" placeholder="Kích thước ảnh danh mục" >
                                  </div>
                                  <p style="padding: 0; margin: 0"><?php 
                                      if(trim($size_img_dm) != ''){
                                        $file = "images/trang_".str_replace("x", "_", trim($size_img_dm)).".png";
                                        if(is_file($file)){
                                          echo '<span style="font-size: 12px; color: #2247fd; display: block; margin: 4px 0px 0;">File OK<span>';
                                        }else{
                                          echo '<span style="font-size: 12px; color: #ff1212; display: block; margin: 4px 0px 0;">File không tồn tại<span>';
                                        }
                                      }
                                  ?></p>
                              <?php } ?>
                            </td>
                            <td class="text-center">
                              <img class='img_show_ds' src='<?=$fullpath."/".$rows['duongdantin']."/thumb_".$icon ?>'>
                            </td>
                            <!-- <td class="text-center">
                              <div id="cus" class="cus_menu">
                                <label ><input type="checkbox" name="opt_1_<?=$cl ?>" value="1" <?=(($rows['opt'] == 1) ? "checked='checked'" : "" )?> class="minimal"></label>
                                </div>
                            </td> -->
                            <?php if($check_foot){ ?>
                            <td class="text-center">
                              <div id="cus" class="cus_menu">
                              	<label ><input type="checkbox" name="opt1_1_<?=$cl ?>" value="1" <?=(($rows['opt1'] == 1) ? "checked='checked'" : "" )?>  class="minimal"></label>
                                </div>
                            </td>
                            <?php } ?>

                            <td class="text-center">
                              <div id="cus" class="cus_menu">
                                <label><input type="checkbox" name="showhi_<?=$cl ?>" value="1" <?=(($showhi == 1) ? "checked='checked'" : "" )?>  class="minimal"></label>
                                </div>
                            </td>
                            <td class="text-center">
                                <div id="cus" class="cus_menu">
                                <a href="?module=<?=$module ?>&action=<?=$action ?>&edit=<?=$ida?>&step=<?=$step?>"><i class="fa fa-pencil-square-o"></i></a>
                                <?php  if(isset($_SESSION['admin'])) { ?>
                                    <a href="<?=$url_page.'&del=ok&catalogid='.$ida.'&token='.GET_token() ?>" class="do" title="Xóa" onclick="return confirm('Bạn thật sự muốn xóa?')"><i class="fa fa-times"></i></a>
                                <?php } ?>
                                </div>
                            </td>
                          </tr>
                    <?php
                          $cl++;
                        }
                    ?> 
                        </tbody>
                      </table>
                      <input type='hidden' value='<?=$cl?>' name='maxvalu'>
                    </div>
                    <div class="box-header">
                      <h3 class="box-title box-title-td pull-right">
                          <button type="submit" name="addgiatri" class="btn btn-primary" onclick="return CHECK_name_emty()"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
                          <?php
                            if(isset($_SESSION['admin'])) echo '<a href="?module='.$module.'&action='.$action.'&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i>Thêm mới</a>';
                          ?>
                      </h3>
                    </div>
                    <!--  -->
                </div>
            </section>
        </div>
    </section>
</form>
<?php } ?>