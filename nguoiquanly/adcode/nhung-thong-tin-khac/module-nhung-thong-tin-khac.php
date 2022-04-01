<?php
  if(isset($_GET['them-moi']) || (isset($_GET['edit']) && is_numeric($_GET['edit']))){
        include "module-nhung-thong-tin-khac-add.php";
  }else{
    $table = '#_seo_name';
    
    if(isset($_GET['del']))
    {
        $sql_se         = DB_que("SELECT * FROM `$table` WHERE `id`='".$_GET['catalogid']."' LIMIT 1");
        $icon           = @mysql_result($sql_se,0,'icon');
        $duongdantin    = @mysql_result($sql_se,0,'duongdantin');
        $del_name       = @mysql_result($sql_se,0,'tenbaiviet_vi');
        @unlink("../".$duongdantin."/".$icon);
        @unlink("../".$duongdantin."/thumb_".$icon);
        $sql = DB_que("DELETE from $table WHERE id='".$_GET['catalogid']."' limit 1");
        $_SESSION['show_message_on'] =  'Đã xóa [<strong>'.$del_name.'</strong>] thành công';
        LOCATION_js($url_page);
        exit();
    }

    if(isset($_REQUEST['addgiatri']) AND isset($_REQUEST['maxvalu']))
    {
        for($i=0;$i<$_REQUEST['maxvalu'];$i++)
        {
            $idofme     = $_POST["idme$i"];
            $tenbv_vi   = isset($_POST["ncata_vi$i"]) ? $_POST["ncata_vi$i"] : "";
            $tenbv_en   = isset($_POST["ncata_en$i"]) ? $_POST["ncata_en$i"] : "";
            $tenbv_cn   = isset($_POST["ncata_cn$i"]) ? $_POST["ncata_cn$i"] : "";

            $sql = DB_que("UPDATE `$table` SET `tenbaiviet_vi`='$tenbv_vi',`tenbaiviet_en`='$tenbv_en',`tenbaiviet_cn`='$tenbv_cn' WHERE `id`='$idofme' limit 1");
        }
        $_SESSION['show_message_on'] =  'Cập nhật dữ liệu thành công';
    }



    $sql     = DB_que("SELECT * FROM `$table`");
?>
<section class="content-header">
    <h1>Nội dung khác</h1>
    <ol class="breadcrumb">
        <li><a href="<?=$fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Nội dung khác</li>
    </ol>
</section>
<form action="" method="post">
    <section class="content">
        <div class="row">
            <section class="col-lg-12">
              <?php include _source."mesages.php"; ?>
                <div class="box">
                    <div class="box-header  with-border">
                        <h3 class="box-title box-title-td pull-right">
                          <button type="submit" name="addgiatri" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
                        <?php
                          if(isset($_SESSION['admin']))
                          {
                        ?>
                            <a href="<?=$url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                        <?
                          }
                        ?>
                        </h3>
                        <h2 class="h2_title">
                          <i class="fa fa-pencil-square-o"></i> Danh sách 
                        </h2>
                    </div>
                    <div class="box-body table-responsive no-padding table-danhsach-cont">
                      <table class="table table-hover table-danhsach">
                        <tbody>
                          <tr>
                            <th class="w80 text-center">STT</th>
                            
                            <th>Tên bài viết</th>
                            <th class="w100 text-center">Hình ảnh</th>
                            <th class="w100 text-center">Tác vụ</th>
                          </tr>
                          <?php
                            $cl = 0;
                            while($rows = mysql_fetch_assoc($sql))
                            {
                              $ida                = SHOW_text($rows['id']);
                              $tenbaiviet_vi      = SHOW_text($rows['tenbaiviet_vi']);
                              $tenbaiviet_en      = SHOW_text($rows['tenbaiviet_en']);
                              $tenbaiviet_cn      = SHOW_text($rows['tenbaiviet_cn']);
                              $icon               = SHOW_text($rows['icon']);

                          ?>
                          <tr>
                            <td class="text-center">
                              <input name="idme<?=$cl?>" value="<?=$ida?>" type="hidden">
                              <?=$cl + 1?>
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

                            </td>
                            <td class="text-center">
                              <img class='img_show_ds' src='<?=$fullpath."/".$duongdantin."/thumb_".$icon ?>'>
                            </td>
                            <td class="text-center">
                                <a href="<?=$url_page ?>&edit=<?=$ida?>"><i class="fa fa-pencil-square-o"></i></a>
                                <?php if(isset($_SESSION['admin'])){ ?>
                                <a href="<?=$url_page.'&del=ok&catalogid='.$ida.'&token='.GET_token() ?>" class="do" onclick="return confirm('Bạn thật sự muốn xóa?')"><i class="fa fa-times"></i></a>
                                <?php } ?>
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
                          <button type="submit" name="addgiatri" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
                          <?php if(isset($_SESSION['admin'])) {  ?>
                              <a href="<?=$url_page ?>&them-moi=true" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                          <?
                            }
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