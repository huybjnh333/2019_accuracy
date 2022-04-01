<?php
    $table      = '#_ship_khuvuc';
    $table_slug = str_replace("#_", "", $table);

    if(isset($_REQUEST['addgiatri']) AND isset($_REQUEST['maxvalu']))
      {
        for($i=1;$i <= $_REQUEST['maxvalu'];$i++)
          {
            $idofme             = $_POST["idme$i"];
            $sort               = str_replace(".", "", $_POST["sortby$i"]);
            $ncata_vi           = isset($_POST["ncata_vi$i"]) ? $_POST["ncata_vi$i"] : '';
            $ncata_en           = isset($_POST["ncata_en$i"]) ? $_POST["ncata_en$i"] : '';
            $id_shipchung       = isset($_POST["id_shipchung$i"]) ? $_POST["id_shipchung$i"] : 0;
            $id_giaohangnhanh   = isset($_POST["id_giaohangnhanh$i"]) ? $_POST["id_giaohangnhanh$i"] : 0;

            $showhi             = isset($_POST["showhi_$i"]) ? "1": "0"; 

            $add                = "";
            if(isset($_POST["id_shipchung$i"])){
              $add             .= " , `id_shipchung` = '$id_shipchung' ";
            }
            if(isset($_POST["id_giaohangnhanh$i"])){
              $add             .= " , `id_giaohangnhanh` = '$id_giaohangnhanh' ";
            }

            DB_que("UPDATE `$table` SET `tenbaiviet_vi`='$ncata_vi', `tenbaiviet_en`='$ncata_en', `catasort`='$sort', `showhi`='$showhi' $add WHERE `id`='$idofme' LIMIT 1");
          }
          $_SESSION['show_message_on'] = 'Cập nhật dữ liệu thành công!';
      }



    $numview  = 5;
    $pz  = 0;
    $pzz = 0;

    if(isset($_GET['pz'])){
      $pz       = $_GET['pz'];
      if($pz    == "" || $pz == 0)  $pzz = 0;
      else $pzz = $pz * $numview;
    }

    $sql     = DB_que("SELECT * FROM `$table` WHERE `id_parent`= 0 ORDER BY `catasort` ASC LIMIT $pzz,$numview");
    $sql_num = DB_que("SELECT * FROM `$table` WHERE `id_parent`= 0 ");

    $numlist = @mysql_num_rows($sql_num);
    $numshow = ceil($numlist/$numview);

    $list_danhmuc  = DB_fet("*", "#_danhmuc", "","`id` DESC", "", "arr", 1);
    $list_bv_img   = DB_fet("*", "#_baiviet_img",'','`id` ASC', '', 'arr');    

?>
<section class="content-header">
    <h1> Danh sách chủ đề</h1> 
    <ol class="breadcrumb">
        <li><a href="<?=$fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Danh sách địa điểm</li>
    </ol>
</section>
<style>
  .td_hover:hover .p_hover{display: block !important}
