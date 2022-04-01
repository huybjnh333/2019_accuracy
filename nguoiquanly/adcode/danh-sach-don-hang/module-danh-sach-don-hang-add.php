<?php
$iddh = isset($_GET['edit']) && is_numeric($_GET['edit']) ? $_GET['edit'] : "";
$donhang = DB_fet("*", "#_order", "`id` = '" . $iddh . "'", "", 1);
$donhang = mysql_fetch_assoc($donhang);
?>
<section class="content-header">
    <h1>Danh sách đơn hàng</h1>
    <ol class="breadcrumb">
        <li><a href="<?= $fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Danh sách đơn hàng</li>
    </ol>
</section>
<form action="" method="post">
    <section class="content">
        <div class="row">
            <section class="col-lg-12">
                <?php include _source . "mesages.php"; ?>
                <div class="box">
                    <div class="box-header">
                        <h2 class="h2_title"><i class="fa fa-pencil-square-o"></i> Thông Tin Người Mua Hàng</h2>
                        <h3 class="box-title box-title-td pull-right">
                            <a href="<?= $url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
                        </h3>
                    </div>
                    <div class="box-body table-responsive no-padding table-danhsach-cont">
                        <table class="table table-hover table-danhsach">
                            <tbody>
                            <?php
                            if (SHOW_text($donhang['iduser']) != 0) {
                                ?>
                                <tr>
                                    <td><strong>Thành viên</strong></td>
                                    <td><?= layEmailUser(SHOW_text($donhang['iduser'])) ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td><strong>Mã đơn hàng</strong></td>
                                <td><?= SHOW_text($donhang['madh']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Họ tên</strong></td>
                                <td><?= SHOW_text($donhang['hoten']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Số điện thoại</strong></td>
                                <td><?= SHOW_text($donhang['sodienthoai']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td><?= SHOW_text($donhang['email']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Địa chỉ giao hàng</strong></td>
                                <td><?= SHOW_text($donhang['diachi']) ?></td>
                            </tr>

                            <tr>
                                <td><strong>Ghi chú</strong></td>
                                <td><?= SHOW_text($donhang['ghichu']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Ngày đặt</strong></td>
                                <td><?= date("d/m/Y - H:i:s", $donhang['ngaydat']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Hình thức thanh toán</strong></td>
                                <td>
                                    <?php
                                    if (SHOW_text($donhang['thanhtoan']) == 1)
                                        echo 'Thanh toán bằng tiền mặt (COD)';
                                    else if (SHOW_text($donhang['thanhtoan']) == 3)
                                        echo 'Thanh toán qua paypal';
                                    else echo 'Thanh toán qua chuyển khoản';
                                    ?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header">
                        <h2 class="h2_title"><i class="fa fa-pencil-square-o"></i> Thông tin đơn hàng</h2>
                    </div>
                    <div class="box-body table-responsive no-padding table-danhsach-cont">
                        <table class="table table-hover table-danhsach">
                            <tbody>
                            <tr>
                                <th class="w80 text-center">STT</th>
                                <th class="w100 text-center">Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th class="w100 text-center">Mã sản phẩm</th>
                                <th class="w120 text-center">Đơn giá (VNĐ)</th>
                                <th class="w100 text-center">Số lượng</th>
                                <th class="w120 text-center">Thành tiền</th>
                            </tr>
                            <?php
                            $idSanphams = explode(',', $donhang['idsp']);
                            $dongias = explode(',', $donhang['dongia']);
                            $soluong = explode(',', $donhang['soluong']);
                            $j = 0;
                            $tamtinh = 0;
                            $tongtien = 0;
                            for ($i = 0; $i < count($idSanphams); $i++) {
                                $value = $idSanphams[$i];
                                $sanpham = DB_fet("*", "#_baiviet", "`id` = '" . $value . "'", "", 1);
                                $sanpham = mysql_fetch_assoc($sanpham);

                                if ($sanpham['icon'] != '')
                                    $thumb = "<img class='img_show_ds' src='" . $fullpath . "/" . $sanpham['duongdantin'] . "/thumb_" . $sanpham['icon'] . "'>";
                                else
                                    $thumb = "<img class='img_show_ds' src='" . $fullpath . "/nguoiquanly/images/noimage.png'>";

                                $thanhtien = $soluong[$i] * $dongias[$i];
                                $tamtinh += $thanhtien;
                                $tongtien += $thanhtien;
                                if(isset($_SESSION['ma-giam-gia'])){
                                    $tongtien = $tongtien - $_SESSION['ma-giam-gia']['sotiengiam'];
                                }

                                ?>
                                <tr>
                                    <td class="text-center"><?= $j + 1 ?></td>
                                    <td class="text-center"><?= $thumb ?></td>
                                    <td><a href="<?= $fullpath ?>/<?= $sanpham['seo_name'] ?>/"
                                           target="_blank"><?= $sanpham['tenbaiviet_vi'] ?>
                                        </a></td>
                                    <td class="text-center"><?= $sanpham['p1'] ?></td>
                                    <td class="text-center"><?= NUMBER_fomat($dongias[$i]) ?></td>
                                    <td class="text-center"><?= $soluong[$i] ?></td>
                                    <td class="text-center"><?= NUMBER_fomat($thanhtien) ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            <tr>
                                <td colspan="7" style="text-align: right;font-size: 15px;">Tạm tính: <span
                                            style="color: #F00;font-weight: 600;"><?= NUMBER_fomat_vnd($tamtinh) ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" style="text-align: right;font-size: 15px;">Số tiền giảm: <span
                                            style="color: #F00;font-weight: 600;"><?= SHOW_text(NUMBER_fomat_vnd($donhang['so_tien'])) ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" style="text-align: right;font-size: 15px;">Tổng tiền: <span style="color: #F00;font-weight: 600;">
                                        <?php
                                            if($donhang['so_tien'] > 0){
                                                echo NUMBER_fomat_vnd(($tamtinh) - ($donhang['so_tien']));
                                            }else{
                                                echo NUMBER_fomat_vnd($tamtinh);
                                            }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="box-header">
                        <h3 class="box-title box-title-td pull-right">
                            <a href="<?= $url_page ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
                        </h3>
                    </div>
                </div>
            </section>
        </div>
    </section>
</form>