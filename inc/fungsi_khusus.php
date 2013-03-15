<?php
Function namaPetisi($intID)
	{	
	$sql = "select * from ".tabel_petisi." WHERE petisi_id='".$intID."'";
	$res = mysql_query($sql);
	$arr_data=array();
	while($rs = mysql_fetch_array($res)) {		
		$arr_data["judul"]=$rs[judul_petisi];
		$arr_data["isi"]=$rs[isi_petisi];
		$arr_data["boleh"]=$rs[boleh_petisi];
		$arr_data["tanggal"]=$rs[tgl_petisi];
		}
	return $arr_data;
	}
	
Function jumlahSign($intID)
	{	
	$sql = "select * from ".tabel_sign." WHERE status_sign=1 and petisi_id='".$intID."' order by sign_id ASC";
	$res = mysql_query($sql);
	$arr_data=array();
	$jumlah=0;
	while($rs = mysql_fetch_array($res)) {		
		$jumlah=$jumlah+1;
		$arr_data["nama"]=$rs[nama_sign];
		$arr_data["alamat"]=$rs[alamat_sign];
		$arr_data["tanggal"]=$rs[tgl_sign];		
		}
	$arr_data["jumlah"]=$jumlah;
	return $arr_data;
	}

function jumlahFoto($argID)
	{
	$jumlahFoto=0;
	$mySql="SELECT count(*) as jumlahFoto FROM ".tabel_photo." WHERE user_id='" .$argID."'";
	$res_mySQL=mysql_query($mySql) or die(mysql_error());
	while($rs_mySql=mysql_fetch_array($res_mySQL)){
		$jumlahFoto=$rs_mySql[jumlahFoto];
		}
	return $jumlahFoto;
	}
	
function showPhoto($argID)
	{
	$mySql="SELECT * FROM ".tabel_photo." WHERE photo_id='".$argID."'";
	$res_mySQL=mysql_query($mySql) or die(mysql_error());
	while($rs_mySql=mysql_fetch_array($res_mySQL)){
		$jmlShow=$rs_mySql[lihat_photo];
		}
	$mySqlU="Update ".tabel_photo." set lihat_photo='".($jmlShow+1)."' WHERE photo_id='".$argID."'";
	mysql_query($mySqlU) or die(mysql_error());
	}
	
function resizeImage($source, $des_dir, $img_name, $des_width, $des_height) {
	require_once("usm.php");
	if (!is_dir($des_dir)) {
		mkdir($des_dir);
	}
	
	$dest = $des_dir."/$img_name.jpg";

	$size = getimagesize($source);

	$llama = $size[0];

	$tlama = $size[1];

	if($tlama > $des_height) $resize = true;
	if($llama > $des_width) $resize = true;

	if ($resize) {
		if ($llama > $tlama) {
			$width = $des_width;
			$height = round($des_width / $llama * $tlama);
		} else {
			$height = $des_height;
			$width = round($des_height / $tlama * $llama);
		}
	}else{
		$width = $llama;
		$height = $tlama;
	}

	$new_im = ImageCreatetruecolor($width, $height);

	$im = imagecreatefromjpeg($source);

	imagecopyresampled($new_im,$im,0,0,0,0,$width,$height,imagesx($im),imagesy($im));

	UnsharpMask($new_im, 50, 1, 0);

	imagejpeg($new_im, $dest, 100);

}
?>