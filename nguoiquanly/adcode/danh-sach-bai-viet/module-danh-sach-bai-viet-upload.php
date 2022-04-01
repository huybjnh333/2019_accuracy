<?php
    $table = '#_baiviet_img';
    $id    = isset($_GET['edit']) && is_numeric($_GET['edit']) ? SHOW_text($_GET['edit']) : 0;
    if(isset($_REQUEST['addgiatri']) AND isset($_REQUEST['maxvalu']))
	{
		for($i=0;$i<$_REQUEST['maxvalu'];$i++)
		{
			$idofme 	= $_POST["idme$i"];
			$notes 		= $_POST["note$i"];
			$del 		= isset($_POST["dele$i"]) ? $_POST["dele$i"] : 0; 
			$sort 		= $_POST["sort$i"];
			if($del)
				{
					$sql_se 	= DB_que("SELECT * FROM `$table` WHERE `id`= ".$idofme." LIMIT 1");
					$icon		= @mysql_result($sql_se,0,'p_name');
					$duongdantin= @mysql_result($sql_se,0,'duongdantin');
					@unlink("../datafiles/$duongdantin/".$icon);
					@unlink("../datafiles/$duongdantin/thumb_".$icon);
					@unlink("../datafiles/$duongdantin/thumbnew_".$icon);

					$sql = DB_que("DELETE FROM `$table` WHERE  `id`= ".$idofme." LIMIT 1");
				}
			else{
				DB_que("UPDATE `$table` SET `p_note`='$notes',`sort`='$sort' WHERE `id`= ".$idofme." LIMIT 1");	
			}
			
		}
		$_SESSION['show_message_on'] = "Cập nhật dữ liệu thành công!";
	}
	$thongtin_step = DB_fet("*","`#_step`", "`id` = '$step'","", 1, "arr");
?>
<section class="content-header">
    <h1>Danh sách hình ảnh</h1> 
    <ol class="breadcrumb">
        <li><a href="<?=$fullpath_admin ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li class="active">Quản lý bài viết</li>
    </ol>
</section>
<?php 
  $img_size   		= "";
  $img_size_text   	= "";
  if(!empty($thongtin_step[0]['size_img']) && $thongtin_step[0]['size_img'] != ''){
    $size_tinh = $thongtin_step[0]['size_img'];
    $size_tinh = explode("x", $size_tinh);
    $img_size = (int)($size_tinh[0])."x".(int)($size_tinh[1]);
    // $img_size = (int)($size_tinh[0]*2)."x".(int)($size_tinh[1]*2);
    $img_size_text = (int)($size_tinh[0])."px x".(int)($size_tinh[1]). "px";
    // $img_size_text = (int)($size_tinh[0]*2)."px x".(int)($size_tinh[1]*2). "px";

  }
?>
<form action="" method="POST" enctype="multipart/form-data" id="formUpload">
	<input type="hidden" name="kietxuatid" value='<?=$id ?>'>
	<input type="hidden" name="ajax_send_img" class="ajax_send_img" value='0'>
	<input type="hidden" name="size_img" value='<?=$img_size ?>'>
    <section class="content">
        <div class="row">
            <section class="col-lg-12">
            	<?php include _source."mesages.php"; ?>
                <div class="box">
                    <div class="box-header">
                    	<h2 class="h2_title">
			                <i class="fa fa-pencil-square-o"></i> Đăng ảnh
			            </h2>
                        <h3 class="box-title box-title-td pull-right">
                          <button type="submit" name="addgiatri" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
                          <a href="<?=$url_page?>&step=<?=$step ?>&id_step=<?=$id_step ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
                        </h3>
                    </div>
                    <div class="box-body box-body-upload-message">
                    	<div class="form-group" style=' margin-bottom: 0;'>
		                  	<label>Chọn ảnh (<?=$img_size_text ?>)</label>
		                  	<div class="clear"></div>
							<input type="file" name="img_file[]" multiple="true" onchange="previewImg(event);" id="img_file" accept="image/*">
							<div>
								<button type="submit" class="btn_danghinhanh btn-submit">Đăng ảnh</button>
								<button type="reset" class="btn_danghinhanh btn-reset">Làm mới</button>
								<div class="clear"></div>
							</div>
							<div class="clear"></div>
							<div class="output"></div>
							<div class="clear"></div>
							<div class="progress">
								<div class="progress-bar">0%</div>
							</div>
							<div class="clear"></div>
							<div class="box-preview-img"></div>
		                </div>
		                <div class="clear"></div>
		                <div class="form-group"  >
		                  	<label>Danh sách ảnh</label> <a class="cur " onclick="CHECK_all_checkbox(this)">[Chọn tất cả]</a><div class="clear"></div>
		                <!--  -->
		                <?php
	                    	$sql    = DB_que("SELECT * FROM `$table` WHERE `id_parent`='".$_REQUEST['edit']."' ORDER BY `sort` ASC");
		                      $x 	= 0;
							while($rows = mysql_fetch_assoc($sql))
							{
								$duongdantin = $rows['duongdantin'];
								$id			 = $rows['id'];
								$p_name 	 = $rows['p_name'];
								$p_note 	 = $rows['p_note'];
								$sort 		 = $rows['sort'];
						?>
							<div class='dv_uploadimg'>
								<img src='../datafiles/<?=$duongdantin?>/<?=$p_name?>'>
								<input type='hidden' name='idme<?=$x?>' value='<?=$id?>'>
								<input class="stt" 	name='sort<?=$x?>' value='<?=$sort?>' class='box_input'>
								<input class="name" name='note<?=$x?>' value="<?=$p_note?>">
								<label>
									<input name='dele<?=$x?>' value='<?=$id?>' class="minimal" type='checkbox'> Xóa
								</label>
							</div>
							<?php
								$x++;
							}
							?>
							<input type='hidden' value='<?=$x?>' name='maxvalu'>
						</div>
		                <!--  -->
                    </div>
                    <div class="box-header">
                      <h3 class="box-title box-title-td pull-right">
                          <button type="submit" name="addgiatri" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?=luu_lai ?></button>
                          <a href="<?=$url_page?>&step=<?=$step ?>&id_step=<?=$id_step ?>" class="btn btn-primary"><i class="fa fa-sign-out"></i> Thoát</a>
                      </h3>
                    </div>
                    <!--  -->
                </div>
            </section>
        </div>
    </section>
</form>
<script src="js/jquery.js"></script>
<script src="js/jquery.form.js"></script>
<script src="js/main.js"></script>

