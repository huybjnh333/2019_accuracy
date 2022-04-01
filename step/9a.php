<?php
//// Update Luot view
//$data['soluotxem'] = $arr_running['soluotxem'] + 1;
//ACTION_db($data, '#_baiviet', 'update', NULL, "`id` = " . $arr_running['id']);
//// Update Luot view
//
//if ($slug_step == "0") {
//    $data['soluotxem'] = array();
//    $data['soluotxem'] = $arr_running['soluotxem'] + 1;
//    ACTION_db($data, '#_baiviet', 'update', NULL, "`id` = " . $arr_running['id']);
//    $bre = SHOW_text($arr_running['tenbaiviet_' . $lang]);
//} else if (!empty($thongtin_step)) {
//    $bre = SHOW_text($thongtin_step['tenbaiviet_' . $lang]);
//}
include _source . "box-header.php";
include _source . "phantrang_kietxuat.php";

$danhmuc_phong = DB_fet("*", "#_danhmuc", "`showhi` = 1 and step = " . $slug_step,
    "catasort ASC, id ASC", "", 1, 1);
?>
<div class="imges_id_page" style="background-image:url(<?= $image ?>);"></div>
<div class="pagewrap page_conten_page">
    <div class="title_page title_page_2"><?=$thongtin_step['tenbaiviet_'.$lang]?></div>
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
                        <li><a href="#tab<?= $idp ?>" class="limit-row-2"><p><?= $tenbaiviet ?></p></a></li>
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
            $mota = $value['mota_' . $lang];
            ?>
            <input type="hidden" id="tabs<?= $id ?>" value="<?= $id ?>">
            <div class="tabs" value="<?= $id ?>" id="tab<?= $id ?>">
                <div class="left_p">
                    <div data-src="<?= $image ?>"
                         class="preview fancybox.ajax"
                         href="<?= $full_url . "/pa-size-child/views-images/?table=" . $slug_table . "&step=" . $slug_step . "&img-link=" . $id ?>"
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
                <div class="box_datban_home">
                    <div class="pagewrap">
                        <div class="title_page"><?= $glo_lang['dat_ban'] ?></div>
                        <?php include _source."lien_he_dat_ban.php";?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="clr"></div>
    </div>
</div>
<script type="text/javascript">
    function submitForm(i) {
        var maphong = $("#s_maphong"+i).val();
        if (!isEmpty(maphong)) {
            $("#s_thongso"+i).removeAttr('disabled');
        }else{
            $("#s_thongso"+i).attr('disabled','');
        }
        $.ajax({
            type: "POST",
            url: "<?= $full_url . "/pa-dat-ban" ?>",
            data: {
                "id": $("#tabs" + i).val(),
                "maphong": $("#s_maphong"+i).val(),
                "thongso": $("#s_thongso"+i).val(),
                "thoigian": $("#s_thoigian"+i).val(),
                "coso": $("#s_coso"+i).val(),
                "slug_step": <?=$slug_step?>,
            },
            success: function (data) {
                data = JSON.parse(data);
                $("#s_thongso"+i).html(data.data_thongso);
                $("#s_thoigian"+i).html(data.data_thoigian);
                $("#s_coso"+i).html(data.data_coso);
            }
        });
    }

    function onChange(i) {
        var thongso = $("#s_thongso" +i).val();
        var ngaydat = $("#s_ngaydat" +i).val();
        var thoigian = $("#s_thoigian" +i).val();
        var coso = $("#s_coso" + i).val();

        if (!isEmpty(thongso)) {
            $("#s_ngaydat"+i).removeAttr('disabled');
            if (!isEmpty(ngaydat)) {
                $("#s_thoigian"+i).removeAttr('disabled');
                if(!isEmpty(thoigian)){
                    $.ajax({
                        type: "POST",
                        url: "<?= $full_url . "/pa-dat-ban" ?>",
                        data: {
                            "id": $("#tabs" + i).val(),
                            "maphong": $("#s_maphong"+i).val(),
                            "thongso": $("#s_thongso"+i).val(),
                            "ngaydat": $("#s_ngaydat"+i).val(),
                            "thoigian_chon": $("#s_thoigian"+i).val(),
                            "coso_chon": $("#s_coso"+i).val(),
                            "coso": $("#s_coso"+i).val(),
                            "slug_step": <?=$slug_step?>,
                        },
                        success: function (data) {
                            data = JSON.parse(data);
                            if(data.data == 1){
                                $("#s_coso"+i).removeAttr('disabled');
                                $("#dat_ban"+i).removeClass('hidden');
                            }else if(data.data == 2){
                                $("#dat_ban"+i).addClass("hidden");
                                cusNotify({mess: $(".lang_hetban").val(), type: 'error', postion: 1});
                            }
                        }
                    });
                }else{
                    $("#s_coso"+i).attr("disabled","");
                }
            } else{
                $("#s_thoigian"+i).attr("disabled","");
            }
        }
        // else{
        //     $("#s_ngaydat"+i).datepicker("setDate", null );
        //     $("#s_ngaydat"+i).datepicker("option", "disabled", true );
        // }

    }
</script>

