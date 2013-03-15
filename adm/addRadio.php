<?
ob_start();
session_start();
$judulHalaman="TAMBAH RADIO";
include("../inc/headerAdmin.php");
?>
<?

$aksi = $_POST['aksi'];

if($aksi=="1")
{
	$strError="";
	$nama=stripslashes($_POST['nama']);
	$cket1=stripslashes($_POST['cket1']);
	$pIsi=stripslashes($_POST['pIsi']);
	$url = $_POST['url'];
	$kota = $_POST['slkota'];
	$shoutcast = $_POST['shoutcast'];
	$stereo = $_POST['stereo'];	
	$flag_24jam0 = $_POST['flag_24jam0'];
	$flag_24jam1 = $_POST['flag_24jam1'];
	$flag_24jam2 = $_POST['flag_24jam2'];
	$flag_24jam3 = $_POST['flag_24jam3'];
	$flag_24jam4 = $_POST['flag_24jam4'];
	$flag_24jam5 = $_POST['flag_24jam5'];
	$flag_24jam6 = $_POST['flag_24jam6'];
	$ym_id=stripslashes($_POST['ym_id']);
	$url_fb=stripslashes($_POST['url_fb']);
	$url_twitter=stripslashes($_POST['url_twitter']);

	//$kategoriNya=1;
	if($nama=="") $strError=$strError."<li> Belum mengisi nama radio.";
	if($kota=="") $strError=$strError."<li> Belum mengisi kota.";
	if(is_uploaded_file($_FILES['logo']['tmp_name'])) {
		list($panjang, $lebar, $jenis, ) = getimagesize($_FILES['logo']['tmp_name']);

		if($jenis != 2) $strError=$strError."<li> Logo harus JPEG.";
	if($panjang != 1600) $strError=$strError."<li> Lebar logo harus 108 pixels.";
		if($lebar != 627) $strError=$strError."<li> Tinggi logo harus 54 pixels.";
	}
	
	if(strlen($url) < 1) $strError=$strError."<li> Belum mengisi nama Icecast Mount.";
	
//	if(strlen($url_jkt) < 1 and strlen($url_ygy) < 1) $strError=$strError."<li> Belum mengisi nama Icecast Mount.";
	
	if(strlen($strError) < 1)
	{
		if(!isset($shoutcast)) $shoutcast = 0;
		if(!isset($stereo)) $stereo = 0;
		if(!isset($flag_24jam0)) $flag_24jam0 = 0;
		if(!isset($flag_24jam1)) $flag_24jam1 = 0;
		if(!isset($flag_24jam2)) $flag_24jam2 = 0;
		if(!isset($flag_24jam3)) $flag_24jam3 = 0;
		if(!isset($flag_24jam4)) $flag_24jam4 = 0;
		if(!isset($flag_24jam5)) $flag_24jam5 = 0;
		if(!isset($flag_24jam6)) $flag_24jam6 = 0;
		
		$cmd = "insert into radio(nama,ket_singkat,keterangan, mount, status,id_kota,shoutcast,stereo,ym_id,url_fb,url_twitter,flag_24jam0,flag_24jam1,flag_24jam2,flag_24jam3,flag_24jam4,flag_24jam5,flag_24jam6)
			values('$nama','".addslashes(strip_tags($cket1))."','".addslashes($pIsi)."', '$url','1','".$kota."','".$shoutcast."','".$stereo."','".$ym_id."','".$url_fb."','".$url_twitter."','".$flag_24jam0."','".$flag_24jam1."','".$flag_24jam2."','".$flag_24jam3."','".$flag_24jam4."','".$flag_24jam5."','".$flag_24jam6."')";
		
		//echo $cmd;
		
		mysql_query($cmd) or die(mysql_error());
		$radio_id = mysql_insert_id();
		
//		if(strlen($url_jkt) > 0) 
//			mysql_query("insert into radio_alamat (radio_id, url, lokasi) values($radio_id, '$url_jkt', 'jkt')") or die(mysql_error());
//		
//		if(strlen($url_ygy) > 0) 
//			mysql_query("insert into radio_alamat (radio_id, url, lokasi) values($radio_id, '$url_ygy', 'ygy')") or die(mysql_error());
		

		if(is_uploaded_file($_FILES['logo']['tmp_name'])) {			
			resizeImage($_FILES['logo']['tmp_name'], "../images/logo_thumbs", $id, 158, 77);
			move_uploaded_file($_FILES['logo']['tmp_name'], "../images/logo/$radio_id.jpg");
		}

		Header("Location: listRadio.php");
		exit;
	}
}
?>
	<!--sisi kanan mulai-->
		<br />
		&nbsp;&nbsp;<span class="judul_menu">Tambah Radio ::</span>
		<br />
		<br />
		<?php
		if (strlen($strError) > 0)
			{
			echo kotakError($strError);
			echo '<br /><br />';
			}
		?>
		<form onSubmit="submit_form()" name="tBisnis" method="post" action="<?echo $PHP_SELF;?>" enctype="multipart/form-data">
		<table border="0" cellpadding="3" cellspacing="0">
		<tr>
			<td align=left valign=top>Nama Radio</td><td align=left valign=top>:</td>
			<td align=left valign=top><INPUT TYPE=TEXT NAME="nama" value="<?echo $nama;?>" class="inputpesan"></td>
		</tr>
		<tr>
			<td valign=top>Keterangan singkat</td>
			<td valign=top>:</td>
			<td valign=top><textarea name="cket1" rows="4" cols="30" class="inputPesan"><?echo $cket1;?></textarea></td>
		</tr>
		<tr>
			<td valign=top>Keterangan</td>
			<td valign=top>:</td>
			<td valign=top>
			<?php
			// include the config file and editor class:
			include_once ('../editor_files/config.php');
			include_once ('../editor_files/editor_class.php');
			// create a new instance of the wysiwygPro class:
			$editor = new wysiwygPro();
			// set_name
			$editor->set_name('pIsi');
			$editor->set_stylesheet('../inc/style.css');
			// insert some HTML
			$editor->set_code($pIsi);
			$editor->removebuttons('print,bookmark,format');
			// print the editor to the browser:
			$editor->print_editor(540, 300);
			?>
			</td>
		</tr>
		<tr>
			<td align=left valign=top>Logo</td><td align=left valign=top>:</td>
			<td align=left valign=top>
				<input type="file" name="logo" class="inputpesan" /> <br />
				Nb. ukuran Logo harus 108 x 54 pixels
			</td>
		</tr>
		<tr>
			<td align=left valign=top>Kota</td><td align=left valign=top>:</td>
			<td align=left valign=top>
				<select name="slkota" class="inputpesan">
					<option value="">Plih Kota</option>
					<?php
						$sqlKota = "SELECT	* FROM t_kota WHERE status = '1' ";
						
						$q = mysql_query($sqlKota) or die();
						
						while($row = mysql_fetch_array($q)) {
							
							echo "<option value='".$row['id_kota']."'>".$row['kota']."</option>";
							
						}
					?>
					
				</select>
			</td>
		</tr>
		<tr>
			<td align=left valign=top>Icecast Mount Name</td><td align=left valign=top>:</td>
			<td align=left valign=top><INPUT TYPE=TEXT NAME="url" value="<?echo $url_jkt;?>" class="inputpesan"></td>
		</tr>
		<tr>
			<td align=left valign=top>Shoutcast?</td><td align=left valign=top>:</td>
			<td align=left valign=top><input type="checkbox" name="shoutcast" value="1"<?=($shoutcast==1)? " checked":""?> /> Jika shoutcast maka otomatis stereo, input stereo dibawah tidak berpengaruh</td>
		</tr>
		<tr>
			<td align=left valign=top>Mendukung stereo?</td><td align=left valign=top>:</td>
			<td align=left valign=top><input type="checkbox" name="stereo" value="1"<?=($stereo==1)? " checked":""?> /></td>
		</tr>
		<tr>
			<td align=left valign=top>24 Jam?</td><td align=left valign=top>:</td>
			<td align=left valign=top>
				<input type="checkbox" name="flag_24jam0" value="1"<?=($flag_24jam0==1)? " checked":""?> /> Minggu<br/>
				<input type="checkbox" name="flag_24jam1" value="1"<?=($flag_24jam1==1)? " checked":""?> /> Senin<br/>
				<input type="checkbox" name="flag_24jam2" value="1"<?=($flag_24jam2==1)? " checked":""?> /> Selasa<br/>
				<input type="checkbox" name="flag_24jam3" value="1"<?=($flag_24jam3==1)? " checked":""?> /> Rabu<br/>
				<input type="checkbox" name="flag_24jam4" value="1"<?=($flag_24jam4==1)? " checked":""?> /> Kamis<br/>
				<input type="checkbox" name="flag_24jam5" value="1"<?=($flag_24jam5==1)? " checked":""?> /> Jum'at<br/>
				<input type="checkbox" name="flag_24jam6" value="1"<?=($flag_24jam6==1)? " checked":""?> /> Sabtu<br/>
			</td>
		</tr>
		<tr>
			<td align=left valign=top>YM ID</td><td align=left valign=top>:</td>
			<td align=left valign=top><INPUT size="50" TYPE=TEXT NAME="ym_id" value="<?echo $ym_id;?>" class="inputpesan"></td>
		</tr>
		<tr>
			<td align=left valign=top>Facebook</td><td align=left valign=top>:</td>
			<td align=left valign=top><INPUT size="50" TYPE=TEXT NAME="url_fb" value="<?echo $url_fb;?>" class="inputpesan"></td>
		</tr>
		<tr>
			<td align=left valign=top>Twitter</td><td align=left valign=top>:</td>
			<td align=left valign=top><INPUT size="50" TYPE=TEXT NAME="url_twitter" value="<?echo $url_twitter;?>" class="inputpesan"></td>
		</tr>
		<tr>
		<td><br />&nbsp;</td>
		<td><br />&nbsp;</td><INPUT TYPE=hidden NAME="aksi" Value="1">
		<INPUT TYPE=hidden NAME="idE" Value="<? echo $idE;?>">
		<td valign=top><br /><INPUT TYPE=SUBMIT Value="Kirim Data" class="tombol"></FORM></td>
		</tr>
		</table>
		</form>
	<!--sisi kanan selesai-->
<?
include("../inc/footerAdmin.php");
?>
