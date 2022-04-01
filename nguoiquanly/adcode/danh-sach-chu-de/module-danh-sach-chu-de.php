<?php
  if(isset($_GET['upload']) && (isset($_GET['edit']) && is_numeric($_GET['edit']))){
      include "module-danh-sach-chu-de-upload.php";
  }
  else if(isset($_GET['them-moi']) || (isset($_GET['edit']) && is_numeric($_GET['edit']))){
      include "module-danh-sach-chu-de-add.php";
  }else{
    $table      = '#_danhmuc';
    $table_slug = str_replace("#_", "", $table);
    if(isset($_GET['del']))
    {
      $sql_se   = DB_que("SELECT * FROM `$table` WHERE `id`='".$_GET['catalogid']."' LIMIT 1"); 

      if(mysql_num_rows($sql_se) > 0)
      {
        $icon         = @mysql_result($sql_se,0,'icon');
        $duongdantin  = @mysql_result($sql_se,0,'duongdantin');
        $del_name     = @mysql_result($sql_se,0,'tenbaiviet_vi');
        $id           = @mysql_result($sql_se,0,'id');

        @unlink("../".$duongdantin."/".$icon);
        @unlink("../".$duongdantin."/thumb_".$icon);

        DB_que("DELETE FROM `#_slug` WHERE `id_bang`='".$_GET['catalogid']."' AND `bang` = '$table_slug' LIMIT 1");
        DB_que("DELETE FROM $table WHERE `id` ='".$_GET['catalogid']."' LIMIT 1");
        //xoa pr child
        $sql_se_c1    = DB_que("SELECT * FROM `$table` WHERE `id_parent`='".$_GET['catalogid']."'");
        while ($row_1   = mysql_fetch_array($sql_se_c1)) 
          {
            @unlink("../".$row_1['duongdantin']."/".$row_1['icon']);
            @unlink("../".$row_1['duongdantin']."/thumb_".$row_1['icon']);
            DB_que("DELETE from `#_slug` WHERE `id_bang` = '".$row_1['id']."' AND `bang` = '$table_slug' LIMIT 1");
            DB_que("DELETE from $table WHERE `id`  = '".$row_1['id']."' LIMIT 1");
            //xoa cap 2
            $sql_se_c2    = DB_que("SELECT * FROM `$table` WHERE `id_parent`='".$row_1['id']."'");
            while ($row_2   = mysql_fetch_array($sql_se_c2)) 
              {
                @unlink("../".$row_2['duongdantin']."/".$row_2['icon']);
                @unlink("../".$row_2['duongdantin']."/thumb_".$row_2['icon']);
                DB_que("DELETE from `#_slug` WHERE `id_bang` = '".$row_2['id']."' AND `bang` = '$table_slug' LIMIT 1");
                DB_que("DELETE from $table WHERE `id`  = '".$row_2['id']."' LIMIT 1");
                //xoa cap 3
                $sql_se_c3    = DB_que("SELECT * FROM `$table` WHERE `id_parent`='".$row_2['id']."'");
                while ($row_3 = mysql_fetch_array($sql_se_c3)) 
                  {
                    @unlink("../".$row_3['duongdantin']."/".$row_3['icon']);
                    @unlink("../".$row_3['duongdantin']."/thumb_".$row_3['icon']);
                    DB_que("DELETE from `#_slug` WHERE `id_bang`='".$row_3['id']."' AND `bang` = '$table_slug' LIMIT 1");
                    DB_que("DELETE FROM $table WHERE `id` = '".$row_3['id']."' LIMIT 1");
                    //xoa cap 3
                    $sql_se_c4    = DB_que("SELECT * FROM `$table` WHERE `id_parent`='".$row_3['id']."'");
                    while ($row_4   = mysql_fetch_array($sql_se_c4)) 
                      {
                        @unlink("../".$row_4['duongdantin']."/".$row_4['icon']);
                        @unlink("../".$row_4['duongdantin']."/thumb_".$row_4['icon']);
                        DB_que("DELETE FROM `#_slug` WHERE `id_bang`='".$row_4['id']."' AND `bang` = '$table_slug' LIMIT 1");
                        DB_que("DELETE FROM $table WHERE `id` = '".$row_4['id']."' LIMIT 1");
                      }
                    //end
                  }
                //end
              }
            //end
          }
        //
        $_SESSION['show_message_on'] = 'Xóa chủ đề [<strong>'.$del_name.'</strong>] thành công';
      } else $_SESSION['show_message_off'] = 'Dữ liệu không hợp lệ!';
      LOCATION_js($url_page."&step=".@$step."&id_step=".@$id_step);
      exit();
    }

    if(isset($_REQUEST['addgiatri']) AND isset($_REQUEST['maxvalu']))
      {
        for($i=1;$i <= $_REQUEST['maxvalu'];$i++)
          {
            $idofme     = $_POST["idme$i"];
            $sort       = str_replace(".", "", $_POST["sortby$i"]);
            $ncata_vi   = isset($_POST["ncata_vi$i"]) ? $_POST["ncata_vi$i"] : '';
            $ncata_en   = isset($_POST["ncata_en$i"]) ? $_POST["ncata_en$i"] : '';
            $ncata_cn   = isset($_POST["ncata_cn$i"]) ? $_POST["ncata_cn$i"] : '';
            $opt        = isset($_POST["opt_$i"]) ? "1": "0";
            $showhi     = isset($_POST["showhi_$i"]) ? "1": "0"; 

            $admin_que  = "";
            if(isset($_SESSION['admin'])){
              $id_parent  = $_POST["id_parent$i"];
              $admin_que  = ",`id_parent` = '$id_parent'";
            }
            if(isset($_POST["xoa_gr_arr_$i"])){
              //xoa
              $sql_se   = DB_que("SELECT * FROM `$table` WHERE `id`='".$idofme."' LIMIT 1"); 

              if(mysql_num_rows($sql_se) > 0)
              {
                $icon         = @mysql_result($sql_se,0,'icon');
                $duongdantin  = @mysql_result($sql_se,0,'duongdantin');
                $del_name     = @mysql_result($sql_se,0,'tenbaiviet_vi');
                $id           = @mysql_result($sql_se,0,'id');

                @unlink("../".$duongdantin."/".$icon);
                @unlink("../".$duongdantin."/thumb_".$icon);

                DB_que("DELETE FROM `#_slug` WHERE `id_bang`='".$idofme."' AND `bang` = '$table_slug' LIMIT 1");
                DB_que("DELETE FROM $table WHERE `id` ='".$idofme."' LIMIT 1");
                //xoa pr child
                $sql_se_c1    = DB_que("SELECT * FROM `$table` WHERE `id_parent`='".$idofme."'");
                while ($row_1   = mysql_fetch_array($sql_se_c1)) 
                  {
                    @unlink("../".$row_1['duongdantin']."/".$row_1['icon']);
                    @unlink("../".$row_1['duongdantin']."/thumb_".$row_1['icon']);
                    DB_que("DELETE from `#_slug` WHERE `id_bang` = '".$row_1['id']."' AND `bang` = '$table_slug' LIMIT 1");
                    DB_que("DELETE from $table WHERE `id`  = '".$row_1['id']."' LIMIT 1");
                    //xoa cap 2
                    $sql_se_c2    = DB_que("SELECT * FROM `$table` WHERE `id_parent`='".$row_1['id']."'");
                    while ($row_2   = mysql_fetch_array($sql_se_c2)) 
                      {
                        @unlink("../".$row_2['duongdantin']."/".$row_2['icon']);
                        @unlink("../".$row_2['duongdantin']."/thumb_".$row_2['icon']);
                        DB_que("DELETE from `#_slug` WHERE `id_bang` = '".$row_2['id']."' AND `bang` = '$table_slug' LIMIT 1");
                        DB_que("DELETE from $table WHERE `id`  = '".$row_2['id']."' LIMIT 1");
                        //xoa cap 3
                        $sql_se_c3    = DB_que("SELECT * FROM `$table` WHERE `id_parent`='".$row_2['id']."'");
                        while ($row_3 = mysql_fetch_array($sql_se_c3)) 
                          {
                            @unlink("../".$row_3['duongdantin']."/".$row_3['icon']);
                            @unlink("../".$row_3['duongdantin']."/thumb_".$row_3['icon']);
                            DB_que("DELETE from `#_slug` WHERE `id_bang`='".$row_3['id']."' AND `bang` = '$table_slug' LIMIT 1");
                            DB_que("DELETE FROM $table WHERE `id` = '".$row_3['id']."' LIMIT 1");
                            //xoa cap 3
                            $sql_se_c4    = DB_que("SELECT * FROM `$table` WHERE `id_parent`='".$row_3['id']."'");
                            while ($row_4   = mysql_fetch_array($sql_se_c4)) 
                              {
                                @unlink("../".$row_4['duongdantin']."/".$row_4['icon']);
                                @unlink("../".$row_4['duongdantin']."/thumb_".$row_4['icon']);
                                DB_que("DELETE FROM `#_slug` WHERE `id_bang`='".$row_4['id']."' AND `bang` = '$table_slug' LIMIT 1");
                                DB_que("DELETE FROM $table WHERE `id` = '".$row_4['id']."' LIMIT 1");
                              }
                            //end
                          }
                        //end
                      }
                    //end
                  }
                //
              }
              //
            }else{
              DB_que("UPDATE `$table` SET `tenbaiviet_vi`='$ncata_vi', `tenbaiviet_en`='$ncata_en', `tenbaiviet_cn`='$ncata_cn', `catasort`='$sort', `opt` = '$opt',`showhi`='$showhi' $admin_que WHERE `id`='$idofme' LIMIT 1");
            }
          }
          $_SESSION['show_message_on'] = 'Cập nhật dữ liệu thành công!';
      }


    $sql        = DB_que("SELECT * FROM `$table` WHERE  `step` = '".$step."' ORDER BY `catasort` ASC ");
    $sql_array  =  array();
    while ($r   = mysql_fetch_assoc($sql)) {
      $sql_array[] = $r;
    }
    $list_bv_img = DB_fet("*", "#_danhmuc_img",'','`id` ASC', '', 'arr');
?>
<section class="content-header">
    <h1> Danh sách chủ đề</h1> 
    <ol class="breadcrumb">
        <li><a href="<?=$fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Danh sách chủ đề</li>
    </ol>
</section>

<form action="" method="post">
    <section class="content">
        <div class="row">
            <section class="col-lg-12">
                <?php include _source."mesages.php"; ?>
                <div class="box">
                    <div class="box-header">
                      <h2 class="h2_title">
                          <i class="fa fa-pencil-square-o"></i> <?=GETNAME_step($step)?>
                      </h2>
                        <h3 class="box-title box-title-td pull-right">
                          <button type="submit" name="addgiatri" class="btn btn-primary" onclick="return CHECK_name_emty()"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
                          <a href="<?=$url_page ?>&them-moi=true&step=<?=$step?>&id_step=<?=$id_step?>" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                        </h3>
                    </div>
                    <div class="box-body table-responsive no-padding table-danhsach-cont">
                      <table class="table table-hover table-danhsach">
                        <tbody>
                          <tr>
                            <th class="w50 text-center">
                              <label>
                                <input type='checkbox' class='minimal cls_showxoa_all'> Xóa
                                <input type="hidden" name="token" value="<?=GET_token() ?>">
                              </label>
                            </th>
                            <th class="w80 text-center">STT</th>
                            <th>Tiêu đề</th>
                            <th class="w100 text-center">Hình ảnh</th>
                            <?php 
                              $check_trangchu =CHECK_key_setting("danh-muc-trang-chu");
                              if($check_trangchu){
                            ?>
                            <th class="w100 text-center">Tiêu biểu</th>
                            <?php } ?>
                            <th class="w100 text-center">Hiển thị</th>
                            <th class="w120 text-center">Tác vụ</th>
                          </tr>
                          <?php
                            $cl                 = 0;
                            $token              = GET_token();
                            foreach ($sql_array as $rows) 
                            {
                              if($rows['id_parent'] != 0) continue;
                              $cl++;

                              $ida                = SHOW_text($rows['id']);
                              $tenbaiviet_vi      = SHOW_text($rows['tenbaiviet_vi']);
                              $tenbaiviet_en      = SHOW_text($rows['tenbaiviet_en']);
                              $tenbaiviet_cn      = SHOW_text($rows['tenbaiviet_cn']);
                              $icon               = SHOW_text($rows['icon']);
                              $catasort           = number_format(SHOW_text($rows['catasort']),0,',','.');
                              $id_parent          = SHOW_text($rows['id_parent']);
                              $opt                = SHOW_text($rows['opt']);
                              $showhi             = SHOW_text($rows['showhi']);

                              $soluonganh_con = 0;
                              if(is_array($list_bv_img)){
                                foreach ($list_bv_img as $val) {
                                  if($val['id_parent'] == $ida) $soluonganh_con++;
                                }  
                              }
                          ?>
                          <tr>
                            <td class="text-center">
                              <input name='xoa_gr_arr_<?=$cl?>' type='checkbox' class='minimal cls_showxoa'>

                            </td>
                            <td class="text-center">
                              <input name="idme<?=$cl?>" value="<?=$ida?>" type="hidden">
                              <input type="text" class="text-center" name="sortby<?=$cl?>" value="<?=$catasort?>" onkeyup="SetCurrency(this)">
                            </td>
                            
                            <td>
                              <div class="name">
                                <input type="text" class="cls_emty_name" name="ncata_vi<?=$cl?>" value="<?=$tenbaiviet_vi?>"   placeholder="Tiêu đề (<?=_lang_nb1_key ?>)">
                              </div>
                              <?php if($lang_nb2){ ?>
                              <div class="name">
                                <input type="text" class="" name="ncata_en<?=$cl?>" value="<?=$tenbaiviet_en?>"   placeholder="Tiêu đề (<?=_lang_nb2_key ?>)">
                              </div>
                              <?php } ?>
                              <?php if($lang_nb3){ ?>
                              <div class="name">
                                <input type="text" class="" name="ncata_cn<?=$cl?>" value="<?=$tenbaiviet_cn?>"   placeholder="Tiêu đề (<?=_lang_nb3_key ?>)">
                              </div>
                              <?php } ?>
                              <?php if(CHECK_key_array(43, $step)){ ?>
                              <p style="margin: 5px 0;"><a href="?module=<?=$module ?>&action=<?=$action ?>&edit=<?=$ida?>&step=<?=$step?>&id_step=<?=$id_step?>&upload=true">[Hình ảnh] [<?=$soluonganh_con ?>]</a></p>
                              <?php } ?>
                              <?php if(isset($_SESSION['admin'])){ ?>
                              <?=LAY_chude($id_parent, $step, 'id_parent'.$cl, 'form-control', 0, $id_step, $ida, 'true', 0) ?>
                              <?php } ?>
                            </td>
                            <td class="text-center">
                              <img class='img_show_ds' src='<?=$fullpath."/".$rows['duongdantin']."/thumb_".$icon ?>'>
                            </td>
                            <?php if($check_trangchu){ ?>
                            <td class="text-center">
                              <div id="cus" class="cus_menu">
                                <label><input name='opt_<?=$cl?>' opt type='checkbox' class='minimal' value='1' <?=LAY_checked($opt, 1)?>></label>
                              </div>
                            </td>
                            <?php } ?>
                            <td class="text-center">
                              <div id="cus" class="cus_menu">
                                <label><input type="checkbox" class='minimal' name="showhi_<?=$cl ?>" value="1" <?=(($showhi == 1) ? "checked='checked'" : "" )?> ></label>
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="<?=$url_page ?>&step=<?=$step?>&id_step=<?=$id_step?>&edit=<?=$ida?>" title="<?=luu_lai ?>"><i class="fa fa-pencil-square-o"></i></a>
                                <a href="<?=$url_page.'&del=ok&catalogid='.$ida.'&token='.$token ?>&step=<?=$step?>&id_step=<?=$id_step?>" class="do" title="Xóa" onclick="return confirm('Bạn thật sự muốn xóa?')"><i class="fa fa-times"></i></a>
                            </td>
                          </tr>
                          <!-- c1 -->
                          <?php 
                            foreach ($sql_array as $rows_1) 
                            {
                              if($rows_1['id_parent'] != $rows['id']) continue;
                              $cl++;
                              $ida_1                = SHOW_text($rows_1['id']);
                              $tenbaiviet_vi_1      = SHOW_text($rows_1['tenbaiviet_vi']);
                              $tenbaiviet_en_1      = SHOW_text($rows_1['tenbaiviet_en']);
                              $tenbaiviet_cn_1      = SHOW_text($rows_1['tenbaiviet_cn']);
                              $icon_1               = SHOW_text($rows_1['icon']);
                              $catasort_1           = number_format(SHOW_text($rows_1['catasort']),0,',','.');
                              $id_parent_1          = SHOW_text($rows_1['id_parent']);
                              $opt_1                = SHOW_text($rows_1['opt']);
                              $showhi_1             = SHOW_text($rows_1['showhi']);

                              $soluonganh_con_1 = 0;
                              if(is_array($list_bv_img)){
                                foreach ($list_bv_img as $val) {
                                  if($val['id_parent'] == $ida_1) $soluonganh_con_1++;
                                }  
                              }
                          ?>
                          <tr>
                            <td class="text-center">
                              <input name='xoa_gr_arr_<?=$cl?>' type='checkbox' class='minimal cls_showxoa'>
                            </td>
                            <td class="text-center">
                              <input name="idme<?=$cl?>" value="<?=$ida_1?>" type="hidden">
                              <input type="text" class="text-center" name="sortby<?=$cl?>" value="<?=$catasort_1?>" onkeyup="SetCurrency(this)">
                            </td>
                            <td>
                              <span class="sp-list-cap1">╚═►</span>
                              <div class="name name_list_cap_1">
                                <input type="text" name="ncata_vi<?=$cl?>" class="cls_emty_name" value="<?=$tenbaiviet_vi_1?>"   placeholder="Tiêu đề (<?=_lang_nb1_key ?>)">
                              </div>
                              <?php if($lang_nb2){ ?>
                              <div class="name name_list_cap_1">
                                <input type="text" name="ncata_en<?=$cl?>" class="" value="<?=$tenbaiviet_en_1?>"   placeholder="Tiêu đề (<?=_lang_nb2_key ?>)">
                              </div>
                              <?php } ?>
                              <?php if($lang_nb3){ ?>
                              <div class="name name_list_cap_1">
                                <input type="text" name="ncata_cn<?=$cl?>" class="" value="<?=$tenbaiviet_cn_1 ?>"   placeholder="Tiêu đề (<?=_lang_nb3_key ?>)">
                              </div>
                              <?php } ?>
                              <?php if(CHECK_key_array(43, $step)){ ?>
                              <p style="margin: 5px 0;"><a href="?module=<?=$module ?>&action=<?=$action ?>&edit=<?=$ida_1?>&step=<?=$step?>&id_step=<?=$id_step?>&upload=true">[Hình ảnh] [<?=$soluonganh_con_1 ?>]</a></p>
                              <?php } ?>

                              <?php if(isset($_SESSION['admin'])){ ?>
                              <?=LAY_chude($id_parent_1, $step, 'id_parent'.$cl, 'form-control', 0, $id_step, $ida_1, 'true', 0) ?>
                              <?php } ?>
                            </td>
                            <td class="text-center">
                              <img class='img_show_ds' src='<?=$fullpath."/".$rows_1['duongdantin']."/thumb_".$icon_1 ?>'>
                            </td>
                            <?php if($check_trangchu){ ?>
                            <td class="text-center">
                              <div id="cus" class="cus_menu">
                                <label><input name='opt_<?=$cl?>' opt type='checkbox' class='minimal' value='1' <?=LAY_checked($opt_1, 1)?>></label>
                              </div>
                            </td>
                            <?php } ?>
                            <td class="text-center">
                              <div id="cus" class="cus_menu">
                                <label><input type="checkbox" class='minimal' name="showhi_<?=$cl ?>" value="1" <?=(($showhi_1 == 1) ? "checked='checked'" : "" )?> ></label>
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="<?=$url_page ?>&step=<?=$step?>&id_step=<?=$id_step?>&edit=<?=$ida_1?>" title="<?=luu_lai ?>"><i class="fa fa-pencil-square-o"></i></a>
                                <a href="<?=$url_page.'&del=ok&catalogid='.$ida_1.'&token='.$token ?>&step=<?=$step?>&id_step=<?=$id_step?>" class="do" title="Xóa" onclick="return confirm('Bạn thật sự muốn xóa?')"><i class="fa fa-times"></i></a>
                            </td>
                          </tr>
                            <!-- c2 -->
                            <?php 
                              foreach ($sql_array as $rows_2) 
                              {
                                if($rows_2['id_parent'] != $rows_1['id']) continue;
                                $cl++;
                                $ida_2                = SHOW_text($rows_2['id']);
                                $tenbaiviet_vi_2      = SHOW_text($rows_2['tenbaiviet_vi']);
                                $tenbaiviet_en_2      = SHOW_text($rows_2['tenbaiviet_en']);
                                $tenbaiviet_cn_2      = SHOW_text($rows_2['tenbaiviet_cn']);
                                $icon_2               = SHOW_text($rows_2['icon']);
                                $catasort_2           = number_format(SHOW_text($rows_2['catasort']),0,',','.');
                                $id_parent_2          = SHOW_text($rows_2['id_parent']);
                                $opt_2                = SHOW_text($rows_2['opt']);
                                $showhi_2             = SHOW_text($rows_2['showhi']);
                                $soluonganh_con_2 = 0;
                                if(is_array($list_bv_img)){
                                  foreach ($list_bv_img as $val) {
                                    if($val['id_parent'] == $ida_2) $soluonganh_con_2++;
                                  }  
                                }
                            ?>
                            <tr>
                              <td class="text-center">
                                <input name='xoa_gr_arr_<?=$cl?>' type='checkbox' class='minimal cls_showxoa'>
                              </td>
                              <td class="text-center">
                                <input name="idme<?=$cl?>" value="<?=$ida_2?>" type="hidden">
                                <input type="text" class="text-center" name="sortby<?=$cl?>" value="<?=$catasort_2?>" onkeyup="SetCurrency(this)">
                              </td>
                              <td>
                                <span class="sp-list-cap2">╚═►</span>
                                <div class="name name_list_cap_2">
                                  <input type="text" name="ncata_vi<?=$cl?>" class="cls_emty_name" value="<?=$tenbaiviet_vi_2?>"   placeholder="Tiêu đề (<?=_lang_nb1_key ?>)">
                                </div>
                                <?php if($lang_nb2){ ?>
                                <div class="name name_list_cap_2">
                                  <input type="text" name="ncata_en<?=$cl?>" class="" value="<?=$tenbaiviet_en_2?>"   placeholder="Tiêu đề (<?=_lang_nb2_key ?>)">
                                </div>
                                <?php } ?>
                                <?php if($lang_nb3){ ?>
                                <div class="name name_list_cap_2">
                                  <input type="text" name="ncata_cn<?=$cl?>" class="" value="<?=$tenbaiviet_cn_2?>"   placeholder="Tiêu đề (<?=_lang_nb3_key ?>)">
                                </div>
                                <?php } ?>
                                <?php if(CHECK_key_array(43, $step)){ ?>
                                <p style="margin: 5px 0;"><a href="?module=<?=$module ?>&action=<?=$action ?>&edit=<?=$ida_2?>&step=<?=$step?>&id_step=<?=$id_step?>&upload=true">[Hình ảnh] [<?=$soluonganh_con_2 ?>]</a></p>
                                <?php } ?>

                                <?php if(isset($_SESSION['admin'])){ ?>
                                <?=LAY_chude($id_parent_2, $step, 'id_parent'.$cl, 'form-control', 0, $id_step, $ida_2, 'true', 0) ?>
                                <?php } ?>
                              </td>
                              <td class="text-center">
                                <img class='img_show_ds' src='<?=$fullpath."/".$rows_2['duongdantin']."/thumb_".$icon_2 ?>'>
                              </td>
                              <?php if($check_trangchu){ ?>
                              <td class="text-center">
                                <div id="cus" class="cus_menu">
                                  <label><input name='opt_<?=$cl?>' opt type='checkbox' class='minimal' value='1' <?=LAY_checked($opt_2, 1)?>></label>
                                </div>
                              </td>
                              <?php } ?>
                              <td class="text-center">
                                <div id="cus" class="cus_menu">
                                  <label><input type="checkbox" class='minimal' name="showhi_<?=$cl ?>" value="1" <?=(($showhi_2 == 1) ? "checked='checked'" : "" )?> ></label>
                                  </div>
                              </td>
                              <td class="text-center">
                                  <a href="<?=$url_page ?>&step=<?=$step?>&id_step=<?=$id_step?>&edit=<?=$ida_2?>" title="<?=luu_lai ?>" ><i class="fa fa-pencil-square-o"></i></a>
                                  <a href="<?=$url_page.'&del=ok&catalogid='.$ida_2.'&token='.$token ?>&step=<?=$step?>&id_step=<?=$id_step?>" class="do" title="Xóa" onclick="return confirm('Bạn thật sự muốn xóa?')"><i class="fa fa-times"></i></a>
                              </td>
                            </tr>
                              <!-- c3 -->
                              <?php 
                                foreach ($sql_array as $rows_3) 
                                {
                                  if($rows_3['id_parent'] != $rows_2['id']) continue;
                                  $cl++;
                                  $ida_3                = SHOW_text($rows_3['id']);
                                  $tenbaiviet_vi_3      = SHOW_text($rows_3['tenbaiviet_vi']);
                                  $tenbaiviet_en_3      = SHOW_text($rows_3['tenbaiviet_en']);
                                  $tenbaiviet_cn_3      = SHOW_text($rows_3['tenbaiviet_cn']);
                                  $icon_3               = SHOW_text($rows_3['icon']);
                                  $catasort_3           = number_format(SHOW_text($rows_3['catasort']),0,',','.');
                                  $id_parent_3          = SHOW_text($rows_3['id_parent']);
                                  $opt_3                = SHOW_text($rows_3['opt']);
                                  $showhi_3             = SHOW_text($rows_3['showhi']);
                              ?>
                              <tr>
                                <td class="text-center">
                                  <input name='xoa_gr_arr_<?=$cl?>' type='checkbox' class='minimal cls_showxoa'>
                                </td>
                                <td class="text-center">
                                  <input name="idme<?=$cl?>" value="<?=$ida_3?>" type="hidden">
                                  <input type="text" class="text-center" name="sortby<?=$cl?>" value="<?=$catasort_3?>" onkeyup="SetCurrency(this)">
                                </td>
                                <td>
                                  <span class="sp-list-cap3">╚═►</span>
                                  <div class="name name_list_cap_3">
                                    <input type="text" name="ncata_vi<?=$cl?>" class="cls_emty_name" value="<?=$tenbaiviet_vi_3?>"  placeholder="Tiêu đề (<?=_lang_nb1_key ?>)">
                                  </div>
                                  <?php if($lang_nb2){ ?>
                                  <div class="name name_list_cap_3">
                                    <input type="text" name="ncata_en<?=$cl?>" class="" value="<?=$tenbaiviet_en_3?>"  placeholder="Tiêu đề (<?=_lang_nb2_key ?>)">
                                  </div>
                                  <?php } ?>
                                  <?php if($lang_nb3){ ?>
                                  <div class="name name_list_cap_3">
                                    <input type="text" name="ncata_cn<?=$cl?>" class="" value="<?=$tenbaiviet_cn_3?>"  placeholder="Tiêu đề (<?=_lang_nb3_key ?>)">
                                  </div>
                                  <?php } ?>
                                  <?php if(isset($_SESSION['admin'])){ ?>
                                  <?=LAY_chude($id_parent_3, $step, 'id_parent'.$cl, 'form-control', 0, $id_step, $ida_3, 'true', 0) ?>
                                  <?php } ?>
                                </td>
                                <td class="text-center">
                                  <img class='img_show_ds' src='<?=$fullpath."/".$rows_3['duongdantin']."/thumb_".$icon_3 ?>'>
                                </td>
                                <?php if($check_trangchu){ ?>
                                <td class="text-center">
                                  <div id="cus" class="cus_menu">
                                    <label><input name='opt_<?=$cl?>' type='checkbox' class='minimal' value='1' <?=LAY_checked($opt_3, 1)?>></label>
                                  </div>
                                </td>
                                <?php } ?>
                                <td class="text-center">
                                  <div id="cus" class="cus_menu">
                                    <label><input type="checkbox" class='minimal' name="showhi_<?=$cl ?>" value="1" <?=(($showhi_3 == 1) ? "checked='checked'" : "" )?> ></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="<?=$url_page ?>&step=<?=$step?>&id_step=<?=$id_step?>&edit=<?=$ida_3?>" title="<?=luu_lai ?>" ><i class="fa fa-pencil-square-o"></i></a>
                                    <a href="<?=$url_page.'&del=ok&catalogid='.$ida_3.'&token='.$token ?>&step=<?=$step?>&id_step=<?=$id_step?>" class="do"  onclick="return confirm('Bạn thật sự muốn xóa?')"><i class="fa fa-times"></i></a>
                                </td>
                              </tr>
                              <?php } ?>
                              <!--  -->
                            <?php } ?>
                            <!--  -->
                          <?php } ?>
                          <!--  -->
                        <?php  } ?> 
                        </tbody>
                      </table>
                      <input type='hidden' value='<?=$cl?>' name='maxvalu'>
                    </div>
                    <div class="box-header">
                      <h3 class="box-title box-title-td pull-right">
                          <button type="submit" name="addgiatri" class="btn btn-primary" onclick="return CHECK_name_emty()"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
                          <a href="<?=$url_page ?>&them-moi=true&step=<?=$step?>&id_step=<?=$id_step?>" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                      </h3>
                    </div>
                    <!--  -->
                </div>
            </section>
        </div>
    </section>
</form>
<?php } ?>