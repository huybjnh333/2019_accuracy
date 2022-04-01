<?php
//require_once("tinypng.php");
function DANHSACH_page($val, $name, $class = '', $kieu = 0, $disabled = '')
{
    $list_step = DB_fet("*", "#_module_page", "`showhi` = 1", "`sort` ASC", "", "arr");
    if ($kieu == 0) {
        $selec = "<select $disabled id='" . $name . "' name='" . $name . "' class='" . $class . "'>";
        foreach ($list_step as $value) {
            $selec .= '<option ' . (($val == $value['id']) ? 'selected="selected"' : '') . 'value="' . $value['id'] . '">' . $value['ten_vi'] . '</option>';
        }
        $selec .= "</select>";
        return $selec;
    } else {
        return $list_step[$val]['ten_vi'];
    }
}

function LAY_chude($val, $step = 0, $name = '', $class = '', $kieu = 0, $idstep = 0, $id_ht = 0, $chude = 'true')
{
    if ($kieu == 0) {
        $chude_arr = DB_fet("*", "#_danhmuc", "`showhi` = '1' AND `step` = " . $step . "", "`catasort` ASC", "", "arr");
        $select = '<select name="' . $name . '" id="' . $name . '" class="' . $class . '">
	            						<option value="0">Chọn chủ đề con</option>';
        foreach ($chude_arr as $row_1) {
            if ($row_1['id_parent'] != 0) continue;
            $check_dis = "";
            $check_dis_trung = "";
            if ($id_ht == $row_1['id'] && $chude == 'true') $check_dis_trung = 'disabled="disabled"';
            $select .= '<option ' . $check_dis . $check_dis_trung . ' ' . (($val == $row_1['id']) ? 'selected="selected"' : '') . '  value="' . $row_1['id'] . '">' . $row_1['tenbaiviet_vi'] . '</option> ';
            foreach ($chude_arr as $row_2) {
                if ($row_2['id_parent'] != $row_1['id']) continue;
                if ($id_ht == $row_2['id'] && $check_dis_trung == '' && $chude == 'true') $check_dis1 = 'disabled="disabled"';
                else $check_dis1 = "";

                $select .= '<option ' . $check_dis . $check_dis1 . $check_dis_trung . ' ' . (($val == $row_2['id']) ? 'selected="selected"' : '') . '  value="' . $row_2['id'] . '">╚═►' . $row_2['tenbaiviet_vi'] . '</option> ';
                foreach ($chude_arr as $row_3) {
                    if ($row_3['id_parent'] != $row_2['id']) continue;
                    if ($id_ht == $row_3['id'] && $check_dis_trung == '' && $chude == 'true') $check_dis2 = 'disabled="disabled"';
                    else $check_dis2 = "";

                    $select .= '<option ' . $check_dis . $check_dis1 . $check_dis2 . $check_dis_trung . ' ' . (($val == $row_3['id']) ? 'selected="selected"' : '') . '  value="' . $row_3['id'] . '"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;╙─►' . $row_3['tenbaiviet_vi'] . '</option> ';
                    foreach ($chude_arr as $row_4) {
                        if ($row_4['id_parent'] != $row_3['id']) continue;
                        if ($chude == 'true')
                            $check_dis3 = 'disabled="disabled"';
                        else
                            $check_dis3 = '';
                        $select .= '<option ' . $check_dis . $check_dis1 . $check_dis2 . $check_dis3 . $check_dis_trung . ' ' . (($val == $row_4['id']) ? 'selected="selected"' : '') . '  value="' . $row_4['id'] . '"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;╙─►' . $row_4['tenbaiviet_vi'] . '</option> ';

                    }
                }
            }
        }
        $select .= '</select>';
        return $select;
    } else {
        $sql_cap = DB_que("SELECT `tenbaiviet_vi` FROM `#_danhmuc` WHERE `id` = " . $val . " LIMIT 1");
        return mysql_result($sql_cap, 0, 'tenbaiviet_vi');
    }
}

function LAY_menu($val, $name = '', $class = '', $kieu = 0, $id_ht = 0, $chude = 'true')
{
    if ($kieu == 0) {
        $chude_arr = DB_fet("*", "#_menu", "`showhi` = '1'", "`catasort` ASC", "", "arr");
        $select = '<select name="' . $name . '" id="' . $name . '" class="' . $class . '">
	            						<option value="0">Chọn menu con</option>';
        foreach ($chude_arr as $row_1) {
            if ($row_1['id_parent'] != 0) continue;
            $check_dis = "";
            $check_dis_trung = "";
            if ($id_ht == $row_1['id'] && $chude == 'true') $check_dis_trung = 'disabled="disabled"';
            $select .= '<option ' . $check_dis . $check_dis_trung . ' ' . (($val == $row_1['id']) ? 'selected="selected"' : '') . '  value="' . $row_1['id'] . '">' . $row_1['tenbaiviet_vi'] . '</option> ';
            foreach ($chude_arr as $row_2) {
                if ($row_2['id_parent'] != $row_1['id']) continue;
                if ($id_ht == $row_2['id'] && $check_dis_trung == '' && $chude == 'true') $check_dis1 = 'disabled="disabled"';
                else $check_dis1 = "";

                $select .= '<option ' . $check_dis . $check_dis1 . $check_dis_trung . ' ' . (($val == $row_2['id']) ? 'selected="selected"' : '') . '  value="' . $row_2['id'] . '">╚═►' . $row_2['tenbaiviet_vi'] . '</option> ';
                foreach ($chude_arr as $row_3) {
                    if ($row_3['id_parent'] != $row_2['id']) continue;
                    if ($id_ht == $row_3['id'] && $check_dis_trung == '' && $chude == 'true') $check_dis2 = 'disabled="disabled"';
                    else $check_dis2 = "";

                    $select .= '<option ' . $check_dis . $check_dis1 . $check_dis2 . $check_dis_trung . ' ' . (($val == $row_3['id']) ? 'selected="selected"' : '') . '  value="' . $row_3['id'] . '"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;╙─►' . $row_3['tenbaiviet_vi'] . '</option> ';
                    foreach ($chude_arr as $row_4) {
                        if ($row_4['id_parent'] != $row_3['id']) continue;
                        if ($chude == 'true')
                            $check_dis3 = 'disabled="disabled"';
                        else
                            $check_dis3 = '';
                        $select .= '<option ' . $check_dis . $check_dis1 . $check_dis2 . $check_dis3 . $check_dis_trung . ' ' . (($val == $row_4['id']) ? 'selected="selected"' : '') . '  value="' . $row_4['id'] . '"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;╙─►' . $row_4['tenbaiviet_vi'] . '</option> ';

                    }
                }
            }
        }
        $select .= '</select>';
        return $select;
    } else {
        $sql_cap = DB_que("SELECT `tenbaiviet_vi` FROM `#_menu` WHERE `id` = " . $val . " LIMIT 1");
        return mysql_result($sql_cap, 0, 'tenbaiviet_vi');
    }
}

function UPLOAD_image($file, $folder, $newname = '')
{
    if (isset($_FILES[$file]) && !$_FILES[$file]['error']) {
        $ext = explode('.', $_FILES[$file]['name']);
        $ext = end($ext);
        $name = basename($_FILES[$file]['name'], '.' . $ext);

        if ($_FILES[$file]['type'] == "image/jpeg" || $_FILES[$file]['type'] == "image/png" || $_FILES[$file]['type'] == "image/gif" || $_FILES[$file]['type'] == "image/x-icon" || $_FILES[$file]['type'] == "image/vnd.microsoft.icon" || $_FILES[$file]['type'] == "image/svg" || $_FILES[$file]['type'] == "image/svg+xml") {
            $_FILES[$file]['name'] = $newname . '_' . CONVERT_vn($name) . '.' . $ext;
            if (!copy($_FILES[$file]["tmp_name"], $folder . $_FILES[$file]['name'])) {
                if (!move_uploaded_file($_FILES[$file]["tmp_name"], $folder . $_FILES[$file]['name'])) {
                    return false;
                }
            }
            return $_FILES[$file]['name'];
        } else return false;
    }
    return false;
}

function UPLOAD_file($file, $folder, $newname = '', $array_typefile = array())
{

    if (isset($_FILES[$file]) && !$_FILES[$file]['error']) {
        $ext = explode('.', $_FILES[$file]['name']);
        $ext = strtolower(end($ext));
        $name = basename($_FILES[$file]['name'], '.' . $ext);
        if (in_array($ext, $array_typefile)) {
            $_FILES[$file]['name'] = $newname . '_' . CONVERT_vn($name) . '.' . $ext;
            if (!copy($_FILES[$file]["tmp_name"], $folder . $_FILES[$file]['name'])) {
                if (!move_uploaded_file($_FILES[$file]["tmp_name"], $folder . $_FILES[$file]['name'])) {
                    return false;
                }
            }
            return $_FILES[$file]['name'];
        } else return false;
    }
    return false;
}

