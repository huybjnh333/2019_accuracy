<style>
  .row-frm select { height: 36px !important}
</style>

<form action="" method="post" name="formnamecontact3" id="formnamecontact3" enctype="multipart/form-data">
  <input type="hidden" name="send_lienhe">
  <input type="hidden" class="lang_ok" value="<?=$glo_lang['yeu_cau_cua_ban_da_duoc_gui'] ?>">
  <input type="hidden" class="lang_false" value="<?=$glo_lang['loi_xac_thuc_thu_lai_sau'] ?>">
  <input type="hidden" name="tieude_lienhe" value="<?=base64_encode($glo_lang['thong_tin_dat_phong']) ?>">
  <div class="dangnhap_popup no_box">
    <div class="titBox left">
      <h3 class="tit"><?=$glo_lang['thong_tin_dat_phong'] ?></h3>
    </div>
    <div class="row-frm">
      <p><?=$glo_lang['ngay_den'] ?> (*)</p>
      <input type="hidden" name="group_form_send_1_s" value="<?=base64_encode($glo_lang['ngay_den']) ?>">
      <input type="text" id="from_day_1" name="group_form_send_1" data-rong="1" data-msso="<?=$glo_lang['chon_ngay_den'] ?>" class="form-control cls_data_check_form_check_dangky" placeholder="" readonly>
    </div>
    <div class="row-frm">
      <p><?=$glo_lang['ngay_di'] ?> (*)</p>
      <input type="hidden" name="group_form_send_2_s" value="<?=base64_encode($glo_lang['ngay_di']) ?>">
      <input type="text" id="to_day_1" name="group_form_send_2" data-rong="1" data-msso="<?=$glo_lang['chon_ngay_di'] ?>" class="form-control cls_data_check_form_check_dangky" placeholder="" readonly>
    </div>
    
    <div class="row-frm">
      <p><?=$glo_lang['nguoi_lon'] ?> (*)</p>
      <input type="hidden" name="group_form_send_3_s" value="<?=base64_encode($glo_lang['nguoi_lon']) ?>">
      <select name="group_form_send_3" class="form-control cls_data_check_form_check_dangky" data-rong="1" data-msso="<?=$glo_lang['chon_nguoi_lon'] ?>">
        <option value=""><?=$glo_lang['nguoi_lon'] ?> (*)</option>
        <?php 
          for ($i=1; $i < 11; $i++) {  
        ?>
        <option value="<?=$i ?>"><?=$i ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="row-frm">
      <p><?=$glo_lang['tre_em'] ?></p>
      <input type="hidden" name="group_form_send_4_s" value="<?=base64_encode($glo_lang['tre_em']) ?>">
      <select name="group_form_send_4" class="form-control cls_data_check_form_check_dangky" data-rong="1" data-msso="<?=$glo_lang['chon_tre_em'] ?>">
        <option value="0"><?=$glo_lang['tre_em'] ?> </option>
        <?php 
          for ($i=0; $i < 11; $i++) {  
        ?>
        <option value="<?=$i ?>"><?=$i ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="row-frm">
      <p><?=$glo_lang['chon_loai_phong'] ?> (*)</p>
      <input type="hidden" name="group_form_send_5_s" value="<?=base64_encode($glo_lang['chon_loai_phong']) ?>">
      <select name="group_form_send_5" class="form-control cls_data_check_form_check_dangky" data-rong="1" data-msso="<?=$glo_lang['chua_chon_loai_phong'] ?>">
        <option value=""><?=$glo_lang['chon_loai_phong'] ?> (*)</option>
        <?php 
          $sp_baiviet = LAY_baiviet(2, 0);
          foreach ($sp_baiviet as $value) {
        ?>
        <option value="<?=$value['tenbaiviet_'.$lang] ?>"><?=$value['tenbaiviet_'.$lang] ?></option>
        <?php } ?>

      </select>
    </div>
    <div class="clr"></div>
    <div class="row-frm">
      <input type="hidden" name="group_form_send_6_s" value="<?=base64_encode($glo_lang['ho_va_ten']) ?>">
      <p><?=$glo_lang['ho_va_ten'] ?> (*)</p>
      <input type="text" name="group_form_send_6" class="form-control cls_data_check_form_check_dangky"  data-rong="1" data-msso="<?=$glo_lang['nhap_ho_ten'] ?>" value="">
    </div>
    <div class="row-frm">
      <p><?=$glo_lang['so_dien_thoai'] ?> (*)</p>
      <input type="hidden" name="group_form_send_7_s" value="<?=base64_encode($glo_lang['so_dien_thoai']) ?>">
      <input type="text" class="form-control cls_data_check_form_check_dangky" name="group_form_send_7"  data-rong="1" data-msso="<?=$glo_lang['nhap_so_dien_thoai'] ?>" value="" data-phone="1" data-msso1="<?=$glo_lang['so_dien_thoai_khong_hop_le'] ?>">
    </div>
    <div class="row-frm">
      <p><?=$glo_lang['dia_chi'] ?></p>
      <input type="hidden" name="group_form_send_8_s" value="<?=base64_encode($glo_lang['dia_chi']) ?>">
      <input type="text" name="group_form_send_8" class="form-control test" value="">
    </div>
    <div class="row-frm">
      <p><?=$glo_lang['email'] ?></p>
      <input type="hidden" name="group_form_send_9_s" value="<?=base64_encode($glo_lang['email']) ?>">
      <input type="text" value=""  name="group_form_send_9"  class="form-control cls_data_check_form_check_dangky" data-email="1" data-msso1="<?=$glo_lang['dia_chi_email_khong_hop_le'] ?>"  >
    </div>
    <div class="box_dangnhap_popup">
      <a onclick="return CHECK_send_lienhe('<?=$full_url ?>/','#formnamecontact3', '.cls_data_check_form_check_dangky')" class="cur"><?=$glo_lang['dat_phong'] ?> <img src="images/loading2.gif" class="ajax_img_loading"></a>
      <input type="hidden" name="id_token" id="id_token" value="<?=$_SESSION['token'] = md5(RANDOM_chuoi(5)) ?>">
    </div>
    <div class="clr"></div>
  </div>
</form>
<script>
  $(".timkiemphong.noclick").click(function(event){
    LOAD_popup_new('<?=$full_url ?>/pa-size-child/dat-phong-sb/');
    event.stopPropagation();
  });
  $( function() {
    var dateFormat = "dd-mm-yy",
      from = $( "#from_day_1" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          minDate: '<?=date('d', time()) ?>-<?=date('m', time()) ?>-<?=date('Y', time()) ?>',
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate_new( this ) );
        }),
      to = $( "#to_day_1" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        minDate: '<?=date('d', time()) ?>-<?=date('m', time()) ?>-<?=date('Y', time()) ?>',
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate_new( this ) );
      });

    function getDate_new( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }

      return date;
    }
  } );
</script>