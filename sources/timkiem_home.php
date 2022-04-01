<?php 
    $tinnang = DB_fet("*", "#_baiviet_tinhnang", "`showhi` = 1 AND `step` = 2","`catasort` ASC, `id` DESC","", "arr");
?>
<div class="timkiemtour">
  <div class="pagewrap">
    <div class="tktour">
        <div class="col-md-1 row-frm">
          <select name="cont_city" class="form-control" id="khoihahtu">
            <?php 
                $from = isset($_GET['from']) ? LOC_char($_GET['from']) : '';
                foreach ($tinnang as $val) {
                    if($val['id'] != 88) continue;
            ?>
            <option value=""><?=$val['tenbaiviet_'.$lang] ?></option>
            <?php 
                foreach ($tinnang as $val2) {
                    if($val2['id_parent'] != $val['id']) continue;
            ?>
            <option value="<?=$val2['id'] ?>" <?=LAY_selected($from, $val2['id']) ?>><?=$val2['tenbaiviet_'.$lang] ?></option>
            <?php }} ?>
          </select>
        </div>
        <div class="col-md-1 row-frm">
            <select name="cont_city" class="form-control" id="loaitour">
                <option value=""><?=$glo_lang['loai_tour'] ?></option>
                <?php 
                    $danhmuc = DB_fet("*", "#_danhmuc", "`showhi` = 1 AND `step` = 2","`catasort` ASC, `id` DESC","", "arr");
                ?>
                <?php 
                    $from = isset($_GET['tour']) ? LOC_char($_GET['tour']) : '';
                    foreach ($danhmuc as $val) {
                        if($val['id_parent'] != 0) continue;
                ?>
                <option value="<?=$val['id'] ?>" <?=LAY_selected($from, $val['id']) ?>><?=$val['tenbaiviet_'.$lang] ?></option>
                <?php 
                    foreach ($danhmuc as $val2) {
                        if($val2['id_parent'] != $val['id']) continue;
                ?>
                <option value="<?=$val2['id'] ?>" <?=LAY_selected($from, $val2['id']) ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$val2['tenbaiviet_'.$lang] ?></option>
                <?php 
                    foreach ($danhmuc as $val3) {
                        if($val3['id_parent'] != $val2['id']) continue;
                ?>
                <option value="<?=$val3['id'] ?>" <?=LAY_selected($from, $val3['id']) ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$val3['tenbaiviet_'.$lang] ?></option>

                <?php }}} ?>
            </select>
        </div>
        <div class="col-md-1 row-frm">
          <select name="cont_city" class="form-control" id="noiden">
            <?php 
                $from = isset($_GET['des']) ? LOC_char($_GET['des']) : '';
                foreach ($tinnang as $val) {
                    if($val['id'] != 107) continue;
            ?>
            <option value=""><?=$val['tenbaiviet_'.$lang] ?></option>
            <?php 
                foreach ($tinnang as $val2) {
                    if($val2['id_parent'] != $val['id']) continue;
            ?>
            <option value="<?=$val2['id'] ?>" <?=LAY_selected($from, $val2['id']) ?>><?=$val2['tenbaiviet_'.$lang] ?></option>
            <?php 
                foreach ($tinnang as $val3) {
                    if($val3['id_parent'] != $val2['id']) continue;
            ?>
            <option value="<?=$val3['id'] ?>" <?=LAY_selected($from, $val3['id']) ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$val3['tenbaiviet_'.$lang] ?></option>

            <?php }}} ?>
          </select>
        </div>
        
        <div class="col-md-1 row-frm">
            <input type="text" name="cont_cmnd"  class="form-control  ngaykhoihanh" id="datepicker" placeholder="<?=$glo_lang['ngay_khoi_hanh'] ?>" readonly="readonly" value="<?=isset($_GET['day']) ? LOC_char($_GET['day']) : ''; ?>" onclick="$(this).val('')">
        </div>
        <div class="col-md-1 row-frm">
            <input type="text" name=""  class="form-control  ngayketthuc" id="datepicker2" placeholder="<?=$glo_lang['ngay_ket_thuc'] ?>" readonly="readonly" value="<?=isset($_GET['day-end']) ? LOC_char($_GET['day-end']) : ''; ?>" onclick="$(this).val('')">
        </div>
        <div class="box_timtour">
          <h2><a class="cur" onclick="TIM_KIEM_tour()"><?=$glo_lang['tim_kiem'] ?></a></h2>
        </div>
        <div class="clr"></div>
    </div>
  </div>
</div>
<link rel="stylesheet" href="css/jquery-ui.css">
<script src="js/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  });
  $( function() {
    $( "#datepicker2" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  });
  function TIM_KIEM_tour(){
    window.location.href = "<?=$full_url ?>/search/?from="+$("#khoihahtu").val()+"&tour="+$("#loaitour").val()+"&des="+$("#noiden").val()+"&day="+$(".ngaykhoihanh").val()+"&day-end="+$(".ngayketthuc").val();
    
  }
</script>
