<?php
// Update Luot view
$data['soluotxem'] = $arr_running['soluotxem'] + 1;
ACTION_db($data, '#_baiviet', 'update', NULL, "`id` = ".$arr_running['id']);
// Update Luot view

if($slug_step == "0"){
    $data['soluotxem'] = array();
    $data['soluotxem'] = $arr_running['soluotxem'] + 1;
    ACTION_db($data, '#_baiviet', 'update', NULL, "`id` = ".$arr_running['id']);
    $bre  = SHOW_text($arr_running['tenbaiviet_'.$lang]);
}
else if(!empty($thongtin_step)){
    $bre  = SHOW_text($thongtin_step['tenbaiviet_'.$lang]);
}
include _source . "box-header.php";
include _source . "phantrang_kietxuat.php";

$danhmuc_phong = DB_fet("*", "#_danhmuc", "`showhi` = 1 and step = " . $slug_step,
    "catasort ASC, id ASC", "", 1, 1);
function tinhnangsp($id_parent, $listchild, $lang,$step)
{
    //lấy ra những cấp con của th tính năng
    $sanpham_tinhnang = DB_fet("*",
        "#_baiviet_tinhnang",
        "`showhi` = 1 AND `step` = $step AND id_parent = " . $id_parent,
        "catasort asc, id asc",
        "",
        1,
        1);
    $array_temp = array();//tạo 1 mảng tạm dùng để chứa id con vừa lấy ra đc
    foreach ($sanpham_tinhnang as $value) {
        array_push($array_temp, $value['id']);
    }
    //chứa những tên bài viết của id con
    $arraytempstr = array();
    //chuyển chuỗi thành mảng (cụ thể: tính năng)
    $arr_a = explode(',', $listchild);//tenbaiviet
    foreach ($arr_a as $value) {
        if (empty($sanpham_tinhnang[$value]))
            continue;
        array_push($arraytempstr, $sanpham_tinhnang[$value]['tenbaiviet_' . $lang]);
    }
    return implode(', ', $arraytempstr);
}

