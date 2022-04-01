<?php
    $table      = '#_form_danhmuc_nd';
    $table_slug = str_replace("#_", "", $table);
    if(isset($_GET['del']))
    {
      DB_que("DELETE FROM $table WHERE `id` ='".$_GET['catalogid']."' LIMIT 1");
      $_SESSION['show_message_on'] = 'Xóa chủ đề thành công';
      LOCATION_js($url_page."&noi-dung=true");
      exit();
    }

    if(isset($_REQUEST['addgiatri']) AND isset($_REQUEST['maxvalu']))
      {
        for($i=1;$i <= $_REQUEST['maxvalu'];$i++)
          {
            $idofme     = $_POST["idme$i"];
            $showhi     = isset($_POST["showhi_$i"]) ? "1": "0";

            if(isset($_POST["xoa_gr_arr_$i"])){
              DB_que("DELETE FROM $table WHERE `id` ='".$idofme."' LIMIT 1");
            }else{
              DB_que("UPDATE `$table` SET `showhi`='$showhi' WHERE `id`='$idofme' LIMIT 1");
            }
          }
          $_SESSION['show_message_on'] = 'Cập nhật dữ liệu thành công!';
      }


    $sql        = DB_que("SELECT * FROM `$table` ORDER BY `id` DESC ");
    $sql_array  =  array();
    while ($r   = mysql_fetch_assoc($sql)) {
      $sql_array[] = $r;
    }

?>
<section class="content-header">
    <h1> Danh sách liên hệ</h1> 
    <ol class="breadcrumb">
        <li><a href="<?=$fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Danh sách liên hệ</li>
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
                          <i class="fa fa-pencil-square-o"></i> Danh sách liên hệ
                      </h2>
                        <h3 class="box-title box-title-td pull-right">
                          <button type="submit" name="addgiatri" class="btn btn-primary" onclick="return CHECK_name_emty()"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
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
                            <th>Form</th>
                            <th class="w100 text-center">Chi tiết</th>
                            <th class="w100 text-center">Ngày gửi</th>
                            
                            <th class="w100 text-center">Đã xem</th>
                            <th class="w120 text-center">Tác vụ</th>
                          </tr>
                          <?php
                            $cl = 0;
                            $list_form = DB_fet("*","`#_form_danhmuc`","`id_parent` = 0","","","arr",1);
                            // print_r($list_form);
                            foreach ($sql_array as $rows) 
                            {
                              $cl++;
                              $ida                = SHOW_text($rows['id']);
                              $id_gui             = SHOW_text($rows['id_gui']);
                              $id_form            = SHOW_text($rows['id_form']);

                              $showhi             = SHOW_text($rows['showhi']);

                              $link_gui = DB_fet("*","`#_baiviet`","`id` = '".$id_gui."'","",1);
                              $link_gui = mysql_fetch_assoc($link_gui);

                          ?>
                          <tr>
                            <td class="text-center">
                              <input name='xoa_gr_arr_<?=$cl?>' type='checkbox' class='minimal cls_showxoa'>
                              <input name='key_<?=$cl?>' type='hidden' value="<?=$key ?>">
                            </td>
                            <td class="text-center">
                              <input name="idme<?=$cl?>" value="<?=$ida?>" type="hidden">
                              <?=$cl ?>
                            </td>
                              
                            <td>
                              <?=$list_form[$id_form]['tenbaiviet_vi'] ?>
                              <a href="<?=$fullpath."/".$link_gui['seo_name'] ?>/" style="display: block;" target="_blank"><?=$link_gui['tenbaiviet_vi'] ?></a>
                            </td>
                            <td class="text-center"><a href="<?=$url_page ?>&noi-dung=true&edit=<?=$ida?>">Chi tiết</a></td>
                            <td class="text-center"><?=date('d-m-Y', $rows['ngay_dang']) ?></td>
                            
                            <td class="text-center">
                              <div id="cus" class="cus_menu">
                                <label><input type="checkbox" class='minimal' name="showhi_<?=$cl ?>" value="1" <?=(($showhi == 1) ? "checked='checked'" : "" )?> ></label>
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="<?=$url_page ?>&noi-dung=true&edit=<?=$ida?>" title="<?=luu_lai ?>"><i class="fa fa-pencil-square-o"></i></a>
                                <a href="<?=$url_page.'&noi-dung=true&del=ok&catalogid='.$ida.'&key='.$key ?>" class="do" title="Xóa" onclick="return confirm('Bạn thật sự muốn xóa?')"><i class="fa fa-times"></i></a>
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
                      </h3>
                    </div>
                    <!--  -->
                </div>
            </section>
        </div>
    </section>
</form>
