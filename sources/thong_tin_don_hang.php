<?php
include _source.'phantrang_kietxuat.php';

  if(!isset($_GET['madh']) || $_GET['madh'] == '' || !isset($_GET['email']) || $_GET['email'] == '')
//  LOCATION_js($full_url.'/tra-cuu-don-hang/');

  $step_name  = DB_fet("*", "#_step", "`showhi` = 1 AND `step` = 2", "`id` DESC", 1);
  $step_name  = mysql_fetch_assoc($step_name);

    $donhang    = DB_fet("*", "`#_order`", "`madh` = '".$haity."'", "`id` DESC", 1);
    $donhang    = mysql_fetch_assoc($donhang);

    $info_donhang = DB_fet(
            "*",
        "#_seo",
        "",
        "",
        "",
        "1"
    );
?>
<div class="link_page">
    <div class="pagewrap">
        <ul>
            <li><a href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a></li>
            <li><a href="<?= $full_url.'/thong-tin-dang-hang/' ?>"><i aria-hidden="true"></i>
                    <?= $glo_lang['thong_tin_dat_hang'] ?></a></li>
        </ul>
        <div class="clr"></div>
    </div>
</div>
<div class="pagewrap page_conten_page">
    <div class="info-donhang ">
        <?php
            $info_donhang = DB_que("SELECT * FROM `#_seo` ");
            $info_donhang = mysql_fetch_assoc($info_donhang);
            $image = $fullpath.'/'.$info_donhang['duongdantin'].'/'.$info_donhang['logo'];
        ?>
        <div class="img">
            <img alt="logo" src="<?= $image ?>">
        </div>
        <div class="ctyname"><?= $info_donhang['tencongty_'.$lang] ?></div>
    </div>
    <div class="info-donhang ">
        Cám ơn quý khách đã đặt hàng tại <?= $info_donhang['tencongty_'.$lang] ?> </div>
    <div class="timkiemdonhang hidden">
        <div class="timkiem_top kiemtradonhang">
            <div class="search">
                <a onclick="checkOrder()"  style="cursor:pointer"><i class="fa fa-search"></i></a>
                <input type="text" name="madh" id="madh" onchange="checkOrder()" class="input_search mdh "  placeholder="<?= $glo_lang['nhap_ma_don_hang'] ?>" value="<?php if($motty == "kiem-tra-don-hang") echo htmlentities(urldecode($haity)) ?>">
                <div class="clr"></div>
            </div>
        </div>
    </div>
    <div class="clr"></div>
    <div class="thongtinchitiet">
        <?php
        if (!isset($haity)) {
            echo "<div class='dv-notfull'>" . $glo_lang['khong_tim_thay_du_lieu_nao'] . "</div>";
        } else {
            include _source.'kiem_tra_don_hang.php';
        }
        ?>
    </div>
</div>

<script type="text/javascript">
    function checkOrder(){
        $(".madh-error").html("");
        if($("#madh").val() == '')
        {
            $(".madh-error").html("<?=$glo_lang['nhap_ma_dh'] ?>");
            $("#madh").focus();
            return false;
        }
        var madh  = $("#madh").val();
        window.location.href= "<?=$full_url ?>/thong-tin-dat-hang/"+madh;
    }
</script>