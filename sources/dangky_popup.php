<div class="ungtuyen_popup">
    <form action="" method="post" name="dangkythanhvien" id="dangkythanhvien">
        <div class="title_id"><?= $glo_lang['title_dang_ky'] ?></div>
        <div class="col-md-4 row-frm">
            <input placeholder="<?= $glo_lang['email'] ?> (*)"
                   type="text"
                   name="email_dk"
                   class="form-control cls_data_check_form_check_dangky" data-rong="1"
                   data-email="1" data-msso="<?= $glo_lang['chua_nhap_dia_chi_email'] ?>"
                   data-msso1="<?= $glo_lang['dia_chi_email_khong_hop_le'] ?>">
        </div>
        <div class="col-md-4 row-frm">
            <input placeholder="<?= $glo_lang['login_pass'] ?> (*)"
                   type="password"
                   name="pass_dk"
                   class="form-control cls_data_check_form_check_dangky"
                   id="pass_dk"
                   data-rong="1" data-msso="<?= $glo_lang['login_nhap_mat_khau'] ?>">
        </div>
        <div class="col-md-4 row-frm">
            <input placeholder="<?= $glo_lang['register_repass'] ?> (*)"
                   type="password"
                   name="repass_dk"
                   class="form-control cls_data_check_form_check_dangky" id="repass_dk"
                   id-khac="#pass_dk" data-rong="1" data-khac="1"
                   data-msso="<?= $glo_lang['vui_long_nhap_lai_mat_khau'] ?>"
                   data-msso1="<?= $glo_lang['nhap_lai_mat_khau_khong_chinh_xac'] ?>">
        </div>
        <div class="clr"></div>
        <div class="col-md-4 row-frm">

            <input placeholder="<?= $glo_lang['ho_va_ten'] ?> (*)"
                   type="text"
                   name="fullname_dk"
                   class="form-control cls_data_check_form_check_dangky"
                   data-rong="1"
                   data-msso="<?= $glo_lang['nhap_ho_ten'] ?>">
        </div>
        <div class="col-md-4 row-frm">
            <input placeholder="<?= $glo_lang['so_dien_thoai'] ?> (*)"
                   type="text"
                   id="phone_dk"
                   class="form-control cls_data_check_form_check_dangky"
                   name="phone_dk"
                   data-rong="1"
                   data-phone="1"
                   data-msso="<?= $glo_lang['nhap_so_dien_thoai'] ?>"
                   data-msso1="<?= $glo_lang['so_dien_thoai_khong_hop_le'] ?>">
        </div>
        <div class="col-md-4 row-frm">
            <input placeholder="<?= $glo_lang['dia_chi'] ?> (*)"
                   type="text"
                   name="diachi"
                   class="form-control test">
        </div>
        <label class="checkbox">
            <input type="checkbox" id="thoa_thuan" name="thoa_thuan">
            <?= $glo_lang['dieu_khoan_dk_thanh_vien'] ?></label>
      <div class="box_dangnhap_popup">
          <h2><a class="cur" onClick="check_dangky()"><?= $glo_lang['dang_ky'] ?> <img class="img_load_from_dktv"
                                                                                       src="images/loading2.gif"></a>
          </h2>
      </div>
      <div class="clr"></div>
    </form>
</div>
