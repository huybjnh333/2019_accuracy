<div class="user-panel">
    <div class="pull-left image">
        <a href="<?= $fullpath_admin ?>" target="_blank">
            <img src="<?= $favico ?>" class="img-circle">
        </a>
    </div>
    <div class="pull-left info">
        <a href="<?= $fullpath_admin ?>" target="_blank">Administrator</a>
        <p><a href="../" target="_blank">Xem website</a></p>
    </div>
</div>
<section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">CHỨC NĂNG HỆ THỐNG</li>
        <li>
            <a href="<?= $fullpath_admin ?>">
                <i class="fa fa-home"></i><span>Trang chủ</span>
            </a>
        </li>
        <?php 
            $sql        = DB_que("SELECT * FROM `#_module_tinhnang` WHERE `showhi` = 1 ORDER BY `sort` ASC ");
            $sql_array  =  array();
            while ($r   = mysql_fetch_assoc($sql)) {
              $sql_array[] = $r;
            }
            $m_dev_left = isset($_SESSION['admin']) ? 1 : 0;

            foreach ($sql_array as $value) {
                if($value['id_parent'] != 0) continue;
                if($value['m_dev'] == 1 && $value['m_dev'] != $m_dev_left) continue;
                if(!SHOW_menu_left($glo_quyen, "", 'tn_'.$value['id'])) continue;
                
                $nhom_2 = "";
                foreach ($sql_array as $value_2) {
                    if($value_2['id_parent'] != $value['id']) continue;
                    if($value_2['m_dev'] == 1 && $value_2['m_dev'] != $m_dev_left) continue;

                    if(!SHOW_menu_left($glo_quyen, "", 'tn_'.$value_2['id']) && $value_2['m_other'] == 0) continue;

                    $nhom_3 = "";
                    foreach ($sql_array as $value_3) {
                        if($value_3['id_parent'] != $value_2['id']) continue;
                        if($value_3['m_dev'] == 1 && $value_3['m_dev'] != $m_dev_left) continue;
                        if(!SHOW_menu_left($glo_quyen, "", 'tn_'.$value_3['id'])  && $value_3['m_other'] == 0) continue;

                       $nhom_3 .= '<li><a href="'.$value_3['lien_ket'].'"><i class="'.($value_3['icon'] != "" ? $value_3['icon'] : "fa fa-circle-o").'"></i> '.$value_3['ten_vi'].'</a></li>';
                    }
 
                    $nhom_2 .= '<li class="'.($nhom_3 != "" ? 'treeview' : "").'"><a href="'.$value_2['lien_ket'].'"><i class="'.($value_3['icon'] != "" ? $value_2['icon'] : "fa fa-circle-o").'""></i> <span>'.$value_2['ten_vi'].'</span>'.($nhom_3 != "" ? '<span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>' : "").'</a>'.($nhom_3 != "" ? '<ul class="treeview-menu">'. $nhom_3 .'</ul>' : "").'</li>';
                }
        ?>
        <li class="treeview">
            <a href="<?=$value['lien_ket'] ?>">
                <i class="<?=$value['icon'] != "" ? $value['icon'] : "fa fa-circle-o" ?>"></i> <span><?=$value['ten_vi'] ?></span>
                <?=$nhom_2 != "" || $value['m_action'] == 'main-module' ? '<span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>' : "" ?>
            </a>
            <?php 
                if($value['m_action'] != 'main-module'){
                    echo $nhom_2 != "" ? '<ul class="treeview-menu">'.$nhom_2.'</ul>' : "";
                }else{
            ?>
            <!-- //module -->
            <ul class="treeview-menu">
                <?php 
                    $name_bg        = "";
                    $check_dm       = DB_que("SELECT * FROM `#_module_setting` WHERE `id` = '38' LIMIT 1");
                    $check_dm       = mysql_fetch_assoc($check_dm);
                    $check_tn       = DB_que("SELECT * FROM `#_module_setting` WHERE `id` = '39' LIMIT 1");
                    $check_tn       = mysql_fetch_assoc($check_tn);
                    $array_tn       = explode(",", $check_tn['ten_key']);

                    $array_only_bv  = explode(",", $check_dm['ten_key']);
                    foreach (LEFT_mainmenu_new() as $val) { 
                        if(!SHOW_menu_left($glo_quyen, "", $val['id'])) continue;
                ?> 
                <li class="treeview">
                  <a href="JavaScript:"><i class="fa fa-circle-o"></i> <?=$val['cataname'] ?>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="?module=main-module&action=danh-sach-bai-viet&them-moi=true&step=<?=$val['step'] ?>&id_step=<?=$val['id_step'] ?>"><i class="fa fa-circle-o"></i>Thêm <?=$val['name'] ?></a></li>
                    <li><a href="?module=main-module&action=danh-sach-bai-viet&step=<?=$val['step'] ?>&id_step=<?=$val['id_step'] ?>"><i class="fa fa-circle-o"></i>Danh sách <?=$val['name'] ?></a></li>
                    <?php if(in_array($val['id'], $array_only_bv)){ ?>
                    <li><a href="?module=main-module&action=danh-sach-chu-de&them-moi=true&step=<?=$val['step'] ?>&id_step=<?=$val['id_step'] ?>"><i class="fa fa-circle-o"></i> Thêm chủ đề</a></li>
                    <li><a href="?module=main-module&action=danh-sach-chu-de&step=<?=$val['step'] ?>&id_step=<?=$val['id_step'] ?>"><i class="fa fa-circle-o"></i> Danh sách chủ đề</a></li>
                    <?php } if(in_array($val['id'], $array_tn)){ ?>

                    <li><a href="?module=main-module&action=danh-sach-tinh-nang&them-moi=true&step=<?=$val['step'] ?>&id_step=<?=$val['id_step'] ?>"><i class="fa fa-circle-o"></i> Thêm tính năng</a></li>
                    <li><a href="?module=main-module&action=danh-sach-tinh-nang&step=<?=$val['step'] ?>&id_step=<?=$val['id_step'] ?>"><i class="fa fa-circle-o"></i> Danh sách tính năng</a></li>
                    <?php } ?>
                  </ul>
                </li>
                <?php } ?>
            </ul>
            <?php } ?>
            <!-- end -->
        </li>
    <?php } ?>


    <?php if (!empty($_SESSION['admin'])) { ?>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-cogs"></i> <span>Module hệ thống</span>
                <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="?module=module-he-thong&action=danh-sach-hien-thi-page&them-moi=true"><i
                                class="fa fa-circle-o"></i> Thêm hiển thị</a></li>
                <li><a href="?module=module-he-thong&action=danh-sach-hien-thi-page"><i class="fa fa-circle-o"></i> Danh
                        sách hiển thị</a></li>
                <li><a href="?module=module-he-thong&action=danh-sach-setting&them-moi=true"><i
                                class="fa fa-circle-o"></i> Thêm setting</a></li>
                <li><a href="?module=module-he-thong&action=danh-sach-setting"><i class="fa fa-circle-o"></i> Danh sách
                        setting</a></li>
                <li><a href="?module=module-he-thong&action=danh-sach-tinh-nang-admin&them-moi=true"><i
                                class="fa fa-circle-o"></i> Thêm tính năng</a></li>
                <li><a href="?module=module-he-thong&action=danh-sach-tinh-nang-admin"><i class="fa fa-circle-o"></i>
                        Danh sách tính năng</a></li>
            </ul>
        </li>

    <?php } ?>
    </ul>
</section>