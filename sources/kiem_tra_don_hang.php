<?php
  if(!isset($_GET['madh']) || $_GET['madh'] == '' || !isset($_GET['email']) || $_GET['email'] == '')
//  LOCATION_js($full_url.'/tra-cuu-don-hang/');

  $step_name  = DB_fet("*", "#_step", "`showhi` = 1 AND `step` = 2", "`id` DESC", 1);
  $step_name  = mysql_fetch_assoc($step_name);
  
  $donhang    = DB_fet("*", "`#_order`", "`madh` = '".$haity."'", "`id` DESC", 1);
  $donhang    = mysql_fetch_assoc($donhang);

?>
    <div class="thongtinchitiet">
        <?php
        if($donhang) {
            ?>
      <div class="title_id_cus">
        <?=$glo_lang['thong_tin_khach_hang'] ?>
      </div>
            <table class="table table-hover table-danhsach">
                <tbody>
                    <tr>
                        <td><strong><?=$glo_lang['ma_dh'] ?></strong></td>
                        <td><?=SHOW_text($donhang['madh'])?></td>
                    </tr>
                    <tr>
                        <td><strong><?=$glo_lang['register_fullname']  ?></strong></td>
                        <td><?=$donhang['hoten']?></td>
                    </tr>
                    <tr>
                        <td><strong><?=$glo_lang['register_phone']  ?></strong></td>
                        <td><?=$donhang['sodienthoai']?></td>
                    </tr>
                    <tr>
                        <td><strong><?=$glo_lang['email']  ?></strong></td>
                        <td><?=$donhang['email']?></td>
                    </tr>
                    <tr>
                        <td><strong><?=$glo_lang['dia_chi_gh']  ?></strong></td>
                        <td><?=$donhang['diachi']?></td>
                    </tr>
                    <tr>
                        <td><strong><?=$glo_lang['note']  ?></strong></td>
                        <td><?=$donhang['ghichu']?></td>
                    </tr>
                    <tr>
                        <td><strong><?=$glo_lang['ngay_dat'] ?></strong></td>
                        <td><?=date("d/m/Y - H:i:s",$donhang['ngaydat'])?></td>
                    </tr>
                    <tr>
                        <td><strong><?=$glo_lang['trang_thai'] ?></strong></td>
                        <td><?php
                            if(SHOW_text($donhang['trangthai']) == 1) echo $glo_lang['don_hang_moi'] ;
                            elseif(SHOW_text($donhang['trangthai']) == 2) echo $glo_lang['dang_xu_ly'] ;
                            elseif(SHOW_text($donhang['trangthai']) == 3) echo $glo_lang['da_giao_hang'] ;
                            else echo $glo_lang['huy_don_hang'] ;
                            ?></td>
                    </tr>

                    <tr>
                        <td><strong><?=$glo_lang['phuong_thuc_thanh_toan'] ?></strong></td>
                        <td><?=($donhang['thanhtoan'] == 1) ? $glo_lang['thanh_toan_tien_mat']  : $glo_lang['thanh_toan_chuyen_khoan']  ?></td>
                    </tr>
                </tbody>
            </table>
                <div class="title_id_cus">
                    <?=$glo_lang['thong_tin_dat_hang'] ?>
                </div>
          <div id="cart_list" class="dv-table-reposive">
            <table class="table table-hover table-danhsach">
                <tbody>
                <tr>
                    <th class="cls_cart_mb" width="10%"><?=$glo_lang['cart_hinh'] ?></th>
                    <th><?=$glo_lang['cart_ten_sp'] ?></th>
                    <th width="12%"><?=$glo_lang['cart_ma_sp'] ?></th>
                    <th width="15%"><?=$glo_lang['cart_qty'] ?></th>
                    <th width="15%"><?=$glo_lang['cart_dongia'] ?></th>
                    <th width="16%"><?=$glo_lang['cart_thanhtien'] ?></th>
                </tr>
                <?php
                $idSanphams = explode(',', $donhang['idsp']);
                $dongias    = explode(',', $donhang['dongia']);
                $soluongs   = explode(',', $donhang['soluong']);
                $i          = 0;
                $tongtien   = 0;
                $tamtinh = 0;
                foreach ($idSanphams as $key => $value) {
                    $sanpham   = DB_fet("*", "#_baiviet", "`id` = '".$value."'","",1,"arr");
//                    $sanpham = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` = 1 AND `id` = '" . $value . "' LIMIT 1");
//                    var_dump($sanpham);
//                    var_dump($sanpham['icon']);
                    foreach ($sanpham as $rows) {
                        $tenbaiviet = $rows['tenbaiviet_' . $lang];
                        $seo_name = $full_url . '/' . $rows['seo_name'];
                        $image = $fullpath . '/' . $rows['duongdantin'] . '/thumb_' . $rows['icon'];
                        $ma_sp = $rows['p1'];
                    }
                    $thanhtien = $soluongs[$i] * $dongias[$i];
                    $tongtien += $thanhtien;
                    $tamtinh += $thanhtien;
                    ?>
                    <tr>
                        <td class="text-center">
                            <img class="img_show_ds" src="<?= $image ?>" alt="<?=$tenbaiviet ?>" title="<?=$tenbaiviet ?>"/>
                        </td>
                        <td style="text-align:left" class="text-center">
                            <a href="<?= $seo_name?>/">
                                        <?=$tenbaiviet ?></a>
                        </td>
                        <td class="text-center"><?= $ma_sp ?></td>
                        <td class="text-center"><input name="" readonly value="<?=$soluongs[$i] ?>" type="text" /></td>
                        <td class="text-center" style="text-align:right"><?=($dongias[$i] == 0) ? 0 : NUMBER_fomat($dongias[$i]) ?></td>
                        <td class="text-center" style="text-align:right" class="td_thanhtien_<?=$key ?>"><?=($thanhtien== 0)  ? 0 : NUMBER_fomat($thanhtien) ?></td>
                    </tr>
                    <?php  $i++; } ?>
                <tr>
                    <td class="money-total" colspan="7">
                        <span id="pro_sum"><?= $glo_lang['tam_tinh'] ?>:
                <label class='tb_tamtinh'><?= ($tamtinh == 0) ? 0 : NUMBER_fomat($tamtinh). " " .$glo_lang['dvt'] ?></label>
                </span></td>
                </tr>
                <tr>
                    <td class="money-total" colspan="7">
                        <span id="pro_sum"><?= $glo_lang['so_tien_giam'] ?>:
                <label class='tb_giamgia'><?= SHOW_text(NUMBER_fomat_vnd($donhang['so_tien'])) ?></label>
                </span></td>
                </tr>
                <tr>
                    <td class="money-total" colspan="7"><span id="pro_sum"><?=$glo_lang['cart_tong_tien']  ?>:
                  <label class="tb_tongtien">
                      <?php
                          if($donhang['so_tien'] > 0){
                              echo NUMBER_fomat_vnd(($tamtinh) - ($donhang['so_tien']));
                          }else{
                              echo NUMBER_fomat_vnd($tamtinh);
                          }
                      ?>
                  </label>
                  </span></td>
                </tr>
                </tbody>

            </table>
            <div class="clr"></div>
          </div>
        <?php
          } else { ?>
              <div class="cart-empty"><?=$glo_lang['khong_tim_thay_du_lieu_nao'] ?></div>
        <?php } ?>

      </div>
      <div class="clr"></div>