function TAO_anhthumb($name, $newname, $new_w, $new_h, $anh = '', $by_small = true, $border = false, $transparency = true, $base64 = false)
{

    $thumb_width = $new_w;
    $thumb_height = $new_h;

    if (file_exists($newname))
        @unlink($newname);
    if (!file_exists($name))
        return false;
    $arr = explode("\.", $name);
    $ext = $arr[count($arr) - 1];
    if (preg_match('/jpeg/i', $ext)) {
        $img = @imagecreatefromjpeg($name);
    } else if (preg_match('/jpg/i', $ext)) {
        $img = @imagecreatefromjpeg($name);
    } else if (preg_match('/png/i', $ext)) {
        $img = @imagecreatefrompng($name);
    } else if (preg_match('/gif/i', $ext)) {
        $img = @imagecreatefromgif($name);
    } else if (preg_match('/bmp/i', $ext)) {
        $img = @imagecreatefrombmp($name);
    }
    if (!@$img)
        return false;

    list($original_width, $original_height, $type, $attr) = getimagesize($name);

    $thumb_ratio = $thumb_width / $thumb_height; //1.83
    $original_ratio = $original_width / $original_height; //3

    if ($thumb_ratio > $original_ratio) // Anh goc la hinh chu nhat dung
    {
        $thumb_w = round(($thumb_height * $original_width) / $original_height);
        $thumb_h = $thumb_height;
    } else if ($thumb_ratio < $original_ratio) // Anh goc la hinh chu nhat ngang
    {
        $thumb_w = $thumb_width;
        $thumb_h = round(($thumb_width * $original_height) / $original_width);
    } else {
        $thumb_w = $thumb_width;
        $thumb_h = $thumb_height;
    }


    $new_img = ImageCreateTrueColor($thumb_w, $thumb_h);
    if ($transparency) {
        if (preg_match('/png/i', $ext)) {
            imagealphablending($new_img, false);
            $colorTransparent = imagecolorallocatealpha($new_img, 0, 0, 0, 127);
            imagefill($new_img, 0, 0, $colorTransparent);
            imagesavealpha($new_img, true);
        } else if (preg_match('/gif/i', $ext)) {
            $trnprt_indx = imagecolortransparent($img);
            if ($trnprt_indx >= 0) {
                $trnprt_color = imagecolorsforindex($img, $trnprt_indx);
                $trnprt_indx = imagecolorallocate($new_img, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
                imagefill($new_img, 0, 0, $trnprt_indx);
                imagecolortransparent($new_img, $trnprt_indx);
            }
        }
    } else {
        Imagefill($new_img, 0, 0, imagecolorallocate($new_img, 255, 255, 255));
    }
    @imagecopyresampled($new_img, $img, 0, 0, 0, 0, $thumb_w, $thumb_h, $original_width, $original_height);
    if ($border) {
        $black = imagecolorallocate($new_img, 0, 0, 0);
        imagerectangle($new_img, 0, 0, $thumb_w, $thumb_h, $black);
    }
    if ($base64) {
        ob_start();
        imagepng($new_img);
        $img = ob_get_contents();
        ob_end_clean();
        $return = base64_encode($img);
    } else {
        if (preg_match('/jpeg/i', $ext)) {
            imagejpeg($new_img, $newname);
            $return = true;
        } else if (preg_match('/jpg/i', $ext)) {
            imagejpeg($new_img, $newname);
            $return = true;
        } else if (preg_match('/png/i', $ext)) {
            imagepng($new_img, $newname);
            $return = true;
        } else if (preg_match('/gif/i', $ext)) {
            imagegif($new_img, $newname);
            $return = true;
        } else if (preg_match('/bmp/i', $ext)) {
            imagejpeg($new_img, $newname);
            $return = true;
        }
    }
    imagedestroy($new_img);
    imagedestroy($img);
    if ($anh != '') {
        @watermark2($newname, $anh);
    }
    return $return;
}

function watermark2($SourceFile, $anh)
{
    $watermark_root = $SourceFile;
    $_image = $anh;

    $ext_root = strtolower(substr($watermark_root, -3));

    if ($ext_root == 'gif') $watermark = imagecreatefromgif($watermark_root);
    elseif ($ext_root == 'png') $watermark = imagecreatefrompng($watermark_root);
    elseif ($ext_root == 'jpg') $watermark = imagecreatefromjpeg($watermark_root);
    elseif ($ext_root == 'bmp') $watermark = imagecreatefrombmp($watermark_root);
    else              $watermark = imagecreatefromjpeg($watermark_root);

    $watermark_width = imagesx($watermark);
    $watermark_height = imagesy($watermark);

    $image = imagecreatetruecolor($watermark_width, $watermark_height);
    $ext = strtolower(substr($_image, -3));
    if ($ext == 'jpg') $image = @imagecreatefromjpeg($_image);
    elseif ($ext == 'gif') $image = @imagecreatefromgif($_image);
    elseif ($ext == 'png') $image = @imagecreatefrompng($_image);
    elseif ($ext == 'png') $image = @imagecreatefrombmp($_image);
    else        $image = @imagecreatefromgd($_image);
    $size = getimagesize($_image);
    $dest_x = ($size[0] - $watermark_width) / 2;
    $dest_y = ($size[1] - $watermark_height) / 2;

    @imagecopymerge($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height, 100);
    @imagejpeg($image, $SourceFile, 100);
    @imagedestroy($image);
    @imagedestroy($watermark);
}

function ACTION_db($array, $table, $kieu = 'add', $array_remove = array(), $condition = NULL)
{
    if ($kieu == 'delete') {
        $sqldel = DB_que("DELETE FROM `$table` WHERE $condition");
        return true;
    }
    $bang_db = "";
    $bang_value = "";
    $soluong = count($array);
    foreach ($array as $key => $value) {
        if ($kieu == 'add') {
            if (@in_array($key, $array_remove)) continue;
            $bang_db .= "`$key`,";
            $bang_value .= "'" . $value . "',";
        }
        if ($kieu == 'update') {
            if (@in_array($key, $array_remove)) continue;
            $bang_db .= "`$key`='" . $value . "',";
        }
    }
    $bang_db = substr($bang_db, 0, -1);
    $bang_value = substr($bang_value, 0, -1);

    if ($kieu == 'add') {
        @DB_que("INSERT INTO `$table`($bang_db) VALUES($bang_value)");
//         echo "INSERT INTO `$table`($bang_db) VALUES($bang_value)";
//        exit();
    }
    if ($kieu == 'update') {
        @DB_que("UPDATE `$table` SET $bang_db WHERE $condition");
//         echo "UPDATE `$table` SET $bang_db WHERE $condition";
    }

    return mysql_insert_id();
}

function CONVERT_vn($str)
{
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);
    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
    $str = preg_replace("/(Đ)/", 'D', $str);
    $str = preg_replace("/(đ)/", 'd', $str);
    $str = preg_replace("/( )/", '-', $str);
    $str = preg_replace("/%/", 'Phan-Tram', $str);
    $str = preg_replace("@[^A-Za-z0-9./\-_]+@i", "", $str);
    $str = preg_replace("/(--)/", '-', $str);
    $str = preg_replace("/:/", '-', $str);
    $str = str_replace("/", '-', $str);
    return strtolower(trim($str, "-"));
}

function NUMBER_fomat($val)
{
    return number_format($val, 0, '.', '.');
}

function NUMBER_fomat_vnd($val)
{
    return number_format($val, 0, '.', '.') . ' VNĐ';
}

function NUMBER_fomat_d($val)
{
    return number_format($val, 0, '.', '.') . ' đ';
}

function RANDOM_chuoi($val)
{
    $alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    $text = substr(str_shuffle($alphanum), 0, $val);
    return $text;
}

function LAY_banner($where, $loai = 0, $full_url = '')
{
    if ($loai == 0) {
        $danhsach_bn = DB_que("SELECT * FROM `#_banner` WHERE `showhi` = 1 $where ORDER BY `catasort` DESC, `id` DESC");
        return $danhsach_bn;
    } else if ($loai == 2) {
        $list_bn = array();
        $danhsach_bn = DB_que("SELECT * FROM `#_banner` WHERE `showhi` = 1 $where ORDER BY `catasort` ASC, `id` DESC");

        while ($row = mysql_fetch_assoc($danhsach_bn)) {
            $lien_ket = GET_link($full_url, SHOW_text($row['lien_ket']));
            $list_bn[] = array(
                "id" => $row['id'],
                "tenbaiviet_vi" => $row['tenbaiviet_vi'],
                "tenbaiviet_en" => $row['tenbaiviet_en'],
                "noidung_vi" => $row['noidung_vi'],
                "noidung_en" => $row['noidung_en'],
                "id_parent" => $row['id_parent'],
                "id_kietxuat" => $row['id_kietxuat'],
                "lien_ket" => $lien_ket,
                "catasort" => $row['catasort'],
                "icon" => $row['icon'],
                "ngaydang" => $row['ngaydang'],
                "showhi" => $row['showhi'],
                "duongdantin" => $row['duongdantin'],
                "p1" => $row['p1']
            );
        }
        return $list_bn;
    } else {
        $danhsach_bn = DB_que("SELECT * FROM `#_banner` WHERE `showhi` = 1 $where ORDER BY `catasort` DESC, `id` DESC LIMIT 1");
        return mysql_fetch_assoc($danhsach_bn);
    }
}

function LAYTEXT_rieng($id)
{
    $seo_name = DB_que("SELECT * FROM `#_seo_name` WHERE `id` =  $id LIMIT 1");
    $seo_name = mysql_fetch_assoc($seo_name);
    return $seo_name;
}

function ALERT_js($val)
{
    echo '<script>alert("' . $val . '")</script>';
}

function RELOAD_js()
{
    echo '<script>window.location.reload()</script>';
}

