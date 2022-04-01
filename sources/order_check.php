<?php
  $step_name = select_one('*', '#_step', '`showhi` = 1 AND `step` = 2');
//include _source.'box-header.php';
include _source.'phantrang_kietxuat.php';

?>

<div class="link_page">
    <div class="pagewrap">
        <ul>
            <li><a href="<?= $full_url ?>"><?= $glo_lang['trang_chu'] ?></a></li>
            <li><a href="<?= $full_url.'/kiem-tra-don-hang/' ?>"><i aria-hidden="true"></i>
                                                <?= $glo_lang['kiem_tra_don_hang'] ?></a></li>
        </ul>
        <div class="clr"></div>
    </div>
</div>
<div class="pagewrap page_conten_page">
      <div class="timkiemdonhang">
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
    window.location.href= "<?=$full_url ?>/kiem-tra-don-hang/"+madh;
  }
</script>
