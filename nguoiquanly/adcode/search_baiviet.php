<?php
if (!defined("_source")) exit();

$data = DB_fet("*", "#_module_setting", 'id=38', "", "1", "arr", 1);
$data = reset($data);
$array_dm = explode(',', $data['ten_key']);

?>
<div class="input-group input-group-sm input-group-sm-timkiem">
    <input name="ksearch" type="text" value="<?= $s_ksearch ?>" class="form-control pull-right key_search"
           placeholder="Nhập từ khóa cần tìm kiếm">
    <div class="input-group-btn">
        <button name='search' type="button" class="btn btn-default btn_search_ds" onclick='SEARCH_jsstep()'><i
                    class="fa fa-search"></i></button>
    </div>
</div>
<div class="dv-hd-locsds">
    <?php if (in_array($step, $array_dm)) { ?>
        <div class="form-group">
            <?= DANHSACH_chude_href($s_chude, "#_danhmuc", "Tất cả chủ đề", $step) ?>
        </div>
    <?php } ?>
    <div class="form-group">
        <select name='docid' class="js_trangthai_js form-control" onchange='SEARCH_jsstep()'>
            <option selected="selected" value="0">Trạng thái</option>
            <option value="1" <?= LAY_selected(1, $s_trangthai) ?>>Hiện</option>
            <option value="2" <?= LAY_selected(2, $s_trangthai) ?>>Ẩn</option>
        </select>
    </div>
    <div class="form-group">
        <select name="viewid" class="js_hienthi_ds form-control" onchange='SEARCH_jsstep()'>
            <option selected="selected" value="0">Hiển thị</option>
            <option value="1" <?= LAY_selected(1, $s_hienthi) ?>>15</option>
            <option value="2" <?= LAY_selected(2, $s_hienthi) ?>>30</option>
            <option value="3" <?= LAY_selected(3, $s_hienthi) ?>>60</option>
            <option value="4" <?= LAY_selected(4, $s_hienthi) ?>>100</option>
            <option value="5" <?= LAY_selected(5, $s_hienthi) ?>>200</option>
        </select>
    </div>
</div>
<script type="text/javascript">
    function SEARCH_jsstep() {
        var url = "";
        if ($(".key_search").length > 0) {
            var key_search = $(".key_search").val().trim().replace(/ /g, "+");
            if (key_search != "") url += "&ksearch=" + key_search;
        }
        if ($(".cls_chude").length > 0) {
            var cls_chude = $(".cls_chude").val().trim();
            if (cls_chude != 0) url += "&chu-de=" + cls_chude;
        }
        if ($(".js_trangthai_js").length > 0) {
            var js_trangthai_js = $(".js_trangthai_js").val().trim();
            if (js_trangthai_js != 0) url += "&trang-thai=" + js_trangthai_js;
        }
        if ($(".js_hienthi_ds").length > 0) {
            var js_hienthi_ds = $(".js_hienthi_ds").val().trim();
            if (js_hienthi_ds != 0) url += "&hien-thi=" + js_hienthi_ds;
        }
        window.location.href = "<?=$url_page ?>&step=<?=$step?>&id_step=<?=$id_step?>" + url;
    }
</script>