function LOCATION_js($val)
{
    echo '<script>window.location.href= "' . $val . '"</script>';
}

function CONVER_thu($val, $glo_lang)
{
    $weekday = strtolower($val);
    switch ($weekday) {
        case 'monday':
            $weekday = $glo_lang['thu_hai'];
            break;
        case 'tuesday':
            $weekday = $glo_lang['thu_ba'];
            break;
        case 'wednesday':
            $weekday = $glo_lang['thu_tu'];
            break;
        case 'thursday':
            $weekday = $glo_lang['thu_nam'];
            break;
        case 'friday':
            $weekday = $glo_lang['thu_sau'];
            break;
        case 'saturday':
            $weekday = $glo_lang['thu_bay'];
            break;
        default:
            $weekday = $glo_lang['chu_nhat'];
            break;
    }
    return $weekday;
}

function GETNAME_step($step)
{
    if ($step == 0) return "Bài viết trang đơn";
    $sql_a = DB_que("SELECT `tenbaiviet_vi` FROM `#_step` WHERE `id`='$step' LIMIT 1");
    return @mysql_result($sql_a, 0, "tenbaiviet_vi");
}

function SHOW_text($text)
{
    if ($_SESSION['sub_demo_check']) {
        $text = str_replace($_SESSION['sub_demo'], "", $text);
    }
    return stripslashes(trim($text));
}

function SHOW_input($text)
{
    $text = strip_tags($text);
    return stripslashes(mb_strtolower(htmlspecialchars(urldecode($text))));
}

function LAY_selected($val, $val_ss)
{
    if ($val == $val_ss) return 'selected="selected"';
    return "";
}


function LAY_checked($val, $val_ss)
{
    if ($val == $val_ss) return 'checked="checked"';
    return "";
}

function LAY_uutien($val_1 = '', $val_2 = '', $val_3 = '', $val_4 = '', $val_5 = '', $val_6 = '', $val_7 = '')
{
    if ($val_1 != '') return $val_1;
    if ($val_2 != '') return $val_2;
    if ($val_3 != '') return $val_3;
    if ($val_4 != '') return $val_4;
    if ($val_5 != '') return $val_5;
    if ($val_6 != '') return $val_6;
    if ($val_7 != '') return $val_7;
}

function THEM_seoname($id, $seo_name, $bang, $step, $loai = 0, $i = 0)
{
    $bang_slug = str_replace('#_', "", $bang);
    $seo_name = trim($seo_name);
    if ($seo_name == '') $seo_name = time();

    $id_slug = DB_que("SELECT `id` FROM `#_slug` WHERE  `id_bang` = '$id' AND `bang` = '" . $bang_slug . "' LIMIT 1");

    $data = array();
    $data['bang'] = $bang_slug;
    $data['id_bang'] = $id;
    $data['step'] = $step;
    $data['slug'] = $seo_name . '-' . time();
    if (mysql_num_rows($id_slug)) {
        $id_slug = mysql_result($id_slug, 0, "id");
        ACTION_db($data, "#_slug", 'update', NULL, "`id` = $id_slug");
    } else {
        $id_slug = ACTION_db($data, "#_slug", 'add', NULL);
    }

    $list_seoname = DB_fet("*", "`#_slug`", "`slug` = '" . $seo_name . "'", "`id` DESC", "", "arr");
    foreach ($list_seoname as $val) {
        if ($val['id_bang'] == $id && $val['bang'] == $bang_slug) continue;
        else {
            $seo_name = $seo_name . "-" . $id_slug;
            unset($_SESSION['show_message_on']);
            $_SESSION['show_message_off'] = "Seo Name đã tồn tại. Seo Name được thêm tự động!";
            break;
        }

    }

    $data = array();
    $data['slug'] = trim($seo_name);
    $data['step'] = $step;
    ACTION_db($data, "#_slug", 'update', NULL, "`id` = $id_slug");

    $data = array();
    $data['seo_name'] = $seo_name;
    ACTION_db($data, $bang, 'update', NULL, "`id` = $id");

}

function DANHSACH_chude_href($idactive, $table, $langone, $step)
{
    $danhmuc_arr = DB_fet("*", "$table", "`step` = '$step'", " `catasort` ASC", "", "arr");

    $box = "<select class='form-control cls_chude' onchange='SEARCH_jsstep()'>";
    $box .= "<option value='0' " . ($idactive == 0 ? "selected='selected'" : "") . ">$langone</option>";
    foreach ($danhmuc_arr as $rows) {
        if ($rows['id_parent'] != 0) continue;
        $cataname = $rows['tenbaiviet_vi'];
        $cataid = $rows['id'];
        $box .= "<option value='" . $cataid . "' " . ($cataid == $idactive ? "selected='selected'" : "") . ">$cataname</option>";
        foreach ($danhmuc_arr as $rows2) {
            if ($rows2['id_parent'] != $cataid) continue;

            $cataname2 = $rows2['tenbaiviet_vi'];
            $cataid2 = $rows2['id'];
            $box .= "<option value='" . $cataid2 . "' " . ($cataid2 == $idactive ? "selected='selected'" : "") . ">╙─►$cataname2</option>";
            foreach ($danhmuc_arr as $rows3) {
                if ($rows3['id_parent'] != $cataid2) continue;
                $cataname3 = $rows3['tenbaiviet_vi'];
                $cataid3 = $rows3['id'];
                $box .= "<option value='" . $cataid3 . "' " . ($cataid3 == $idactive ? "selected='selected'" : "") . ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;╙─►$cataname3</option>";
                foreach ($danhmuc_arr as $rows4) {
                    if ($rows4['id_parent'] != $cataid3) continue;

                    $cataname4 = $rows4['tenbaiviet_vi'];
                    $cataid4 = $rows4['id'];
                    $box .= "<option value='" . $cataid4 . "' " . ($cataid4 == $idactive ? "selected='selected'" : "") . ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;╙─►$cataname4</option>";
                }
            }
        }

    }
    $box .= "</select>";
    return $box;
}

function LAY_tieude_kietxuat($id, $table)
{
    $sql = DB_que("SELECT `tenbaiviet_vi` FROM `$table` WHERE `id`='$id' LIMIT 1");
    return @mysql_result($sql, 0, "tenbaiviet_vi");
}

function ONLINE_user($timeroff = 360, $sidd)
{
    $ipadd = @getenv(REMOTE_ADDR);
    $baygio = time();
    $sql_del = DB_que("DELETE FROM `#_online` where `timer` + $timeroff < $baygio");
    $sqltim = DB_que("SELECT `uid` FROM `#_online` WHERE `sidd` = '$sidd'");
    if (!@mysql_num_rows($sqltim)) {
        $_SESSION['web_user'] = NULL;
    }
    $sql_tim = DB_que("SELECT `uip`, `sidd` FROM `#_online` where uip='$ipadd' and sidd='$sidd'");
    $cohaykhong = mysql_fetch_assoc($sql_tim);
    if ($cohaykhong) {
        $sql_upd = DB_que("UPDATE FROM `#_online` SET `timer` = '$baygio' where `uip` = '$ipadd'");
    } else {
        $sql_them = DB_que("INSERT INTO `#_online` (`uip`, `sidd`, `timer`) values ('$ipadd','$sidd','$baygio')");
        $sql_counter = DB_que("UPDATE `#_counter` SET `coonter` = `coonter` + 1");

        $sql_timngay = DB_que("SELECT `id` FROM `#_count_date` WHERE `day` = '" . date("j") . "' AND `month` = '" . date("n") . "' AND `year` = '" . date("Y") . "'");
        $cokhong = mysql_fetch_array($sql_timngay);
        if ($cokhong) {
            $sql_ngay = DB_que("UPDATE `#_count_date` SET `count` = `count`+1, `ngaydang` = ' $baygio' WHERE `day` = '" . date("j") . "' AND `month` = '" . date("n") . "' AND `year` = '" . date("Y") . "'");
//            $sql_ngaydang = DB_que("UPDATE `#_count_date` SET `ngaydang` = ' $baygio' WHERE `day` = '" . date("j") . "' AND `month` = '" . date("n") . "' AND `year` = '" . date("Y") . "'");
        } else {
            $sql_ngay_in = DB_que("INSERT INTO `#_count_date` (day,month,year,count,ngaydang) VALUES(" . date("j") . "," . date("n") . "," . date("Y") . ",1,' $baygio ')");
        }
    }
    $sql_show = DB_que("SELECT count(*) AS tongso FROM `#_online`");
    $sho = mysql_fetch_array($sql_show);
    return $sho['tongso'];
}

function THONGKE_online()
{
    $sql = DB_que("SELECT SUM(`count`) AS `counter` FROM `#_count_date`");
    $sho = mysql_fetch_assoc($sql);
    return $sho['counter'];
}

function THONGKE_online_today()
{
    $today_start = strtotime("today 00:00:00");
    $today_end = strtotime("today 23:59:59");
    $sql = DB_que("SELECT SUM(`count`) AS `counter` FROM `#_count_date` WHERE `ngaydang` <= '" . $today_end . "' AND `ngaydang` >= '" . $today_start . "'");
    $sho = mysql_fetch_assoc($sql);
    if ($sho['counter'] == NULL) {
        return $sho['counter'] = "0";
    } else {
        return $sho['counter'];
    }
}

