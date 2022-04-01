<div class="box_right_conten">
  <div class="title_page_1">
    <h3><?=search_bv ?></h3>
    <div class="clr"></div>
  </div>
  <div class="boder_right">
    <div class="timkiem_id">
      <div class="col-md-2 row-frm">
        <input name="product_search_name" data=".input_search_left" data-href="<?=$full_url ?>/search/"  class="input_search_left form-control" type="text" value="<?=nhap_tu_khoa_tim_kiem ?>" onfocus="if (this.value == '<?=nhap_tu_khoa_tim_kiem ?>'){this.value='';}" onblur="if (this.value == '') {this.value='<?=nhap_tu_khoa_tim_kiem ?>';}" />
      </div>
      <h2><a onclick="SEARCH_timkiem('.input_search_left', '<?=$full_url ?>/search/')"  style="cursor:pointer"><?=tim_kiem ?></a></h2>
      <div class="clr"></div>
    </div>
  </div>
</div>