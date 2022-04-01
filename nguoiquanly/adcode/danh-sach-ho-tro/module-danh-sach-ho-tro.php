<?php
  if(isset($_GET['them-moi']) || (isset($_GET['edit']) && is_numeric($_GET['edit']))){
      include "module-danh-sach-ho-tro-add.php";
  }else{
      $table = '#_sponline';
      if(isset($_GET['del']))
      {
        $sql_se     = DB_que("SELECT * FROM `$table` WHERE `id`='".$_GET['catalogid']."' LIMIT 1");
        $del_name   = @mysql_result($sql_se,0,'support_name_vi');
        DB_que("DELETE from $table WHERE id='".$_GET['catalogid']."' limit 1");
        $_SESSION['show_message_on'] = 'Đã xóa [<strong>'.$del_name.'</strong>] thành công!';
        LOCATION_js($url_page);
        exit();
      }

      if(isset($_REQUEST['addgiatri']) AND isset($_REQUEST['maxvalu']))
      {
        for($i=0;$i<$_REQUEST['maxvalu'];$i++)
            {
                $idofme             = $_POST["idme$i"];
                $sort               = $_POST["sortby$i"];
                $support_name_vi    = isset($_POST["support_name_vi$i"]) ? $_POST["support_name_vi$i"] : '';
                $support_name_en    = isset($_POST["support_name_en$i"]) ? $_POST["support_name_en$i"] : '';
                $phone              = $_POST["phone$i"];
                $email              = $_POST["email$i"];

                $showhi             = isset($_POST["showhi_$i"]) ? "1": "0";

                if(isset($_POST["coppy_row$i"])){
                    COPPY_row($table, $idofme, 0);
                }

                if(isset($_POST["xoa_gr_arr_$i"])){
                //xoa
                    DB_que("DELETE from $table WHERE id='".$idofme."' limit 1");
                //
                }else{
                    DB_que("UPDATE `$table` SET `support_name_vi`='$support_name_vi',`support_name_en`='$support_name_en', `phone`='$phone', `email`='$email',`catasort`='$sort',`showhi`='$showhi' WHERE `id`='$idofme' limit 1"); 
                }
            }
            $_SESSION['show_message_on'] = 'Cập nhật dữ liệu thành công!';
      }
?>

<section class="content-header">
    <h1>Danh sách hỗ trợ</h1> 
    <ol class="breadcrumb">
        <li><a href="<?=$fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Danh sách hỗ trợ</li>
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
                          <i class="fa fa-pencil-square-o"></i> Danh sách
                        </h2>
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
                                    <th>Tên hỗ trợ</th>
                                    <th class="w200 ">Số điện thoại 1</th>
                                    <th class="w200 ">Số điện thoại 2</th>
                                    <th class="w100 text-center">Hiển thị</th>
                                    <th class="w100 text-center">Tác vụ</th>
                                </tr>
                            <?php
                                $sql        = DB_que("SELECT * FROM `$table` ORDER BY `catasort` DESC");
                                $cl         = 0;
                                while($rows = mysql_fetch_assoc($sql))
                                {
                                    $ida              = $rows['id'];
                                    $catasort         = SHOW_text($rows['catasort']);
                                    $support_name_vi  = SHOW_text($rows['support_name_vi']);
                                    $support_name_en  = SHOW_text($rows['support_name_en']);
                                    $phone            = SHOW_text($rows['phone']); 
                                    $showhi           = SHOW_text($rows['showhi']);
                                    $email            = SHOW_text($rows['email']);
                            ?>
                                <tr>
                                    <td class="text-center">
                                        <input name='xoa_gr_arr_<?=$cl?>' type='checkbox' class='minimal cls_showxoa'>
                                    </td>
                                    <td class="text-center">
                                        <input name="idme<?=$cl?>" value="<?=$ida?>" type="hidden">
                                    <input type="text" class="text-center" name="sortby<?=$cl?>" value="<?=$catasort?>">
                                    </td>
                                    <td>
                                        <div class="name">
                                          <input type="text" name="support_name_vi<?=$cl?>" value="<?=$support_name_vi?>">
                                        </div>
                                        <?php if($lang_en){ ?>
                                        <div class="name">
                                            <input type="text" class="cls_emty_name" name="support_name_en<?=$cl?>" value="<?=$support_name_en?>">
                                        </div>
                                        <?php } ?>
                                        <?php if(isset($_SESSION['admin'])){ ?>
                                            <label>
                                                <input name='coppy_row<?=$cl?>' type='checkbox' class='minimal'> [Coppy]
                                            </label>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <div class="name">
                                          <input type="text" name="email<?=$cl?>" value="<?=$email?>">
                                        </div>
                                    </td>                                   
                                    <td>
                                        <div class="name">
                                          <input type="text" name="phone<?=$cl?>" value="<?=$phone?>">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                    <div id="cus" class="cus_menu">
                                      <label><input type="checkbox" name="showhi_<?=$cl ?>" value="1" <?=(($showhi == 1) ? "checked='checked'" : "" )?> class="minimal" ></label>
                                      </div>
                                  </td>
                                    <td class="text-center">
                                        <a href="<?=$url_page ?>&edit=<?=$ida?>" title="Cập nhật"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="<?=$url_page.'&del=ok&catalogid='.$ida ?>" class="do" title="Xóa" onclick="return confirm('Bạn thật sự muốn xóa?')"><i class="fa fa-times"></i></a>
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
                           <button type="submit" name="addgiatri" class="btn btn-primary"  onclick="return CHECK_delimg()"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
                            <a href="<?=$url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                        </h3>
                    </div>
                </div>
            </section>
        </div>
    </section>
</form>
<?php } ?>