function THONGKE_online_weekbefore()
{
    $last_week_start = strtotime('-1 week monday 00:00:00');
    $last_week_end = strtotime('-1 week sunday 23:59:59');
    $sql = DB_que("SELECT SUM(`count`) AS `counter` FROM `#_count_date` WHERE `ngaydang` <= '" . $last_week_end . "' AND `ngaydang` >= '" . $last_week_start . "'");
    $sho = mysql_fetch_assoc($sql);
    if ($sho['counter'] == NULL) {
        return $sho['counter'] = "0";
    } else {
        return $sho['counter'];
    }
}

function THONGKE_online_monthbefore()
{
    $last_month_start = strtotime("first day of last month 00:00:00");
    $last_month_end = strtotime("last day of last month 23:59:59");
    $sql = DB_que("SELECT SUM(`count`) AS `counter` FROM `#_count_date` WHERE `ngaydang` <= '" . $last_month_end . "' AND `ngaydang` >= '" . $last_month_start . "'");
    $sho = mysql_fetch_assoc($sql);
    if ($sho['counter'] == NULL) {
        return $sho['counter'] = "0";
    } else {
        return $sho['counter'];
    }
}

function create_pass($pass, $key)
{
    return strtoupper(md5($pass . md5($key)) . sha1($key . sha1($pass)));
}

function LAYDANHSACH_idkietxuat($id, $slug_step = '')
{
    if ($slug_step != '') {
        $slug_step = " AND `step` IN ($slug_step)";
    }
    $kietxuat = DB_fet("*", "#_danhmuc", "`showhi` = 1 $slug_step ", "`catasort` ASC", "", "arr");
    $ds_id = $id . ",";
    foreach ($kietxuat as $r_1) {
        if ($r_1['id_parent'] != $id) continue;
        $ds_id .= $r_1['id'] . ",";
        foreach ($kietxuat as $r_2) {
            if ($r_2['id_parent'] != $r_1['id']) continue;
            $ds_id .= $r_2['id'] . ",";
            foreach ($kietxuat as $r_3) {
                if ($r_3['id_parent'] != $r_2['id']) continue;
                $ds_id .= $r_3['id'] . ",";
                foreach ($kietxuat as $r_4) {
                    if ($r_4['id_parent'] != $r_3['id']) continue;
                    $ds_id .= $r_4['id'] . ",";
                }
            }
        }
    }
    return trim($ds_id, ",");
}

function PHANTRANG($current, $total_row, $url, $uri = '')
{
    $url = trim($url, "/");
    if ($uri != '') {
        parse_str($uri, $get_array);
        $uri_test = "";
        foreach ($get_array as $key => $value) {
            if ($key != "page") {
                $uri_test .= "&" . $key . "=" . $value;
            }
        }
        if ($uri_test != '') {
            $url = $url . "/?" . trim($uri_test, "&") . "&page=";
        } else {
            $url = $url . "/?page=";
        }
    } else $url = $url . "/?page=";

    $div = 5;
    $row_per_page = 1;
    if (empty($current))
        $current = 1;

    $npage = floor($total_row / $row_per_page) + (($total_row % $row_per_page) ? 1 : 0);
    $nDiv = floor($npage / $div) + (($npage % $div) ? 1 : 0);
    $currentDiv = floor($current / $div);
    $count = ($npage <= ($currentDiv + 1) * $div) ? ($npage - $currentDiv * $div) : $div;
    $str_paging = '';

    if ($npage > 0) {
        $npage = intval($total_row / $row_per_page);
        if ($total_row % $row_per_page > 0)
            $npage += 1;
        if ($npage > 1) {
            if ($current != 1) {
                if (($current != 1) && ($current)) {
                    $str_paging .= ' <li class="page db_left_pt"><a class="stay" href = "' . $url . '1' . '"><i class="fa fa-angle-double-left"></i></a></li>';
                }
                if (($current - 1) > 0) {
                    $str_paging .= ' <li class="page"><a class="stay" href = "' . $url . ($current - 1) . '"><i class="fa fa-angle-left"></i></a></li>';
                }

            }

            if ($current % $div == 0) {
                $str_paging .= ' <li class="page"><a class="active pagination a" href = "' . $url . ($current) . '">' . $current . '</a></li>';
            }

            for ($i = 0; $i < $count; $i++) {
                $page = ($currentDiv * $div + $i);
                if (($page + 1) == $current)
                    $str_paging .= ' <li class="page"><a class="active pagination" href = "' . $url . ($current) . '">' . ($page + 1);
                else
                    $str_paging .= ' <li class="page"><a class="pagination" href = "' . $url . ($page + 1) . '">' . ($page + 1);
                $str_paging .= '</a></li>';
            }

            if ((@$page + 1) >= $count) {
                if (($current + 1) <= $npage) {
                    $str_paging .= '<li class="page"><a class=" stay" href = "' . $url . ($current + 1) . '"><i class="fa fa-angle-right"></i></a></li>';
                }
                if (($current != $npage) && ($npage != 0)) {
                    $str_paging .= '<li class="page db_right_pt"><a class=" stay" href = "' . $url . $npage . '"><i class="fa fa-angle-double-right"></i></a></li>';
                }
            }
        }
        return $str_paging;
    }
}

function PHANTRANG_findPages($count, $limit)
{
    $pages = (($count % $limit) == 0) ? $count / $limit : floor($count / $limit) + 1;
    return $pages;
}

function PHANTRANG_start($page, $limit)
{
    if (empty($page) || $page == "1") {
        $start = 0;
        $page = 1;
    } else {
        $start = ($page - 1) * $limit;
    }
    return $start;
}

function LAY_email($type)
{
    $list_email = '';
    $sql = DB_que("SELECT * FROM `#_email_config` WHERE `type`='" . $type . "' AND `showhi` = 1");
    while ($rim = mysql_fetch_array($sql)) {
        if (empty($list_email))
            $list_email = $rim['email'];
        else    $list_email .= ';' . $rim['email'];
    }
    return $list_email;
}

function GUI_email($to_email, $to_name, $subject, $domain, $body, $thongtin, $admin = "")
{
    if ($admin == "")
        require_once('nguoiquanly/config/class.phpmailer.php');
    else
        require_once('config/class.phpmailer.php');

    $body = @eregi_replace("[\]", '', $body);
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = $thongtin['em_ip'];
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    $mail->CharSet = "utf-8";
    $mail->Username = $thongtin['em_taikhoan'];
    $mail->Password = $thongtin['em_pass'];
    $frommail = "info@" . $domain;
    $mail->SetFrom($frommail, $domain);
    $subject = $subject . " - " . date("H:i A | d/m/Y");
    $mail->Subject = $subject;
    $mail->AltBody = $body;
    $mail->MsgHTML($body);
    $get_name = explode(";", $to_name);
    $get_email = explode(";", $to_email);
    $soluongmail = count($get_email);
    for ($in = 0; $in < $soluongmail; $in++) {
        if (!empty($get_name[$in])) {
            $get_name_in = @$get_name[$in];
        } else    $get_name_in = @$get_name[0];
        if ($in == 0) {
            if (is_email(trim($get_email[$in]))) $mail->AddAddress(trim($get_email[$in]), $get_name_in);
        } else {
            if (is_email(trim($get_email[$in]))) $mail->AddBCC(trim($get_email[$in]), $get_name_in);
        }
    }
    $mail->WordWrap = 50;
    $mail->IsHTML(true);
    if (!$mail->Send())
        return 0;
    else
        return 1;
}

function is_email($email)
{
    if (eregi("^[a-z0-9\._-]+@+[a-z0-9\._-]+\.+[a-z]{2,3}$", $email)) return TRUE;
    else return FALSE;
}

function GET_link($url, $link)
{
    if (strstr($link, "http://") != '') return $link;
    else if (strstr($link, "https://") != '') return $link;
    else {
        return $link == "" ? $url : $url . "/" . trim($link, "/") . "/";
    }
}


function layHinhCon($id)
{
    $danhsach_img = DB_que("SELECT * FROM `#_baiviet_img` WHERE `id_parent` = '" . $id . "' ORDER BY `sort` ASC, `id` ASC");
    return $danhsach_img;
}

function layIdUser($email)
{
    $sql = DB_que("SELECT `id` FROM `#_members` WHERE `showhi` = 1 AND `phanquyen` = 0 AND `email` = '" . $email . "' LIMIT 1");
    return @mysql_result($sql, 0, 'id');
}

function laySeoName($id = 'seo_name', $table, $where = '')
{
    $sql = DB_que("SELECT `$id` FROM `$table` WHERE " . $where . " LIMIT 1");
    return mysql_result($sql, 0, $id);
}

function select_one($get_field, $table, $where = '1', $limit = '1')
{
    $sql = DB_que("SELECT $get_field FROM `$table` WHERE " . $where . " LIMIT " . $limit);
    $rows = mysql_fetch_array($sql);
    return $rows;
}


function checkImage($fullpath, $icon, $duongdantin, $thumb = '')
{
    if ($icon != '')
        $link_img = $fullpath . "/" . $duongdantin . "/" . $thumb . $icon;
    else
        $link_img = $fullpath . "/nguoiquanly/images/no_image_400_312.jpg";
    return $link_img;
}

function layCatasort($table, $where = '1')
{
    $sql = DB_que("SELECT `catasort` FROM `$table` WHERE " . $where . " ORDER BY `catasort` DESC LIMIT 1");
    $catasort = @mysql_result($sql, 0, 'catasort') + 1;
    return $catasort;
}