</style>
<form action="" method="post">
    <section class="content">
        <div class="row">
            <section class="col-lg-12">
                <?php include _source."mesages.php"; ?>
                <div class="box">
                    <div class="box-header">
                      <h2 class="h2_title">
                          <i class="fa fa-pencil-square-o"></i> Danh sách địa điểm
                      </h2>
                        <h3 class="box-title box-title-td pull-right">
                          <button type="submit" name="addgiatri" class="btn btn-primary" onclick="return CHECK_name_emty()"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
                        </h3>
                    </div>
                    <div class="box-body table-responsive no-padding table-danhsach-cont">
                      <table class="table table-hover table-danhsach">
                        <tbody>
                          <tr>
                            <th class="w80 text-center">STT</th>
                            <th>Tiêu đề</th>
                            <th class="w150 text-center">ID Ship chung</th>
                            <th class="w150 text-center">ID Giao hàng nhanh</th>
                            <th class="w100 text-center">Hiển thị</th>
                          </tr>
                          <?php
                            $readonly = "";
                            if (empty($_SESSION['admin'])) $readonly = ' disabled="disabled"';

                            $cl                 = 0;
                            $token              = GET_token();
                            while($rows = mysql_fetch_assoc($sql)){
                              $cl++;

                              $ida                = SHOW_text($rows['id']);
                              $tenbaiviet_vi      = SHOW_text($rows['tenbaiviet_vi']);
                              $tenbaiviet_en      = SHOW_text($rows['tenbaiviet_en']);
                              $id_parent          = SHOW_text($rows['id_parent']);
                              $showhi             = SHOW_text($rows['showhi']);
                              $catasort           = SHOW_text($rows['catasort']);

                          ?>
                          <tr class="td_hover">
                            <td class="text-center ">
                              <input name="idme<?=$cl?>" value="<?=$ida?>" type="hidden">
                              <input type="text" class="text-center" name="sortby<?=$cl?>" value="<?=$catasort?>" onkeyup="SetCurrency(this)">
                              <p style="color: #333; display: none" class="p_hover">[<?=$ida ?>]</p>
                            </td>
                            
                            <td>
                              <div class="name">
                                <input type="text" class="cls_emty_name" name="ncata_vi<?=$cl?>" value="<?=$tenbaiviet_vi?>"   placeholder="Tiêu đề (<?=_lang_nb1_key ?>)">
                              </div>
                              <?php if($lang_nb2){ ?>
                              <div class="name">
                                <input type="text" name="ncata_en<?=$cl?>" value="<?=$tenbaiviet_en?>"   placeholder="Tiêu đề (<?=_lang_nb2_key ?>)">
                              </div>
                              <?php } ?>
                            </td>
                            <td class="text-center">
                              <input type="text" name="id_shipchung<?=$cl?>" value="<?=$rows['id_shipchung'] ?>" placeholder="ID Ship chung" class="text-center" <?=$readonly ?>>
                            </td>
                            <td class="text-center">
                              <input type="text" name="id_giaohangnhanh<?=$cl?>" value="<?=$rows['id_giaohangnhanh'] ?>" placeholder="ID Giao hàng nhanh" class="text-center" <?=$readonly ?>>
                            </td>
                            <td class="text-center">
                              <div id="cus" class="cus_menu">
                                <label><input type="checkbox" class='minimal' name="showhi_<?=$cl ?>" value="1" <?=(($showhi == 1) ? "checked='checked'" : "" )?> ></label>
                                </div>
                            </td>
                          </tr>
                          <!-- c1 -->
                          <?php 
                            $sql2     = DB_que("SELECT * FROM `$table` WHERE `id_parent`= '".$ida."' ORDER BY `catasort` ASC");
                            while ($rows_1 = mysql_fetch_assoc($sql2)) {
                              $cl++;
                              $ida_1                = SHOW_text($rows_1['id']);
                              $tenbaiviet_vi_1      = SHOW_text($rows_1['tenbaiviet_vi']);
                              $tenbaiviet_en_1      = SHOW_text($rows_1['tenbaiviet_en']);
                              $id_parent_1          = SHOW_text($rows_1['id_parent']);
                              $showhi_1             = SHOW_text($rows_1['showhi']);
                              $catasort_1           = SHOW_text($rows_1['catasort']);
                          ?>
                          <tr>
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
                                <input type="text" name="ncata_en<?=$cl?>" class="cls_emty_name" value="<?=$tenbaiviet_en_1?>"   placeholder="Tiêu đề (<?=_lang_nb2_key ?>)">
                              </div>
                              <?php } ?>
                            </td>
                            <td class="text-center">
                              <input type="text" name="id_shipchung<?=$cl?>" value="<?=$rows_1['id_shipchung'] ?>" placeholder="ID Ship chung" class="text-center" <?=$readonly ?>>
                            </td>
                            <td class="text-center">
                              <input type="text" name="id_giaohangnhanh<?=$cl?>" value="<?=$rows_1['id_giaohangnhanh'] ?>" placeholder="ID Giao hàng nhanh" class="text-center" <?=$readonly ?>>
                            </td>
                            <td class="text-center">
                              <div id="cus" class="cus_menu">
                                <label><input type="checkbox" class='minimal' name="showhi_<?=$cl ?>" value="1" <?=(($showhi_1 == 1) ? "checked='checked'" : "" )?> ></label>
                                </div>
                            </td>
                          </tr>
                          <!-- c1 -->
                          <?php 
                            $sql3     = DB_que("SELECT * FROM `$table` WHERE `id_parent`= '".$ida_1."' ORDER BY `catasort` ASC");
                            while ($rows_3 = mysql_fetch_assoc($sql3)) {
                              $cl++;
                              $ida_3                = SHOW_text($rows_3['id']);
                              $tenbaiviet_vi_3      = SHOW_text($rows_3['tenbaiviet_vi']);
                              $tenbaiviet_en_3      = SHOW_text($rows_3['tenbaiviet_en']);
                              $id_parent_3          = SHOW_text($rows_3['id_parent']);
                              $showhi_3             = SHOW_text($rows_3['showhi']);
                              $catasort_3           = SHOW_text($rows_3['catasort']);
                          ?>
                          <tr>
                            <td class="text-center">
                              <input name="idme<?=$cl?>" value="<?=$ida_3?>" type="hidden">
                              <input type="text" class="text-center" name="sortby<?=$cl?>" value="<?=$catasort_3?>" onkeyup="SetCurrency(this)">
                            </td>
                            <td>
                              <span class="sp-list-cap2">╚═►</span>
                              <div class="name name_list_cap_2">
                                <input type="text" name="ncata_vi<?=$cl?>" class="cls_emty_name" value="<?=$tenbaiviet_vi_3?>"   placeholder="Tiêu đề (<?=_lang_nb1_key ?>)">
                              </div>
                              <?php if($lang_nb2){ ?>
                              <div class="name name_list_cap_2">
                                <input type="text" name="ncata_en<?=$cl?>" class="cls_emty_name" value="<?=$tenbaiviet_en_3?>"   placeholder="Tiêu đề (<?=_lang_nb2_key ?>)">
                              </div>
                              <?php } ?>
                            </td>
                            <td class="text-center">
                              <input type="text" name="id_shipchung<?=$cl?>" value="<?=$rows_2['id_shipchung'] ?>" placeholder="ID Ship chung" class="text-center" <?=$readonly ?>>
                            </td>
                            <td class="text-center">
                              <input type="text" name="id_giaohangnhanh<?=$cl?>" value="<?=$rows_2['id_giaohangnhanh'] ?>" placeholder="ID Giao hàng nhanh" class="text-center" <?=$readonly ?>>
                            </td>
                            <td class="text-center">
                              <div id="cus" class="cus_menu">
                                <label><input type="checkbox" class='minimal' name="showhi_<?=$cl ?>" value="1" <?=(($showhi_3 == 1) ? "checked='checked'" : "" )?> ></label>
                                </div>
                            </td>
                          </tr>
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
                      <div class="paging_simple_numbers">
                        <ul class="pagination">
                          <?php
                            PHANTRANG_admin($numshow, $url_page, $pz);
                          ?>
                        </ul>
                      </div>
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