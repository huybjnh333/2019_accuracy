<nav class="navbar navbar-static-top">
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>

  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <?php if( $_SESSION['phanquyen'] == 1) { ?>
      <!-- Quan ly main menu-->
      <li>
        <a href="?module=quan-ly-main-menu&action=danh-sach-main-menu">
          <i class="fa fa-navicon"></i>
          Main module
        </a>
      </li>
      <?php } ?>
      <!-- Dien thoai ho tro-->
      <li>
        <a href="tel:1900 9477">
          <i class="fa fa-phone"></i>
          Hỗ trợ 24/7: 1900 9477
        </a>
      </li>
      <!-- Link toi mail ho tro -->
      <li>
        <a href="mailto:web@pavietnam.vn">
          <i class="fa fa-envelope-o"></i>
          web@pavietnam.vn
        </a>
      </li>
      <!-- Ra trang chinh ben ngoai-->
      <li>
        <a href="?module=quan-ly-thanh-vien&action=dang-xuat">
          <i class="fa fa-sign-out"></i>
          Đăng xuất
        </a>
      </li>
    </ul>
  </div>
</nav>