function getTypeTitle($step)
{
    if ($step == 2 || $step == 3) $title_l = 'sản phẩm';
    else $title_l = 'bài viết';
    // $title_l = 'album ảnh';
    // $title_l = 'video';
    return $title_l;
}


function so_luong_theo_dmy($day, $month, $year)
{
    $check = DB_que("SELECT `id` FROM `#_count_date` WHERE `day` = '$day' AND `month` = '$month' AND `year` = '$year' ");
    if (mysql_num_rows($check) > 0) {
        $sql = "SELECT SUM(count) AS `so_nguoi` FROM `#_count_date` WHERE `day` = '$day' AND `month` = '$month' AND `year` = '$year' ";
        $sql_a = DB_que($sql);
        return @mysql_result($sql_a, 0, "so_nguoi");
    } else
        return 0;
}

function layEmailUser($id)
{
    $sql = DB_que("SELECT `email` FROM `#_members` WHERE `id` = '" . $id . "' LIMIT 1");
    return mysql_result($sql, 0, 'email');
}

function PHANTRANG_ajax($current, $total_row, $url, $uri = '')
{
    $url = trim($url, "/");
    if ($uri != '') {
        parse_str($uri, $get_array);
        $uri_test = "";
        foreach ($get_array as $key => $value) {
            if ($key != "page") {
                $uri_test .= "&" . $key . "=" . $value;
            }
        }
        if ($uri_test != '') {
            $url = $url . "/?" . trim($uri_test, "&") . "&page=";
        } else {
            $url = $url . "/?page=";
        }
    } else $url = $url . "/?page=";

    $div = 5;
    $row_per_page = 1;
    if (empty($current))
        $current = 1;

    $npage = floor($total_row / $row_per_page) + (($total_row % $row_per_page) ? 1 : 0);
    $nDiv = floor($npage / $div) + (($npage % $div) ? 1 : 0);
    $currentDiv = floor($current / $div);
    $count = ($npage <= ($currentDiv + 1) * $div) ? ($npage - $currentDiv * $div) : $div;
    $str_paging = '';

    if ($npage > 0) {
        $npage = intval($total_row / $row_per_page);
        if ($total_row % $row_per_page > 0)
            $npage += 1;
        if ($npage > 1) {
            if ($current != 1) {
                if (($current != 1) && ($current)) {
                    $str_paging .= ' <li class="page "><a class="stay" onclick="LOAD_trang(\'1\')"><<</a></li>';
                }
                if (($current - 1) > 0) {
                    $str_paging .= ' <li class="page"><a class="stay" onclick="LOAD_trang(\'' . ($current - 1) . '\')" ><</a></li>';
                }
            }

            if ($current % $div == 0) {
                $str_paging .= ' <li class="page"><a class="active pagination a"  onclick="LOAD_trang(\'' . ($current) . '\')" >' . $current . '</a></li>';
            }

            for ($i = 0; $i < $count; $i++) {
                $page = ($currentDiv * $div + $i);
                if (($page + 1) == $current)
                    $str_paging .= ' <li class="page"><a class="active pagination"  onclick="LOAD_trang(\'' . ($current - 1) . '\')" >' . ($page + 1);
                else
                    $str_paging .= ' <li class="page"><a class="pagination"  onclick="LOAD_trang(\'' . ($page + 1) . '\')" >' . ($page + 1);
                $str_paging .= '</a></li>';
            }

            if ((@$page + 1) >= $count) {
                if (($current + 1) <= $npage) {
                    $str_paging .= '<li class="page"><a class=" stay" onclick="LOAD_trang(\'' . ($current + 1) . '\')">></a></li>';
                }
                if (($current != $npage) && ($npage != 0)) {
                    $str_paging .= '<li class="page "><a class=" stay"  onclick="LOAD_trang(\'' . ($page) . '\')">>></a></li>';
                }
            }
        }
        return $str_paging;
    }
}

function PHANTRANG_admin($numshow, $url_page, $pz, $uri = "")
{
    if ($numshow > 1) {
        $trangxem = $url_page;
        $pmin = $pz - 1;
        $pmax = $pz + 1;
        $gioihancuanum = 5;
        if ($pz - $gioihancuanum > 0)
            $batdau = $pz - $gioihancuanum;
        else $batdau = 0;

        if ($pz + $gioihancuanum < $numshow && $batdau + 10 < $numshow)
            $ketthuc = $batdau + 10;
        else
            $ketthuc = $numshow;

        if ($pz == 0)
            echo "<li class='paginate_button previous disabled'><a> &laquo; </a></li>";
        else
            echo "<li class='paginate_button previous'><a href='$trangxem&pz=$pmin" . $uri . "'> &laquo; </a></li>";

        for ($i = $batdau; $i < $ketthuc; $i++) {
            $k = $i + 1;
            if ($i == $pz)
                echo "<li class='paginate_button active' ><a href='$trangxem&pz=$i" . $uri . "'> $k </a></li>";
            else
                echo "<li class='paginate_button' ><a href='$trangxem&pz=$i" . $uri . "'> $k </a></li>";
        }
        if ($pz >= $numshow - 1)
            echo "<li class='paginate_button next disabled'><a> &raquo; </a></li>";
        else
            echo "<li class='paginate_button next'><a href='$trangxem&pz=$pmax" . $uri . "'> &raquo; </a></li>";
    }
}

function GET_bre($id, $step, $full_url, $lang, $thongtin_step, $slug_table)
{
    $line = " | ";
    $the_bg = "";
    $the_end = "";
    $list_kietxuat = "";
    $list_kietxuat_ch = $the_bg . $line . '<a href="' . GET_link($full_url, SHOW_text($thongtin_step['seo_name'])) . '">' . SHOW_text($thongtin_step['tenbaiviet_' . $lang]) . '</a>' . $the_end;

    if ($slug_table != 'step') {
        $kietxuat = DB_fet("*", "#_danhmuc", "`showhi` = 1 AND `step` = '$step'", "`catasort` ASC", "", "arr");

        foreach ($kietxuat as $val) {
            if ($val['id'] != $id) continue;
            $list_kietxuat = $the_bg . $line . '<a href="' . GET_link($full_url, SHOW_text($val['seo_name'])) . '">' . SHOW_text($val['tenbaiviet_' . $lang]) . '</a>' . $the_end;
            foreach ($kietxuat as $val_1) {
                if ($val_1['id'] != $val['id_parent']) continue;
                $list_kietxuat = $the_bg . $line . '<a href="' . GET_link($full_url, SHOW_text($val_1['seo_name'])) . '">' . SHOW_text($val_1['tenbaiviet_' . $lang]) . '</a>' . $the_end . $list_kietxuat;
                foreach ($kietxuat as $val_2) {
                    if ($val_2['id'] != $val_1['id_parent']) continue;
                    $list_kietxuat = $the_bg . $line . '<a href="' . GET_link($full_url, SHOW_text($val_2['seo_name'])) . '">' . SHOW_text($val_2['tenbaiviet_' . $lang]) . '</a>' . $the_end . $list_kietxuat;
                    foreach ($kietxuat as $val_3) {
                        if ($val_3['id'] != $val_2['id_parent']) continue;
                        $list_kietxuat = $the_bg . $line . '<a href="' . GET_link($full_url, SHOW_text($val_3['seo_name'])) . '">' . SHOW_text($val_3['tenbaiviet_' . $lang]) . '</a>' . $the_end . $list_kietxuat;

                    }

                }

            }
        }
    }
    return $list_kietxuat_ch . $list_kietxuat;
}

function GET_ip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function SHOW_menu_left($glo_quyen, $action, $id)
{
    $action = $action != "" ? $action : $id;
    $xem = 1;
    if ($glo_quyen != 1) {
        $xem = !empty($glo_quyen[$action]['menu']) ? $glo_quyen[$action]['menu'] : 0;
    }
    if ($xem == 1) return true;
    return false;
}

function GET_danhsachquyen()
{
    $list_mang = DB_que("SELECT * FROM `#_module_nhomtaikhoan` WHERE `showhi` = 1 ORDER BY `id` ASC");
    if ($_SESSION['phanquyen'] == 1) {
        $list_array[1] = array('id' => 1, 'ten_vi' => "Administrtor");
    }

    while ($r = mysql_fetch_assoc($list_mang)) {
        $list_array[$r['id']] = array('id' => $r['id'], 'ten_vi' => $r['ten_vi']);
    }
    return $list_array;
}

function LEFT_mainmenu_new()
{
    $wh = "";
    if (!CHECK_key_setting('lien-he-nhom-con'))
        $wh = " AND `step` <> 5 ";

    $sql = DB_que("SELECT * FROM `#_step` WHERE `showhi` = 1 $wh ORDER BY `catasort` ASC ");
    $arr = array();
    while ($rows = mysql_fetch_array($sql)) {

        $id_step = $rows['step'];
        if ($id_step == 2)
            $name_s = "sản phẩm";
        else if ($id_step == 6)
            $name_s = "hình ảnh";
        else if ($id_step == 8)
            $name_s = "video";
        else if ($id_step == 9)
            $name_s = "phòng";
        else
            $name_s = "bài viết";

        $arr[] = array(
            "step" => $rows['id'],
            "id_step" => $rows['step'],
            "id" => $rows['id'],
            "cataname" => $rows['tenbaiviet_vi'],
            "name" => $name_s
        );
    }
    return $arr;
}