?>
<div class="imges_id_page" style="background-image:url(<?= $image ?>);"></div>
<div class="pagewrap page_conten_page">
    <div class="title_page title_page_2">đặt bàn</div>
    <div class="bannerMain_2">
        <ul class="banner_2 owl-theme owl-carousel" id="owl-banner">
            <?php
            $banner_top = LAY_banner(" AND `id_parent` = 27");
            $count = 1;
            while ($r = mysql_fetch_array($banner_top)) {
                $images = $fullpath . '/' . $r['duongdantin'] . '/' . $r['icon'];
                $tenbaiviet = $r['tenbaiviet_' . $lang];
                $noidung = $r['noidung_' . $lang];
                $link = $r['lien_ket'];
                if (empty($r['lien_ket'])) {
                    $link = $full_url . '/den-led';
                }
                $p1 = $r['p1'];
                ?>
                <li style='background-image:url(<?= $images ?>);'>
                </li>
                <?php
                $count++;
            } ?>
        </ul>
        <div class="clr"></div>
    </div>
    <div class="padding_pagewrap">
        <div id="pro_tabs">
            <div class="box_tab">
                <ul class="listtabs">
                    <?php
                    foreach ($danhmuc_phong as $rows) {
                        $idp = $rows['id'];
                        $tenbaiviet = $rows['tenbaiviet_' . $lang];
                        ?>
                        <li><a href="#tab<?= $idp ?>" class=""><?= $tenbaiviet ?></a></li>
                    <?php } ?>
                    <div class="clr"></div>
                </ul>
            </div>
        </div>
        <?php
        foreach ($danhmuc_phong as $value) {
            $id = $value['id'];
            $tenbaiviet = $value['tenbaiviet_' . $lang];
            $image = $fullpath . "/" . $value['duongdantin'] . "/" . $value['icon'];
            $mota = $value['mota_'.$lang];
            ?>
            <input type="hidden" id="tabs<?=$id?>" value="<?=$id?>">
            <div class="tabs" value="<?=$id?>" id="tab<?= $id ?>">
                <div class="left_p">
                    <div data-src="<?= $image ?>"
                         class="preview fancybox.ajax"
                         href="<?= $full_url . "/pa-size-child/views-images/?table=".$slug_table."&step=".$slug_step."&img-link=" . $id ?>"
                         data-sub-html="<?= $tenbaiviet ?>"
                         onclick="showhinh(this)">
                        <a href="<?= $image ?>"><img src="<?= $image ?>" alt="<?= $tenbaiviet ?>"
                                                     title="<?= $tenbaiviet ?>"/></a>
                    </div>
                </div>
                <div class="right_p">
                    <ul>
                        <h3><?= $tenbaiviet ?></h3>
                        <p><?= $mota ?></p>
                    </ul>
                </div>
                <div class="clr"></div>
                <div class="box_datban_home ">
                    <div class="pagewrap">
                        <div class="title_page">ĐẶT BÀN</div>
                        <form action="" method="post" name="form_datbanhome" id="form_datbanhome" enctype="multipart/form-data">
                            <input type="hidden" name="send_datban">
                            <input type="hidden" class="lang_ok" value="<?=$glo_lang['yeu_cau_cua_ban_da_duoc_gui'] ?>">
                            <input type="hidden" class="lang_false" value="<?=$glo_lang['loi_xac_thuc_thu_lai_sau'] ?>">
                            <input type="hidden" name="tieude_lienhe"
                                   value="<?= (!empty($custometile)) ? base64_encode($custometile) : base64_encode($glo_lang['thong_tin_dat_ban']) ?>">
                            <?php
                            $datban = DB_fet("*", "#_baiviet", "`showhi` = 1 and `id_parent` = $id and step = " . $slug_step,
                                "catasort ASC, id ASC", "", 1, 1);
                            ?>
                            <div class="datban_home">
                                <ul>
                                    <li>
                                        <div class="col-md row-frm">
                                            <input type="hidden" name="s_maphong_s" value="<?= base64_encode($glo_lang['ma_phong']) ?>">
                                            <select onchange="submitForm(<?=$id?>)" name="s_maphong" id="s_maphong" class="cls_data_check_form form-control" data-rong="1" data-msso="<?=$glo_lang['chon_ma_phong'] ?>">
                                                <option value=""><?= $glo_lang['ma_phong'] ?></option>
                                                <?php
                                                foreach($datban as $rows){
                                                    $idb = $rows['id'];
                                                    $maphong = $rows['p1'];
                                                    ?>
                                                    <option value="<?=$idb?>"><?=$maphong?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-md row-frm">
                                            <input type="hidden" name="s_thongso_s" value="<?= base64_encode($glo_lang['thong_so']) ?>">
                                            <select disabled onchange="submitForm()" name="s_thongso" id="s_thongso" class="cls_data_check_form form-control" data-rong="1" data-msso="<?=$glo_lang['chon_thong_so'] ?>">
                                                <option value=""><?=$glo_lang['thong_so']?></option>
                                                <!--                                            --><?php
                                                //                                            $thongso = DB_fet("*", "#_baiviet", "`showhi` = 1 and `id_parent` = $id and step = " . $slug_step,
                                                //                                                "catasort ASC, id ASC", "", 1, 1);
                                                //                                            $ts = reset($thongso);
                                                //                                            $dtv = $ts['detail_vi'];
                                                //                                            $dtv = explode(",",tinhnangsp(6,$dtv,$lang,$slug_step));
                                                //                                            sort($dtv);
                                                //                                            $i = 1;
                                                //                                            foreach($dtv as $rows){
                                                //                                                ?>
                                                <!--                                                <option id="ts--><?//=$i?><!--" value="--><?//=$i?><!--">--><?//=$rows?><!--</option>-->
                                                <!--                                            --><?php //$i++;}?>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-md row-frm">
                                            <input type="hidden" name="s_fullname_s" value="<?= base64_encode($glo_lang['ho_va_ten']) ?>">
                                            <input class="cls_data_check_form form-control" data-rong="1" name="s_fullname" id="s_fullname" type="text"
                                                   placeholder="<?= $glo_lang['ho_va_ten'] ?> (*)"
                                                   onFocus="if (this.value == '<?= $glo_lang['ho_va_ten'] ?> (*)'){this.value='';}"
                                                   onBlur="if (this.value == '') {this.value='<?= $glo_lang['ho_va_ten'] ?> (*)';}"
                                                   data-name="<?= $glo_lang['ho_va_ten'] ?> (*)" data-msso="<?= $glo_lang['nhap_ho_ten'] ?>"/>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-md row-frm">
                                            <input type="hidden" name="s_email_s" value="<?= base64_encode($glo_lang['email']) ?>">
                                            <input class="cls_data_check_form form-control" data-rong="1" data-email="1" name="s_email" id="s_email" type="text"
                                                   placeholder="<?= $glo_lang['email'] ?> (*)"
                                                   onFocus="if (this.value == '<?= $glo_lang['email'] ?> (*)'){this.value='';}"
                                                   onBlur="if (this.value == '') {this.value='<?= $glo_lang['email'] ?> (*)';}"
                                                   data-msso="<?= $glo_lang['chua_nhap_dia_chi_email'] ?>"
                                                   data-msso1="<?= $glo_lang['dia_chi_email_khong_hop_le'] ?>"/>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-md row-frm">
                                            <input type="hidden" name="s_dienthoai_s" value="<?= base64_encode($glo_lang['so_dien_thoai']) ?>">
                                            <input class="cls_data_check_form form-control" data-rong="1" data-phone="1" name="s_dienthoai" id="s_dienthoai"
                                                   type="text" placeholder="<?= $glo_lang['so_dien_thoai'] ?> (*)"
                                                   onFocus="if (this.value == '<?= $glo_lang['so_dien_thoai'] ?> (*)'){this.value='';}"
                                                   onBlur="if (this.value == '') {this.value='<?= $glo_lang['so_dien_thoai'] ?> (*)';}"
                                                   data-name="<?= $glo_lang['so_dien_thoai'] ?> (*)" data-msso="<?= $glo_lang['nhap_so_dien_thoai'] ?>"
                                                   data-msso1="<?= $glo_lang['so_dien_thoai_khong_hop_le'] ?>"/>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-md row-frm">
                                            <input type="hidden" name="s_thoigian_s" value="<?= base64_encode($glo_lang['thoi_gian']) ?>">
                                            <input class="cls_data_check_form form-control" data-rong="1" name="s_thoigian" id="s_thoigian"
                                                   type="text" placeholder="<?= $glo_lang['thoi_gian'] ?> (*)"
                                                   onFocus="if (this.value == '<?= $glo_lang['thoi_gian'] ?> (*)'){this.value='';}"
                                                   onBlur="if (this.value == '') {this.value='<?= $glo_lang['thoi_gian'] ?> (*)';}"
                                                   data-name="<?= $glo_lang['thoi_gian'] ?> (*)" data-msso="<?= $glo_lang['nhap_thoi_gian'] ?>"/>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-md row-frm">
                                            <input type="hidden" name="s_ngaydat_s" value="<?= base64_encode($glo_lang['ngay_dat']) ?>">
                                            <input class="cls_data_check_form form-control datetimepicker" data-rong="1" name="s_ngaydat" id="s_ngaydat"
                                                   type="text" placeholder="<?= $glo_lang['ngay_dat'] ?> (*)"
                                                   onFocus="if (this.value == '<?= $glo_lang['ngay_dat'] ?> (*)'){this.value='';}"
                                                   onBlur="if (this.value == '') {this.value='<?= $glo_lang['ngay_dat'] ?> (*)';}"
                                                   data-name="<?= $glo_lang['ngay_dat'] ?> (*)" data-msso="<?= $glo_lang['nhap_ngay_dat'] ?>" readonly/>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-md row-frm">
                                            <input type="hidden" name="s_soluong_s" value="<?= base64_encode($glo_lang['so_luong_nguoi']) ?>">
                                            <input class="cls_data_check_form form-control"  name="s_soluong" id="s_soluong"
                                                   type="text" placeholder="<?= $glo_lang['so_luong_nguoi'] ?> (*)"
                                                   onFocus="if (this.value == '<?= $glo_lang['so_luong_nguoi'] ?> (*)'){this.value='';}"
                                                   onBlur="if (this.value == '') {this.value='<?= $glo_lang['so_luong_nguoi'] ?> (*)';}"
                                                   data-name="<?= $glo_lang['so_luong_nguoi'] ?> (*)" data-rong="1" data-msso="<?= $glo_lang['nhap_so_luong_nguoi'] ?>"/>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-md row-frm">
                                            <input type="hidden" name="s_title_s" value="<?= base64_encode($glo_lang['yeu_cau_them']) ?>">
                                            <input class="cls_data_check_form form-control" name="s_title" id="s_title" type="text" placeholder="<?= $glo_lang['yeu_cau_them'] ?>"
                                                   value="<?= !empty($_POST['s_title']) ? $_POST['s_title'] : '' ?>"
                                                   onFocus="if (this.value == '<?= $glo_lang['yeu_cau_them'] ?>'){this.value='';}"
                                                   onBlur="if (this.value == '') {this.value='<?= $glo_lang['yeu_cau_them'] ?>';}"
                                                   data-name="<?= $glo_lang['yeu_cau_them'] ?>"/>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-md row-frm">
                                            <input type="hidden" name="s_coso_s" value="<?= base64_encode($glo_lang['co_so']) ?>">
                                            <select disabled class="cls_data_check_form form-control" name="s_coso" id="s_coso" data-rong="1" data-msso="<?=$glo_lang['chon_co_so'] ?>">
                                                <option value=""><?= $glo_lang['co_so'] ?></option>
                                                <?php
                                                $coso = explode(".,",tinhnangsp(12,$detail_vi,$lang,$slug_step));
                                                krsort($coso);
                                                foreach ($coso as $value){
                                                    ?>
                                                    <option value="<?=$value?>"><?=$value?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </li>
                                    <div class="clr"></div>
                                    <h3>
                                        <a id="dat_ban" onclick="return CHECK_send_lienhe('<?=$full_url ?>/','#form_datbanhome', '.cls_data_check_form')">
                                            <?= $glo_lang['dat_ban_ngay'] ?><img src="images/loading2.gif" class="ajax_img_loading"></a>
                                        <input type="hidden" name="id_token" id="id_token" value="<?=$_SESSION['token'] = md5(RANDOM_chuoi(5)) ?>">
                                    </h3>
                                </ul>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="clr"></div>
    </div>
</div>
<script type="text/javascript">
    function submitForm(i) {
        var maphong = $("#s_maphong").val();
        var thongso = $("#s_thongso").val();

        if (!isEmpty(maphong)) {
            $("#s_thongso").removeAttr('disabled');
        }
        if (!isEmpty(thongso)) {
        }
        $.ajax({
            type: "POST",
            url: "<?= $full_url."/pa-dat-ban" ?>",
            data: {
                "id": $("#tabs"+i).val(),
                "maphong": $("#s_maphong").val(),
                "thongso": $("#s_thongso").val(),
                "slug_step": <?=$slug_step?>,
            },
            success: function (data) {
                data = JSON.parse(data);
                $("#s_thongso").html(data.data_thongso);
            }
        });
    }
</script>

