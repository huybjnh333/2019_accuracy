<?php
  if(isset($_GET['noi-dung']) && (isset($_GET['edit']) && is_numeric($_GET['edit']))){
      include "module-form-lien-he-danh-sach-add.php";
  }
  else if(isset($_GET['them-moi']) || (isset($_GET['edit']) && is_numeric($_GET['edit']))){
      include "module-form-lien-he-add.php";
  }
   
  else if(isset($_GET['noi-dung'])){
      include "module-form-lien-he-danh-sach.php";
  }
  else{
    $table      = '#_form_danhmuc';
    $table_slug = str_replace("#_", "", $table);
    if(isset($_GET['del']))
    {
      $sql_se   = DB_que("SELECT * FROM `$table` WHERE `id`='".$_GET['catalogid']."' LIMIT 1"); 

      if(mysql_num_rows($sql_se) > 0)
      {
        DB_que("DELETE FROM $table WHERE `id` ='".$_GET['catalogid']."' LIMIT 1");
        //xoa pr child
        $sql_se_c1    = DB_que("SELECT * FROM `$table` WHERE `id_parent`='".$_GET['catalogid']."'");
        while ($row_1   = mysql_fetch_array($sql_se_c1)) 
          {
            DB_que("DELETE from $table WHERE `id`  = '".$row_1['id']."' LIMIT 1");
            //xoa cap 2
            $sql_se_c2    = DB_que("SELECT * FROM `$table` WHERE `id_parent`='".$row_1['id']."'");
            while ($row_2   = mysql_fetch_array($sql_se_c2)) 
              {
                DB_que("DELETE from $table WHERE `id`  = '".$row_2['id']."' LIMIT 1");
                //xoa cap 3
                $sql_se_c3    = DB_que("SELECT * FROM `$table` WHERE `id_parent`='".$row_2['id']."'");
                while ($row_3 = mysql_fetch_array($sql_se_c3)) 
                  {
                    DB_que("DELETE FROM $table WHERE `id` = '".$row_3['id']."' LIMIT 1");
                    //xoa cap 3
                    $sql_se_c4    = DB_que("SELECT * FROM `$table` WHERE `id_parent`='".$row_3['id']."'");
                    while ($row_4   = mysql_fetch_array($sql_se_c4)) 
                      {
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
      LOCATION_js($url_page);
      exit();
    }

    if(isset($_REQUEST['addgiatri']) AND isset($_REQUEST['maxvalu']))
      {
        for($i=1;$i <= $_REQUEST['maxvalu'];$i++)
          {
            $idofme     = $_POST["idme$i"];
            $sort       = str_replace(".", "", $_POST["sortby$i"]);
            $ncata_vi   = $_POST["ncata_vi$i"];
            $ncata_en   = @$_POST["ncata_en$i"];
            $thuoc_bai_viet   = @$_POST["thuoc_bai_viet$i"];
            $showhi     = isset($_POST["showhi_$i"]) ? "1": "0";

            if(isset($_POST["xoa_gr_arr_$i"])){
              //xoa
              $sql_se   = DB_que("SELECT * FROM `$table` WHERE `id`='".$idofme."'  LIMIT 1"); 

              if(mysql_num_rows($sql_se) > 0)
              {
                DB_que("DELETE FROM $table WHERE `id` ='".$idofme."' LIMIT 1");
                //xoa pr child
                $sql_se_c1    = DB_que("SELECT * FROM `$table` WHERE `id_parent`='".$idofme."'");
                while ($row_1   = mysql_fetch_array($sql_se_c1)) 
                  {
                    DB_que("DELETE from $table WHERE `id`  = '".$row_1['id']."' LIMIT 1");
                    //xoa cap 2
                    $sql_se_c2    = DB_que("SELECT * FROM `$table` WHERE `id_parent`='".$row_1['id']."'");
                    while ($row_2   = mysql_fetch_array($sql_se_c2)) 
                      {
                        DB_que("DELETE from $table WHERE `id`  = '".$row_2['id']."' LIMIT 1");
                        //xoa cap 3
                        $sql_se_c3    = DB_que("SELECT * FROM `$table` WHERE `id_parent`='".$row_2['id']."'");
                        while ($row_3 = mysql_fetch_array($sql_se_c3)) 
                          {
                            DB_que("DELETE FROM $table WHERE `id` = '".$row_3['id']."' LIMIT 1");
                            //xoa cap 3
                            $sql_se_c4    = DB_que("SELECT * FROM `$table` WHERE `id_parent`='".$row_3['id']."'");
                            while ($row_4   = mysql_fetch_array($sql_se_c4)) 
                              {
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
              DB_que("UPDATE `$table` SET `tenbaiviet_vi`='$ncata_vi', `thuoc_bai_viet` = '$thuoc_bai_viet', `catasort`='$sort', `showhi`='$showhi' WHERE `id`='$idofme' LIMIT 1");
            }
          }
          $_SESSION['show_message_on'] = 'Cập nhật dữ liệu thành công!';
      }


    $sql        = DB_que("SELECT * FROM `$table` WHERE `id_parent` = 0  ORDER BY `catasort` ASC ");
    $sql_array  =  array();
    while ($r   = mysql_fetch_assoc($sql)) {
      $sql_array[] = $r;
    }

?>
<section class="content-header">
    <h1> Danh sách form</h1> 
    <ol class="breadcrumb">
        <li><a href="<?=$fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Danh sách form</li>
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
                          <i class="fa fa-pencil-square-o"></i> Danh sách form
                      </h2>
                        <h3 class="box-title box-title-td pull-right">
                          <button type="submit" name="addgiatri" class="btn btn-primary" onclick="return CHECK_name_emty()"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
                          <a href="<?=$url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                        </h3>
                    </div>
                    <style type="text/css">
                      .popover.top { z-index: 999999; width: 500px; max-width: 500px}

                    </style>
                    <div class="box-body table-responsive no-padding table-danhsach-cont" style="overflow-x: visible;">
                      <table class="table table-hover table-danhsach">
                        <tbody>
                          <tr>
                            <th class="w50 text-center">
                              <label>
                                <input type='checkbox' class='minimal cls_showxoa_all'> Xóa
                              </label>
                            </th>
                            <th class="w80 text-center">STT</th>
                            <th>Tiêu đề</th>
                            <th class="w100 text-center">Hiển thị</th>
                            <th class="w120 text-center">Tác vụ</th>
                          </tr>
                          <?php
                            $cl = 0;
                            foreach ($sql_array as $rows) 
                            {
                              $cl++;
                              $ida                = SHOW_text($rows['id']);
                              $tenbaiviet_vi      = SHOW_text($rows['tenbaiviet_vi']);
                              $tenbaiviet_en      = SHOW_text($rows['tenbaiviet_en']);
                              $catasort           = number_format(SHOW_text($rows['catasort']),0,',','.');
                              $showhi             = SHOW_text($rows['showhi']);
                              $thuoc_bai_viet     = SHOW_text($rows['thuoc_bai_viet']);

                          ?>
                          <tr>
                            <td class="text-center">
                              <input name='xoa_gr_arr_<?=$cl?>' type='checkbox' class='minimal cls_showxoa'>
                              <input name='key_<?=$cl?>' type='hidden' value="<?=$key ?>">
                            </td>
                            <td class="text-center">
                              <input name="idme<?=$cl?>" value="<?=$ida?>" type="hidden">
                              <input type="text" class="text-center" name="sortby<?=$cl?>" value="<?=$catasort?>" onkeyup="SetCurrency(this)">
                            </td>
                            
                            <td>
                              <div class="name">
                                <input type="text" class="cls_emty_name" name="ncata_vi<?=$cl?>" value="<?=$tenbaiviet_vi?>"   placeholder="Tiêu đề (vi)">
                              </div>
                              <div class="name" style="position: relative;">
                                <input type="text" name="thuoc_bai_viet<?=$cl?>" value="<?=$thuoc_bai_viet ?>" placeholder="Nhập ID bài viết hiển thị tư vấn, mỗi ID cách nhau bởi dấu ,">
                                <a data-tooltip="ID bài viết hiển thị form, mỗi ID cách nhau bở dấu , .Lấy ID bằng cách vào chỉnh sửa bài viết thì url chỉnh sửa bài viết có dạng ?module=main-module&action=danh-sach-bai-viet&step=4&id_step=1&edit=7, khi đó ID bài viết là 7" style="position: absolute; top: 5px; right: 10px;"> </a>
                              </div>
                              <?php if($lang_en){ ?>
                              <div class="name">
                                <input type="text" class="cls_emty_name" name="ncata_en<?=$cl?>" value="<?=$tenbaiviet_en?>"   placeholder="Tiêu đề (en)">
                              </div>
                              <?php } ?>
                            </td>
                            <td class="text-center">
                              <div id="cus" class="cus_menu">
                                <label><input type="checkbox" class='minimal' name="showhi_<?=$cl ?>" value="1" <?=(($showhi == 1) ? "checked='checked'" : "" )?> ></label>
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="<?=$url_page ?>&edit=<?=$ida?>" title="<?=luu_lai ?>"><i class="fa fa-pencil-square-o"></i></a>
                                <a href="<?=$url_page.'&del=ok&catalogid='.$ida.'&key='.$key ?>" class="do" title="Xóa" onclick="return confirm('Bạn thật sự muốn xóa?')"><i class="fa fa-times"></i></a>
                            </td>
                          </tr>
                          <!--  -->
                        <?php  } ?> 
                        </tbody>
                      </table>
                      <input type='hidden' value='<?=$cl?>' name='maxvalu'>
                    </div>
                    <div class="box-header">
                      <h3 class="box-title box-title-td pull-right">
                          <button type="submit" name="addgiatri" class="btn btn-primary" onclick="return CHECK_name_emty()"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
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