function CHECK_key_setting($key)
{
    $check = DB_que("SELECT `id` FROM `#_module_setting` WHERE `ten_key` = '$key' AND `is_check` = 1 LIMIT 1");
    return mysql_num_rows($check);
}


function GET_ID_youtube($url)
{
    preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $url, $matches);
    return $matches[1];
}

function COPPY_row($table, $id, $step = 0)
{
    $list_data = DB_fet("*", $table, "`id` = '$id'");
    $list_data = mysql_fetch_assoc($list_data);
    $data = array();
    $seo_name = "";
    foreach ($list_data as $key => $value) {
        if ($key == "icon") {
            $data[$key] = "";
        } else if ($key == "seo_name") {
            $value = @explode("-cp-", $value);
            $value = @$value[0];
            $seo_name = $value . '-cp-' . RAND(11111, 99999) . time();
            $data[$key] = $seo_name;
        } else if ($key == "tenbaiviet_vi") {
            $seo_name = $value;
            $data[$key] = $seo_name;
        } else if ($key == "catasort") {
            $catasort = $value + 1;
            $data[$key] = $catasort;
        } else if ($key != "id") {
            $data[$key] = $value;
        }
    }
    ACTION_db($data, $table, "add", NULL);
    if ($step) {
        $id = mysql_insert_id();
        THEM_seoname($id, $seo_name, $table, $step, "0");
    }

}

function SHOW_key($key)
{
    $$key = trim($key);
    $key = strip_tags($key);
    $key = SHOW_text($key);
    return $key;
}

function SHOW_mxh($fullpath)
{
    $mxh_arr = DB_fet("*", "#_mangxahoi", "`showhi` = 1 ", "`catasort` DESC", "", "arr");
    return $mxh_arr;
}

function DB_que($str)
{
    $str = str_replace("#_", "lh_", $str);
    // echo $str;
    return mysql_query($str);
}

function DB_fet($sql, $table, $where = "", $order_by = "", $limit = "", $arr = "", $loai = 0, $sql_return = "")
{
    if ($where != "") $where = "WHERE $where ";
    if ($order_by != "") $order_by = "ORDER BY $order_by ";
    if ($limit != "") $limit = "LIMIT $limit ";
    $str = "SELECT $sql FROM $table $where $order_by $limit";

    if ($sql_return != "") echo $str;

    $sql_que = DB_que($str);
    if ($arr == "") return $sql_que;
    else {
        $retuen_arr = array();
        while ($r = mysql_fetch_assoc($sql_que)) {
            if ($loai == 0)
                $retuen_arr[] = $r;
            else
                $retuen_arr[$r['id']] = $r;
        }
        return $retuen_arr;
    }
}

function MENU_return_link($full_url, $lang, $class_a, $tb_menu, $tb_step, $tb_danhmuc, $tb_trangdon, $id_menu)
{
    $target = $tb_menu[$id_menu]['cua_so_moi'] == 1 ? "target='_blank'" : '';
    if ($tb_menu[$id_menu]['kieu_chon'] == 0) {
        return '<a class="' . $class_a . '" href="' . GET_link($full_url, SHOW_text($tb_menu[$id_menu]['seo_name'])) . '" ' . $target . '>' . $tb_menu[$id_menu]['tenbaiviet_' . $lang] . '</a>';
    } else {
        if ($tb_menu[$id_menu]['step'] > 0) {
            if ($tb_menu[$id_menu]['danhmuc'] != 0) {
                return '<a class="' . $class_a . '" href="' . GET_link($full_url, SHOW_text($tb_danhmuc[$tb_menu[$id_menu]['danhmuc']]['seo_name'])) . '" ' . $target . '>' . SHOW_text($tb_menu[$id_menu]['tenbaiviet_' . $lang]) . '</a>';
            } else {
                return '<a class="' . $class_a . '" href="' . GET_link($full_url, SHOW_text($tb_step[$tb_menu[$id_menu]['step']]['seo_name'])) . '" ' . $target . '>' . SHOW_text($tb_menu[$id_menu]['tenbaiviet_' . $lang]) . '</a>';
            }

        } else if ($tb_menu[$id_menu]['step'] == '-1') {
            if ($tb_menu[$id_menu]['danhmuc'] != 0) {
                return '<a class="' . $class_a . '" href="' . GET_link($full_url, SHOW_text($tb_trangdon[$tb_menu[$id_menu]['danhmuc']]['seo_name'])) . '" ' . $target . '>' . SHOW_text($tb_menu[$id_menu]['tenbaiviet_' . $lang]) . '</a>';
            }
        }
    }
    if ($id_menu == 7) {
        $url = GET_link($full_url, SHOW_text($tb_menu[$id_menu]['seo_name']));
        $url = substr($url, 0, -1);
        $url = str_replace('en/', '', $url);
        return '<a class="' . $class_a . '" href="' . $url . '" ' . $target . '>' . SHOW_text($tb_menu[$id_menu]['tenbaiviet_' . $lang]) . '</a>';
    }
    return '<a class="' . $class_a . '" href="' . GET_link($full_url, SHOW_text($tb_menu[$id_menu]['seo_name'])) . '" ' . $target . '>' . SHOW_text($tb_menu[$id_menu]['tenbaiviet_' . $lang]) . '</a>';

}

function MENU_return_list_danhsach($full_url, $lang, $class_ul, $class_li, $class_a, $tb_menu, $tb_step, $tb_danhmuc, $id_menu)
{


    $step = $tb_menu[$id_menu]['step'];
    if ($step == 0) $step = -2;
    else if ($step == -1) $step = 0;
    $images = '';
    if (!empty($tb_step[$step])) {
        $images = $tb_step[$step]['duongdantin'] . '/' . $tb_step[$step]['icon'];
    }

    if ($tb_menu[$id_menu]['kieu_hien_thi'] == 2) { //show bai viet
        if ($tb_menu[$id_menu]['danhmuc'] != 0) { //lay list bv step
            $list_id = LAYDANHSACH_idkietxuat($tb_menu[$id_menu]['danhmuc'], $step);
            $tb_listbv = DB_fet("*", "#_baiviet", "`id_parent` IN (" . $list_id . ")", "`catasort` DESC, `id` DESC", "", "arr", 1);
        } else { //lay list bv danh muc
            $tb_listbv = DB_fet("*", "#_baiviet", "`step` = '$step'", "`catasort` DESC, `id` DESC", "", "arr", 1);
        }
        $return = "";
        foreach ($tb_listbv as $val) {
            $return .= '<li class="' . $class_li . '"><a class="' . $class_a . '" href="' . GET_link($full_url, SHOW_text($val['seo_name'])) . '" >' . $val['tenbaiviet_' . $lang] . '</a></li>';
        }
        return $return != "" ? "<ul class='" . $class_ul . "'>" . $return . "</ul>" : $return;

    } else if ($tb_menu[$id_menu]['kieu_hien_thi'] == 1) {
        //show list danh muc
        $list_mb_1 = "";
        foreach ($tb_danhmuc as $row_1) {
            if ($tb_menu[$id_menu]['danhmuc'] == 0 && ($row_1['id_parent'] != 0 || $row_1['step'] != $step)) continue;
            else if ($tb_menu[$id_menu]['danhmuc'] != 0 && ($row_1['step'] != $step || $tb_menu[$id_menu]['danhmuc'] != $row_1['id'])) continue;

            // cap 2
            $list_mb_2 = "";
            foreach ($tb_danhmuc as $row_2) {
                if ($row_2['id_parent'] != $row_1['id'] || $row_2['step'] != $step) continue;
                $list_mb_2 .= '<li class="' . $class_li . '"><a class="' . $class_a . '" href="' . GET_link($full_url, SHOW_text($row_2['seo_name'])) . '" >' . SHOW_text($row_2['tenbaiviet_' . $lang]) . '</a>';
                //cap 3
                $list_mb_3 = "";
                foreach ($tb_danhmuc as $row_3) {
                    if ($row_3['id_parent'] != $row_2['id'] || $row_3['step'] != $step) continue;
                    $list_mb_3 .= '<li class="' . $class_li . '"><a class="' . $class_a . '" href="' . GET_link($full_url, SHOW_text($row_3['seo_name'])) . '" >' . SHOW_text($row_3['tenbaiviet_' . $lang]) . '</a>';
                    //cap 4
                    $list_mb_4 = "";
                    foreach ($tb_danhmuc as $row_4) {
                        if ($row_4['id_parent'] != $row_3['id'] || $row_4['step'] != $step) continue;
                        $list_mb_4 .= '<li class="' . $class_li . '"><a class="' . $class_a . '" href="' . GET_link($full_url, SHOW_text($row_4['seo_name'])) . '" >' . SHOW_text($row_4['tenbaiviet_' . $lang]) . '</a></li>';
                    }
                    //end cap 4
                    if ($list_mb_4 != "") $list_mb_4 = '<ul class="' . $class_ul . '">' . $list_mb_4 . '</ul>';
                    $list_mb_3 .= $list_mb_4 . "</li>";
                }
                // end cap 3
                if ($list_mb_3 != "") $list_mb_3 = '<ul class="' . $class_ul . '">' . $list_mb_3 . '</ul>';
                $list_mb_2 .= $list_mb_3 . "</li>";
            }
            //end cap 2
            if ($list_mb_2 != "") $list_mb_2 = '<ul class="' . $class_ul . '">' . $list_mb_2 . '</ul>';

//            if ($step == 1 || $step == 5) {
//                $datadm = $tb_danhmuc[$row_1['id']];
//                $iddm = $datadm['id'];
//                $baivietdulieu = '<ul>';
//
//                $arr_running = DB_fet("*", "#_baiviet", "`showhi` = 1 AND `id_parent` = '" . $iddm . "'", "`catasort` DESC, `id` DESC", '', true);
//                foreach ($arr_running as $rowbv) {
//                    $tenbv = $rowbv['tenbaiviet_' . $lang];
//                    $seoname = $full_url . '/' . $rowbv['seo_name'];
//                    $baivietdulieu .= '<li><a href="' . $seoname . '">' . $tenbv . '</a></li>';
//                }
//                $baivietdulieu .= '</ul>';
//                $list_mb_1 .= '<li class="' . $class_li . '"><a class="' . $class_a . '" href="' . GET_link($full_url, SHOW_text($row_1['seo_name'])) . '" >' . SHOW_text($row_1['tenbaiviet_' . $lang]) . '</span></a>';
//                $list_mb_1 .= $baivietdulieu . "</li>";
//
//            } else if ($tb_menu[$id_menu]['danhmuc'] == 0 && ($step != 1 || $step != 5)) {
            $list_mb_1 .= '<li class="' . $class_li . '"><a class="' . $class_a . '" href="' . GET_link($full_url, SHOW_text($row_1['seo_name'])) . '" >' . SHOW_text($row_1['tenbaiviet_' . $lang]) . '</a>';

            $list_mb_1 .= $list_mb_2 . "</li>";
//            } else {
//                $list_mb_1 .= $list_mb_2;
//            }
        }
//        if ($step == 2 && $onl) {
//            if ($list_mb_1 != "") $list_mb_1 = '<ul class="' . $class_ul . '"><div class="projects-menu">' . $list_mb_1 . '</div></ul>';
//
//        } else {
        if ($list_mb_1 != "") $list_mb_1 = '<ul class="' . $class_ul . '">' . $list_mb_1 . '</ul>';
//        }
        return $list_mb_1;
    }
    return "";
}

