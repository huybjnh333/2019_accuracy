<?php 
	$sql_se             = DB_que("SELECT * FROM `#_seo` LIMIT 1");
	$sql_se             = mysql_fetch_assoc($sql_se);
	$favico             = Show_text($sql_se['favico']);
	$duongdantin        = Show_text($sql_se['duongdantin']);
	$favico = "../$duongdantin/$favico";

	if(isset($_POST['action_s']) && $_POST['action_s'] == "get_diadiem"){
		$id			= $_POST['id'];
		$text		= $_POST['text'];
		echo '<option value="0">'.$text.'</option>';
	    $diadiem = LAY_diadiem();
	    foreach ($diadiem as $val_1) { 
	        if($val_1['id_parent'] != $id) continue;
	      	echo '<option value="'.$val_1['id'].'">'.$val_1['tenbaiviet_vi'].'</option>';
	    }
		exit();
	}
	if(!empty($_POST['ajax_action']) && $_POST['ajax_action'] == 'quenmatkhau'){
		$email    = $_POST['email'];
		$mabaove  = $_POST['mabaove'];
		if($_SESSION['key_pass'] == $mabaove){
		  $sql = DB_que("SELECT * FROM `#_members` WHERE `showhi` = 1 AND `phanquyen` <> 0 AND `email` = '".$email."' LIMIT 1");
		    if(mysql_num_rows($sql) > 0)
		    {
		      unset($_SESSION['key_pass']);
		      $r      = mysql_fetch_assoc($sql);
		      $hoten  = $r['hoten'];
		      $active = md5(time())."P_A".md5(GET_ip());
		      $data                   = array();
		      $data['active']         = $active;      

		      $sql = ACTION_db($data, '#_members', 'update', NULL, "`email` = '".$email."' AND `phanquyen` <> 0");

		      $url        = $fullpath.'/nguoiquanly/index.php?module=change-password&email='.$r['email'].'&key='.$active;
		      $data_html  = file_get_contents("htmlbox/quen_mat_khau_vi.html");
		      $message    = str_replace(array("%hoten%", "%url%"), array($hoten, $url) , $data_html);
		      $subject    = "Hướng dẫn thay đổi mật khẩu";

		      $thongtin          = DB_que("SELECT * FROM `#_seo` LIMIT 1");
    		  $thongtin          = mysql_fetch_assoc($thongtin);

		      ob_start();
		      GUI_email("$email", "$hoten", "$subject", $_SERVER['SERVER_NAME'], $message, $thongtin, "admin");
		      ob_end_clean();
		      echo 0;
		  }
		  else
		  {   
		      echo 2;
		  }
		}else{
		  echo 1;
		}
		exit();
	}

	if(isset($_POST['admindangnhap']))
	{
		$sqlu = DB_que("SELECT `id`,`matkhau`,`keypass`, `phanquyen` FROM `#_members` WHERE showhi = 1 AND `tentruycap`='".mysql_real_escape_string($_POST['username'])."' AND `phanquyen` <> 0 LIMIT 1");
		if(@mysql_num_rows($sqlu))
		{
			$uid    = @mysql_result($sqlu,0,"id");
			$keypass  = @mysql_result($sqlu,0,"keypass");
			$matkhauin  = @mysql_result($sqlu,0,"matkhau");
			$matkhau  = create_pass($auto_key_pass.strip_tags($_POST['passmd5']),$keypass);
 
			$_SESSION['phanquyen'] = @mysql_result($sqlu,0,"phanquyen");
// die($matkhau);
			if($matkhauin != $matkhau)
			{
				ALERT_js("Tên đăng nhập hoặc mật khẩu không đúng!");
				LOCATION_js("index.php?module=login");
				exit();
			}
			else
			{
				$_SESSION['luluwebproadmin'] = @mysql_result($sqlu,0,"id");
				LOCATION_js("index.php");
			}
		}
		else
		{
			ALERT_js("Tên đăng nhập hoặc mật khẩu không đúng!");
			LOCATION_js("index.php?module=login");
			exit();
		}
	}
	if($module == 'forgot-password' && empty($_SESSION['luluwebproadmin'])){
		include "forgot-password.php";
		exit();
	}
	if($module == 'change-password' && empty($_SESSION['luluwebproadmin'])){
		include "change-password.php";
		exit();
	}

	if($module == 'login' && empty($_SESSION['luluwebproadmin'])){
		include "login.php";
		exit();
	}


	if(isset($_GET['action']) && $_GET['action'] == "dang-xuat")
	{
		unset($_SESSION['admin']);
		$_SESSION['luluwebproadmin'] = NULL;
		$_SESSION['phanquyen']     = NULL;
		LOCATION_js("index.php?module=login");
		exit();
	}
  
	if(empty($_SESSION['luluwebproadmin']))
	{
		LOCATION_js("index.php?module=login");
		exit();
	}
	
	if(!empty($_POST['ajax_send_img']) && $_POST['ajax_send_img'] == 1){
		$table = isset($_POST['table']) ? $_POST['table'] : "#_baiviet_img";
		foreach($_FILES['img_file']['name'] as $name => $value)
			{
				$duongdantin	= "galagy";
				$uploaddir 		= "../datafiles/$duongdantin/"; 

				$img_real_name 	= CONVERT_vn($_FILES['img_file']['name'][$name]);	
				$file 			= time()."_".$img_real_name;	
				$size 			= $_FILES['img_file']['size'][$name];
				$kietxuatid		= $_POST['kietxuatid'];
				$size_img		= $_POST['size_img'];


				if (move_uploaded_file($_FILES['img_file']['tmp_name'][$name], $uploaddir.$file)) 
				{ 
					if($size_img == ""){
						TAO_anhthumb($uploaddir.$file,$uploaddir."thumb_".$file, 500, 500, "images/trang_500_500.png");
					}
					else {
						$anh_sp = explode("x", $size_img);
			            $wid = $anh_sp[0];
			            $hig = $anh_sp[1];
						TAO_anhthumb($uploaddir.$file,$uploaddir."thumb_".$file, $wid, $hig, "images/trang_" . $wid . "_" . $hig . ".png");
					}
					TAO_anhthumb($uploaddir.$file,$uploaddir."thumbnew_".$file, 500, 500, "");
					$sql_in = DB_que("INSERT INTO $table (`p_name`,`id_parent`,`duongdantin`) VALUES('$file','$kietxuatid','$duongdantin')");
				} 
			}
		exit();
	}

	if(isset($_POST['action']) && $_POST['action'] == 'import_file'){
	    include "readexcel/index.php";
	    exit();
	}

	if(isset($_GET['export']) && $_GET['export'] == "excel"){
		include "export_excel.php";
	    exit();
	}

	if(!empty($_POST['ajax_action']) && $_POST['ajax_action'] == 'LOAD_danhmuc_mn'){
		$step    	= $_POST['id'];
		if($step == '-1'){
			$baiviet_arr  = DB_fet("*","#_baiviet", "`showhi` = '1' AND `step` = 0", "`catasort` DESC","", "arr");
			echo '<option value="0">Chọn danh mục</option>'; 
	    	foreach ($baiviet_arr as $row_1)
	            {		
	              	echo  '<option value="'.$row_1['id'].'">'.$row_1['tenbaiviet_vi'].'</option> ';
	            }
		}else{
			$chude_arr  = DB_fet("*","#_danhmuc", "`showhi` = '1' AND `step` = ".$step."", "`catasort` ASC","", "arr");
			echo '<option value="0">Chọn danh mục</option>'; 
	    	foreach ($chude_arr as $row_1)
	            {		
	            	if($row_1['id_parent'] != 0) continue;
	              	echo  '<option value="'.$row_1['id'].'">'.$row_1['tenbaiviet_vi'].'</option> ';
	              	foreach ($chude_arr as $row_2) 
			            {	
			            	if($row_2['id_parent'] != $row_1['id']) continue;	
			              	echo  '<option value="'.$row_2['id'].'">╚═►'.$row_2['tenbaiviet_vi'].'</option> ';
			              	foreach ($chude_arr as $row_3)
					            {	
					            	if($row_3['id_parent'] != $row_2['id']) continue;
					              	echo  '<option value="'.$row_3['id'].'"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;╙─►'.$row_3['tenbaiviet_vi'].'</option> ';
					              	foreach ($chude_arr as $row_4) 
							            {	
							            	if($row_4['id_parent'] != $row_3['id']) continue;
									        echo  '<option value="'.$row_4['id'].'"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;╙─►'.$row_4['tenbaiviet_vi'].'</option> ';

										}
								}
						}
				}
		}
		
		exit();
	}
	if(isset($_GET['module']) && $_GET['module'] == 'check_form'){
		include 'tao_form.php';
		exit();		
	}
	if(isset($_POST['ac_form_loai'])){
		$id 					= $_POST['id'];
		$loai 					= $_POST['ac_form_loai'];
		
		$data 					= array();
		$data['loai_from'] 		= $_POST['ac_form_loai'];
		$data['id_parent']		= $_POST['id_parent'];
		$data['tenbaiviet_vi']	= $_POST['tenbaiviet_vi'];
		$data['mota_vi']		= isset($_POST['mota_vi']) ? $_POST['mota_vi'] : "";
		$data['id_parent']		= $_POST['id_parent'];
		$data['ngaydang']		= time();
		$data['active'] 		= isset($_POST['active']) ? 1 : 0;

		
		if($id == 0){
			$id = ACTION_db($data, '#_form_danhmuc', 'add');

			
			if(isset($_POST['option']) && is_array($_POST['option'])){
				$stt = 0;
				foreach ($_POST['option'] as $value) {
					$data_new 				= array();
					$data_new['id_parent'] 		= $id;
					$data_new['tenbaiviet_vi']	= $value;
					$data_new['ngaydang']		= time();
					$data_new['catasort']		= $stt;
					if(trim($value) != ""){
						ACTION_db($data_new, '#_form_danhmuc', 'add');	
						$stt ++;
					}
					
					
				}
			}
			//lay danh sach cac option 
			$ds_option = DB_que("SELECT * FROM `#_form_danhmuc` WHERE `id_parent` = '$id'  ORDER BY `catasort` ASC ");
			$list_option = "";
			if(@mysql_num_rows($ds_option)){
				while ($r  = mysql_fetch_assoc($ds_option)) {
					if($loai == 3){
						$list_option .= '<option>'.SHOW_text($r['tenbaiviet_vi']).'</option>';
					}
					else if($loai == 4){
						$list_option .= '<label><input type="checkbox">'.SHOW_text($r['tenbaiviet_vi']).'</label>';
					}
					else if($loai == 5){
						$list_option .= '<label><input type="radio" name="name_'.$id.'">'.SHOW_text($r['tenbaiviet_vi']).'</label>';
					}
				}
			}
			
			//
			//
			if($loai == 1){
				$return = "<p>".$_POST['tenbaiviet_vi']."</p><input type='text' value='' placeholder='".$_POST['mota_vi']."'><a class='cur' onclick=\"THEM_button('".$id."')\">[Chỉnh sửa]</a><a class='cur xoa' onclick=\"XOA_popp('".$id."')\">[Xóa]</a>";
			}
			else if($loai == 2){
				$return = "<p>".$_POST['tenbaiviet_vi']."</p><textarea name='mota_vi' placeholder='".$_POST['mota_vi']."'></textarea><a class='cur' onclick=\"THEM_button('".$id."')\">[Chỉnh sửa]</a><a class='cur xoa' onclick=\"XOA_popp('".$id."')\">[Xóa]</a>";
			}
			else if($loai == 3){
				$return = "<p>".$_POST['tenbaiviet_vi']."</p><select><option>".$_POST['mota_vi']."</option>
                    ".$list_option."</select><a class='cur' onclick=\"THEM_button('".$id."')\">[Chỉnh sửa]</a><a class='cur xoa' onclick=\"XOA_popp('".$id."')\">[Xóa]</a>";
			}
			else if($loai == 4){
				$return = "<p>".$_POST['tenbaiviet_vi']."</p><div class='mt_radio'>".$list_option."</div><a class='cur' onclick=\"THEM_button('".$id."')\">[Chỉnh sửa]</a><a class='cur xoa' onclick=\"XOA_popp('".$id."')\">[Xóa]</a>";
			}
			else if($loai == 5){
				$return = "<p>".$_POST['tenbaiviet_vi']."</p><div class='mt_radio'>".$list_option."</div><a class='cur' onclick=\"THEM_button('".$id."')\">[Chỉnh sửa]</a><a class='cur xoa' onclick=\"XOA_popp('".$id."')\">[Xóa]</a>";
			}

			

			$return = '<li class="ui-state-default li_ac_id'.$id.'" data="'.$id.'">'.$return.'</li>';
			
		}else{
			ACTION_db($data, '#_form_danhmuc', 'update', NULL, "`id` = '".$id."'");	


			//xoa option
			DB_que("DELETE FROM `#_form_danhmuc` WHERE `id_parent` = '$id' ");
			//add moi
			if(isset($_POST['option']) && is_array($_POST['option'])){
				$stt = 0;
				foreach ($_POST['option'] as $value) {
					$data_new 				= array();
					$data_new['id_parent'] 		= $id;
					$data_new['tenbaiviet_vi']	= $value;
					$data_new['ngaydang']		= time();
					$data_new['catasort']		= $stt;
					if(trim($value) != ""){
						ACTION_db($data_new, '#_form_danhmuc', 'add');	
						$stt ++;
					}
					$stt ++;
				}
			}
			//lay danh sach cac option 
			$ds_option = DB_que("SELECT * FROM `#_form_danhmuc` WHERE `id_parent` = '$id'  ORDER BY `catasort` ASC ");
			$list_option = "";
			if(@mysql_num_rows($ds_option)){
				while ($r  = mysql_fetch_assoc($ds_option)) {
					if($loai == 3){
						$list_option .= '<option>'.SHOW_text($r['tenbaiviet_vi']).'</option>';
					}
					else if($loai == 4){
						$list_option .= '<label><input type="checkbox">'.SHOW_text($r['tenbaiviet_vi']).'</label>';
					}
					else if($loai == 5){
						$list_option .= '<label><input type="radio" name="name_'.$id.'">'.SHOW_text($r['tenbaiviet_vi']).'</label>';
					}
				}
			}
			//

			if($loai == 1){
				$return = "<p>".$_POST['tenbaiviet_vi']."</p><input type='text' value='' placeholder='".$_POST['mota_vi']."'><a class='cur' onclick=\"THEM_button('".$id."')\">[Chỉnh sửa]</a><a class='cur xoa' onclick=\"XOA_popp('".$id."')\">[Xóa]</a>";
			}
			else if($loai == 2){
				$return = "<p>".$_POST['tenbaiviet_vi']."</p><textarea name='mota_vi' placeholder='".$_POST['mota_vi']."'></textarea><a class='cur' onclick=\"THEM_button('".$id."')\">[Chỉnh sửa]</a><a class='cur xoa' onclick=\"XOA_popp('".$id."')\">[Xóa]</a>";
			}
			else if($loai == 3){
				$return = "<p>".$_POST['tenbaiviet_vi']."</p><select><option>".$_POST['mota_vi']."</option>
                    ".$list_option."</select><a class='cur' onclick=\"THEM_button('".$id."')\">[Chỉnh sửa]</a><a class='cur xoa' onclick=\"XOA_popp('".$id."')\">[Xóa]</a>";
			}
			else if($loai == 4){
				$return = "<p>".$_POST['tenbaiviet_vi']."</p><div class='mt_radio'>".$list_option."</div><a class='cur' onclick=\"THEM_button('".$id."')\">[Chỉnh sửa]</a><a class='cur xoa' onclick=\"XOA_popp('".$id."')\">[Xóa]</a>";
			}
			else if($loai == 5){
				$return = "<p>".$_POST['tenbaiviet_vi']."</p><div class='mt_radio'>".$list_option."</div><a class='cur' onclick=\"THEM_button('".$id."')\">[Chỉnh sửa]</a><a class='cur xoa' onclick=\"XOA_popp('".$id."')\">[Xóa]</a>";
			}
		}
		
		$arr = array('id' => $id, "text" => $return);
		echo json_encode($arr);
		exit();
	}
	if(isset($_POST['post_delete_form']) && $_POST['post_delete_form'] == "ok"){
		$id = $_POST['id'];
		DB_que("DELETE FROM `#_form_danhmuc` WHERE `id` = '".$id."' LIMIT 1");
		DB_que("DELETE FROM `#_form_danhmuc` WHERE `id_parent` = '".$id."'");
		exit();
	}
	if(isset($_POST['post_delete_form']) && $_POST['post_delete_form'] == "update_poop"){
		$list_id = $_POST['list_id'];
		$list_id = explode("_", $list_id);
		foreach ($list_id as $val) {
			if($val != ""){
				$id  = explode(":", $val);
				DB_que("UPDATE `#_form_danhmuc` SET `catasort` = '".$id[1]."' WHERE `id` = '".$id[0]."' LIMIT 1");
			} 
		}
		exit();
	}
?>