<?php
    if(!isset($_SESSION['email'])) LOCATION_js($fullpath);
    else
    {   
        $step_name = select_one('*', '#_step', '`showhi` = 1 AND `step` = 2');
        $bg = 'style="background-image:url('.$fullpath.'/'.$step_name['duongdantin'].'/'.$step_name['icon'].');"';

        $sql = select_one("*", "#_members", "`showhi` = 1 AND `phanquyen` = 0 AND `email` = '".$_SESSION['email']."'");
        $iduser         = SHOW_text($sql['id']);
        $email          = SHOW_text($sql['email']);
        $hoten          = SHOW_text($sql['hoten']);

        // if(isset($haity) && $haity !='')
        // {
        //     $id_order       = trim(strstr($haity, '-'),'-');
        //     $sql_edit_order = mysql_query("UPDATE `order` SET `trangthai` = 4 WHERE `id` = '".$id_order."' LIMIT 1");
        //     echo '<script> alert("'.ban_da_huy_don_hang_thanh_thanh_cong.'"); </script>';
        //     $val            = $full_url.'/quan-ly-don-hang';
        //     LOCATION_js($val);
        // }
    }
include _source.'phantrang_kietxuat.php';
?>
<div class="link_page">
    <div class="pagewrap">
        <ul>
            <li><a href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a></li>
            <li><a href="<?= $full_url.'/lich-su-dat-hang/' ?>"><i aria-hidden="true"></i>
                    <?= $glo_lang['lich_su_dat_hang'] ?></a></li>
        </ul>
        <div class="clr"></div>
    </div>
</div>
<div class="clr"></div>
<div class="pagewrap page_conten_page reorder-div">
    <div class="left_conten item2">
        <div class="menu_left">
            <h3><?= $glo_lang['thong_tin_quan_ly'] ?></h3>
            <ul>
                <li><a href="<?= $full_url.'/tai-khoan' ?>"><?= $glo_lang['thong_tin_tai_khoan'] ?></a></li>
                <li><a href="<?= $full_url.'/mat-khau' ?>"><?= $glo_lang['thay_doi_mat_khau'] ?></a></li>
                <li><a href="<?= $full_url.'/lich-su-dat-hang' ?>"><?= $glo_lang['lich_su_dat_hang'] ?></a></li>
            </ul>
        </div>
    </div>
    <div class="right_conten">
        <div class="box_page">
          <div class="title_id">
              <?=$glo_lang['quanly_donhang']?>
          </div>
              <div id="cart_list" class="dv-table-reposive">
                  <table class="table table-hover table-danhsach">
                      <tbody>
                      <tr>
                          <th><?= $glo_lang['stt'] ?></th>
                          <th><?=$glo_lang['ma_dh'] ?></th>
                          <th><?=$glo_lang['email'] ?></th>
                          <th><?=$glo_lang['so_dien_thoai'] ?></th>
                          <th><?=$glo_lang['ngay_dat'] ?></th>
                          <th><?=$glo_lang['trang_thai'] ?></th>
                      </tr>
                      <?php
                      $list_order = DB_fet("*", "#_order", "`iduser` = ".$iduser,"`id` DESC", "","arr");
                      $qty_order  = count($list_order);
                      for ($i=0; $i < $qty_order; $i++)
                      {
                          $dongias    = explode(',', $list_order[$i]['dongia']);
                          $soluongs   = explode(',', $list_order[$i]['soluong']);
                          $j          = 0;
                          $tongtien   = 0;
                          foreach ($soluongs as $value) {
                              $thanhtien = $value * $dongias[$j];
                              $tongtien += $thanhtien;
                              $j++;
                          }
//                          var_dump(SHOW_text($list_order[$i]['email']));
                          ?>
                          <tr>
                              <td class="text-center"><?=$i+1 ?></td>
                              <td class="text-center"><a class="chitiet-dh" target="_blank" href="<?=$full_url ?>/thong-tin-dat-hang/<?=SHOW_text($list_order[$i]['madh']) ?>"><?=SHOW_text($list_order[$i]['madh']) ?></a></td>
                              <td class="text-center"><?= SHOW_text($list_order[$i]['email']) ?></td>
                              <td class="text-center"><?= SHOW_text($list_order[$i]['sodienthoai']) ?></td>
                              <td class="text-center"><?=date("d/m/Y - H:i:s",SHOW_text($list_order[$i]['ngaydat'])) ?></td>
                              <td class="text-center">
                                  <?php
                                  if(SHOW_text($list_order[$i]['trangthai']) == 1) echo $glo_lang['don_hang_moi'];
                                  elseif(SHOW_text($list_order[$i]['trangthai']) == 2) echo $glo_lang['dang_xu_ly'];
                                  elseif(SHOW_text($list_order[$i]['trangthai']) == 3) echo $glo_lang['da_giao_hang'];
                                  else echo $glo_lang['huy_don_hang'];
                                  ?>
                              </td>
<!--                              <td>--><?//=($tongtien == 0) ? "0": NUMBER_fomat($tongtien)." ".$glo_lang['dv_tiente'] ?><!--</td>-->
                          </tr>
                      <?php } ?>
                      </tbody>
                  </table>
              </div>
          </div>
    </div>
</div>
<div class="clr"></div>