function GET_menu_new($full_url, $lang, $class_ul = '', $class_li = '', $class_a = '', $onl = true)
{

    $tb_menu = DB_fet("*", "#_menu", "`showhi` = 1", "`catasort` ASC, `id` DESC", "", "arr", 1);
    $tb_step = DB_fet("*", "#_step", "`showhi` = 1", "`catasort` ASC, `id` DESC", "", "arr", 1);
    $tb_danhmuc = DB_fet("*", "#_danhmuc", "`showhi` = 1", "`catasort` ASC, `id` DESC", "", "arr", 1);
    $tb_trangdon = DB_fet("*", "#_baiviet", "`step` = 0", "`catasort` DESC, `id` DESC", "", "arr", 1);
    $list_menu = "";

    $list_mb_1 = "";
    foreach ($tb_menu as $row_0) {

        if ($row_0['id_parent'] != 0) continue;
        foreach ($tb_menu as $row_1) {
            if ($row_1['id_parent'] != $row_0['id']) continue;
            if ($onl && $row_1['id'] == 16)
                continue;
            $list_mb_1 .= '<li class="' . $class_li . ' hide_' . $row_1['step'] . '" >' . MENU_return_link($full_url, $lang, $class_a, $tb_menu, $tb_step, $tb_danhmuc, $tb_trangdon, $row_1['id']);
            // cap 2
            $list_mb_2 = "";
            foreach ($tb_menu as $row_2) {
                if ($row_2['id_parent'] != $row_1['id']) continue;
                $list_mb_2 .= '<li class="' . $class_li . '">' . MENU_return_link($full_url, $lang, $class_a, $tb_menu, $tb_step, $tb_danhmuc, $tb_trangdon, $row_2['id']);
                //cap 3
                $list_mb_3 = "";
                foreach ($tb_menu as $row_3) {
                    if ($row_3['id_parent'] != $row_2['id']) continue;
                    $list_mb_3 .= '<li class="' . $class_li . '">' . MENU_return_link($full_url, $lang, $class_a, $tb_menu, $tb_step, $tb_danhmuc, $tb_trangdon, $row_3['id']);
                    //cap 4
                    $list_mb_4 = "";
                    foreach ($tb_menu as $row_4) {
                        if ($row_4['id_parent'] != $row_3['id']) continue;
                        $list_mb_4 .= '<li class="' . $class_li . '">' . MENU_return_link($full_url, $lang, $class_a, $tb_menu, $tb_step, $tb_danhmuc, $tb_trangdon, $row_4['id']) . '</li>';
                    }
                    //end cap 4
                    if ($list_mb_4 != "") {
                        $list_mb_4 = '<ul class="' . $class_ul . '">' . $list_mb_4 . '</ul>';
                    } else {
                        //goi ham show danh muc
                        $list_mb_4 .= MENU_return_list_danhsach($full_url, $lang, $class_ul, $class_li, $class_a, $tb_menu, $tb_step, $tb_danhmuc, $row_3['id']);
                    }
                    $list_mb_3 .= $list_mb_4 . "</li>";
                }
                // end cap 3
                if ($list_mb_3 != "") {
                    $list_mb_3 = '<ul class=" ' . $class_ul . '">' . $list_mb_3 . '</ul>';
                } else {
                    //goi ham show danh muc
                    $list_mb_3 .= MENU_return_list_danhsach($full_url, $lang, $class_ul, $class_li, $class_a, $tb_menu, $tb_step, $tb_danhmuc, $row_2['id']);
                }
                $list_mb_2 .= $list_mb_3 . "</li>";
            }
            //end cap 2
            if ($list_mb_2 != "") {
                $list_mb_2 = '<ul class=" ' . $class_ul . '">' . $list_mb_2 . '</ul>';
            } else {

                //goi ham show danh muc
                $list_mb_2 .= MENU_return_list_danhsach($full_url, $lang, $class_ul, $class_li, $class_a, $tb_menu, $tb_step, $tb_danhmuc, $row_1['id'], $onl);
            }
            $list_mb_1 .= $list_mb_2 . '</li>';
        }
    }

    return $list_mb_1;
}

function GET_gia($gia, $giakm, $checkkm, $dvt = '', $lienhe = '', $class_gia = '', $class_km = '', $name_gia = '', $name_km = '')
{
    if ($checkkm == 0 || $giakm == 0) {
        $text_gia = $gia != 0 ? number_format($gia) . ' <span class="dvt">' . $dvt . '</span>' : $lienhe;
        return array("gia" => "", "km" => $text_gia, "pt" => 0, "text_gia" => $name_gia . " <span class='" . $class_gia . "'>" . $text_gia . "</span>", "text_km" => "");
    } else {
        $km = 100 - (int)($giakm * 100 / $gia);
        $text_gia = number_format($giakm) . ' <span class="dvt">' . $dvt . '</span>';
        $text_km = $gia != 0 ? $name_km . " <span class='" . $class_km . "'>" . number_format($gia) . ' <span class="dvt">' . $dvt . "</span></span>" : "";
        return array("gia" => number_format($gia) . ' <span class="dvt">' . $dvt . '</span>', "km" => $text_gia, "pt" => $km, "text_gia" => $name_gia . " <span class='" . $class_gia . "'>" . $text_gia . "</span>", "text_km" => $text_km);
    }
}

function LOC_char($val)
{
    $val = addslashes(trim($val));
    // $val = strip_tags($val);
    // $val = str_replace("<", "&lt;", $val);
    // $val = str_replace(">", "&gt;", $val);
    $val = htmlentities($val, ENT_QUOTES, "UTF-8");
    return $val;
}

function GET_token()
{
    $token = md5(date('d-m-Y', time()) . "-PA-" . GET_ip());
    return $token;
}

function CHECK_token($token)
{
    $token_check = md5(date('d-m-Y', time()) . "-PA-" . GET_ip());
    if (trim($token) == $token_check) return true;
    return false;
}

function LAY_baiviet($step, $limit = 0, $where = "")
{
    if ($limit == 0) $limit = "";
    if ($where != "") $where = " AND $where";
    $baiviet = DB_fet("*", "`#_baiviet`", "`showhi` = 1 AND `step` = '$step' $where ", "`catasort` DESC, `id` DESC", $limit, "arr", 0);
    return $baiviet;
}

function LAY_bv_tinhnang($step, $limit = 0, $where = "")
{
    if ($limit == 0) $limit = "";
    if ($where != "") $where = " AND $where";
    $baiviet = DB_fet("*", "`#_baiviet_tinhnang`", "`showhi` = 1 AND `step` = '$step' $where ", "`catasort` DESC, `id` DESC", $limit, "arr", 0);
    return $baiviet;
}

function LAY_step($id = 0, $limit = 0, $where = "")
{
    if ($where != "") $where = " AND $where";
    if ($id != 0) $where .= " AND `id` = '$id'";
    if ($limit == 0) $limit = "";

    $step = DB_fet("*", "`#_step`", "`showhi` = 1  $where ", "`catasort` ASC, `id` DESC", $limit, "arr", 0);
    return $step;
}

