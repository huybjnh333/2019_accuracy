<?php
	if(!defined("luu_lai")) exit();
	$id = addslashes($_POST['id']);
	$sql_se           = DB_que("SELECT * FROM `#_file_import_data` WHERE `id`='".$id."' LIMIT 1");
	$sql_se           = mysql_fetch_array($sql_se);

	$duongdantin      = SHOW_text($sql_se['duongdantin']);
	$file_excel       = SHOW_text($sql_se['file_excel']);
	
	include 'simplexlsx.class.php';
	$file = "../$duongdantin/$file_excel";
	if(is_file($file)){
		if ($xlsx = SimpleXLSX::parse($file)) {
			$list_row = $xlsx->rows();
			
			$i =0;
			$j =0;
			foreach ($list_row as $value) {
				$i++;
				$qr = DB_que("UPDATE `#_baiviet` SET `giatien` = '".$value[2]."' WHERE `id_import_data` = '".$value[0]."' AND `id_import_data` IS NOT NULL LIMIT 1");
				if(mysql_affected_rows()){
					$j++;
					echo "<p>$i. ID ".$value[0]." thành công!</p>";
				}else{
					echo "<p class='f'>$i. ID ".$value[0]." không thành công!</p>";
				}
			}
			
			echo '<script>$(".ip_total").html("Tổng ['.count($list_row).'] - Thành công ['.$j.']")</script>';
			//cong dem
			DB_que("UPDATE `#_file_import_data` SET `import_cuoi` = '".time()."', `so_lan_import` = `so_lan_import` + 1 WHERE `id`='".$id."' LIMIT 1");
			//
		} else {
			echo SimpleXLSX::parse_error();
		}
	}else{
		echo "File không tồn tại!";
	}
?>