function LAY_danhmuc($step, $limit = 0, $where = "")
{
    if ($limit == 0) $limit = "";
    if ($where != "") $where = " AND $where";
    $danhmuc = DB_fet("*", "`#_danhmuc`", "`showhi` = 1 AND `step` = '$step' $where ", "`catasort` ASC, `id` DESC", $limit, "arr", 0);
    return $danhmuc;
}

function LAY_khuvuc($limit = 0, $where = "")
{
    if ($limit == 0) $limit = "";
    if ($where != "") $where = " AND $where";
    $danhmuc = DB_fet("*", "`#_ship_khuvuc`", "`showhi` = 1 $where ", "`catasort` ASC, `id` DESC", $limit, "arr", 2);
    return $danhmuc;
}

function LAY_hinhanhcon($id, $limit = 0)
{
    if ($limit == 0) $limit = "";
    $danhsach_img = DB_fet("  * ", " `#_baiviet_img` ", " `id_parent` = '" . $id . "' ", " `sort` ASC, `id` ASC", $limit, "arr");
    return $danhsach_img;
}

function LAY_lienket($limit = 0, $where = "")
{
    if ($limit == 0) $limit = "";
    if ($where != "") $where = " AND $where";
    $danhmuc = DB_fet("*", "`#_lien_ket_nhanh`", "`showhi` = 1  $where ", "`catasort` ASC, `id` DESC", $limit, "arr", 0);
    return $danhmuc;
}

function LAY_anhstep($step, $limit = 0)
{
    if ($limit == 0) $limit = "";
    $danhmuc = DB_fet("*", "`#_step_img`", "`id_parent` = '$step' ", "`sort` ASC, `id` DESC", $limit, "arr", 0);
    return $danhmuc;
}

function LAY_anhstep_now($step)
{
    $danhmuc = DB_que("SELECT * FROM `#_step` WHERE `id` = '$step' LIMIT 1");
    return mysql_fetch_assoc($danhmuc);
}

function LAY_anhcon($id, $limit = 0)
{
    if ($limit == 0) $limit = "";
    $danhmuc = DB_fet("*", "`#_baiviet_img`", "`id_parent` = '$id' ", "`sort` ASC, `id` DESC", $limit, "arr", 0);
    return $danhmuc;
}

function GET_tienty($gia, $tienty, $dvt)
{
    if ($gia < 1000000000) return number_format($gia) . ' ' . $dvt;
    $gia = (float)($gia / 1000000000);
    return number_format($gia) . ' ' . $tienty;
}

function RETURN_text_lienhe($name, $value)
{
    if ($value == "") return;
    return '<tr><td colspan="3" style="width:160px; font-size: 13px">' . LOC_char(base64_decode($name)) . '</td><td colspan="4" width="400"><span style="display:block; padding-left:5px; font-size: 13px">' . LOC_char($value) . '</span></td></tr>';
}

function CHECK_key_array($id, $step)
{
    $check_tn = DB_que("SELECT * FROM `#_module_setting` WHERE `id` = '$id' LIMIT 1");
    $check_tn = mysql_fetch_assoc($check_tn);
    $array_tn = explode(",", $check_tn['ten_key']);

    if (in_array($step, $array_tn)) return true;
    return false;
}

function GET_sao_sp($num_1, $num_2)
{
    $sao = 0;
    if ($num_2 != 0) $sao = round((float)($num_1 / $num_2));
    for ($i = 1; $i <= 5; $i++) {
        echo '<span class="fa fa-star ' . ($sao >= $i ? "checked" : "") . ' "></span>';
    }
}

function GET_danhmuc_hang($arr, $id_pr, $hang)
{
    if (!empty($arr[$id_pr]['tenbaiviet_' . $_SESSION['lang']]))
        return $arr[$id_pr]['tenbaiviet_' . $_SESSION['lang']];
    $hang = explode(",", $hang);
    foreach ($hang as $value) {
        if (!empty($arr[$value]['tenbaiviet_' . $_SESSION['lang']]))
            return $arr[$value]['tenbaiviet_' . $_SESSION['lang']];
    }
}

function CHECK_phut($time, $glo_lang)
{
    $time_now = time();
    $tg = $time_now - $time;

    if ($tg < 10 && $tg > 0) return $glo_lang['vua_xong'];
    else if ($tg < 60 && $tg > 0) return $tg . " " . $glo_lang['giay_truoc'];
    else if ($tg < 3600 && $tg > 0) return (int)($tg / 60) . " " . $glo_lang['phut_truoc'];
    else if ($tg < 86400 && $tg > 0) return (int)($tg / 3600) . " " . $glo_lang['gio_truoc'];
    else return date('d-m-Y', $time);
}

function bannerID($id, $fullpath)
{
    $banner_bg = DB_fet("*", "#_banner", "`showhi` = 1 AND `id` = " . $id, "", 1, 1);
    $banner_bg = reset($banner_bg);
    $bannerbg = $fullpath . '/' . $banner_bg['duongdantin'] . '/' . $banner_bg['icon'];
    return $bannerbg;

}

function getTinhnang($data, $lang, $id = '', $tags = '', $loaiid, $glo_lang)
{
    $arrdata = explode(',', $data);
    sort($arrdata);
    $arraydata = array();
    foreach ($arrdata as $row) {
        $dataparrent = DB_fet("*", "#_baiviet_tinhnang", "`showhi` = 1 AND `id` = " . $row, "", 1, 1);
        $dataparrent = reset($dataparrent);
        if (empty($arraydata[$dataparrent['id_parent']])) {
            $arraydata[$dataparrent['id_parent']] = array();
            array_push($arraydata[$dataparrent['id_parent']], $row);
            continue;
        }
        array_push($arraydata[$dataparrent['id_parent']], $row);

    }
    $strdata = "";
    $strtemp = '';
    foreach ($arraydata as $k => $v) {
        if ($k != $id && !empty($id))
            continue;
        $tinhnang = DB_fet("*", "#_baiviet_tinhnang", "`showhi` = 1 AND `id` = " . $k, "", 1, 1);
        $tinhnang = reset($tinhnang);
        if ($k == 1) {
            $strdata .= $tags . '<span>' . $tinhnang['tenbaiviet_' . $lang] . ": </span>";
        } else if ($k != $loaiid) {
            $strdata .= $tags . $tinhnang['tenbaiviet_' . $lang] . ": ";
        }
        $array_str = array();
        foreach ($v as $rowdetail) {

            $tinhnangchitiet = DB_fet("*", "#_baiviet_tinhnang", "`showhi` = 1 AND `id` = " . $rowdetail, "", 1, 1);
            $tinhnangchitiet = reset($tinhnangchitiet);
            array_push($array_str, $tinhnangchitiet['tenbaiviet_' . $lang]);
        }
        $strdata .= implode(', ', $array_str);
    }
    return $strdata . $strtemp;
}

function getdm($idbv, $lang)
{
    $dmbv = DB_fet("*", "#_danhmuc", "id =" . $idbv, "", "", 1, 1);
    $dmbv = reset($dmbv);
    return $dmbv['tenbaiviet_' . $lang];
}

function titleboxHome($step, $lang, $class = '', $class2 = '')
{
    $str = "";
    $thongtin = DB_fet("*", "#_step", "`showhi` = 1 AND `id` = " . $step, "", 1, 1);
    $thongtin = reset($thongtin);
    $tenbaiviet = $thongtin['tenbaiviet_' . $lang];
    $noidung = $thongtin['noidung_' . $lang];
    $str = '<div class="titBox titBox_2">
                <div class="tit ' . $class2 . '">' . $tenbaiviet . '</div>
                <div class="sub ' . $class . '">' . $noidung . '</div>
           </div>';
    return $str;
}

function checkFoundContent($row, $col, $lang)
{
    $data = $row[$col . $lang];
    if (empty($row[$col . $lang])) {
        $data = $row[$col . 'en'];
    }
    return $data;
}

function dataTinhNang($idtinhnang)
{
    $data = DB_fet("*", "#_baiviet_tinhnang", "`showhi` = 1 AND `id` = " . $idtinhnang, "", 1, 1);
    return reset($data);
}


//đường dẫn danh mục theo bai viet
function duongdandanhmuc($iddm)
{
    $datadm = DB_fet("*",
        "#_danhmuc",
        "`showhi` = 1 AND `id` = " . $iddm,
        "",
        1,
        1);

    $datadm = reset($datadm);
    return $datadm['seo_name'];
}

function tinhnangsp($id_parent, $listchild, $slug_step, $lang)
{
    //lấy ra những cấp con của th tính năng
    $sanpham_tinhnang = DB_fet("*",
        "#_baiviet_tinhnang",
        "`showhi` = 1 AND `step` = $slug_step AND id_parent = " . $id_parent,
        "catasort asc, id asc",
        "",
        1,
        1);
    $array_temp = array();//tạo 1 mảng tạm dùng để chứa id con vừa lấy ra đc
    foreach ($sanpham_tinhnang as $value) {
        array_push($array_temp, $value['id']);
    }
    //chứa những tên bài viết của id con
    $arraytempstr = array();
    //chuyển chuỗi thành mảng (cụ thể: tính năng)
    $arr_a = explode(',', $listchild);//tenbaiviet
    foreach ($arr_a as $value) {
        if (empty($sanpham_tinhnang[$value]))
            continue;
        array_push($arraytempstr, $sanpham_tinhnang[$value]['tenbaiviet_' . $lang]);
    }
    return implode(', ', $arraytempstr);
}

?>