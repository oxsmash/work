<?
ob_start();
session_start();
$judulHalaman="TAMBAH RADIO";
include("../inc/headerAdmin.php");
?>
<?

$aksi = $_POST['aksi'];
$act = $_GET['act'];
$id = $_GET['id'];

if($aksi=="1")
{
	$strError="";

	$nama=stripslashes($_POST['nama']);
	$ket_singkat=stripslashes($_POST['ket_singkat']);
	$keterangan=stripslashes($_POST['keterangan']);
	$status = $_POST['status'];
	$flag_24jam0 = $_POST['flag_24jam0'];
	$flag_24jam1 = $_POST['flag_24jam1'];
	$flag_24jam2 = $_POST['flag_24jam2'];
	$flag_24jam3 = $_POST['flag_24jam3'];
	$flag_24jam4 = $_POST['flag_24jam4'];
	$flag_24jam5 = $_POST['flag_24jam5'];
	$flag_24jam6 = $_POST['flag_24jam6'];
	$status_tambahan = (int) $_POST['status_tambahan'];
	$shoutcast = $_POST['shoutcast'];
	$stereo = $_POST['stereo'];
	$mount = $_POST['mount'];
	$kota = $_POST['slkota'];
	$id = $_POST['id'];	
	$ym_id=stripslashes($_POST['ym_id']);
	$url_fb=stripslashes($_POST['url_fb']);
	$url_twitter=stripslashes($_POST['url_twitter']);

	//$kategoriNya=1;
	if($nama=="") $strError=$strError."<li> Belum mengisi nama radio.";
	if($kota=="") $strError=$strError."<li> Belum mengisi kota.";
	if(is_uploaded_file($_FILES['logo']['tmp_name'])) {
		list($panjang, $lebar, $jenis, ) = getimagesize($_FILES['logo']['tmp_name']);
		
		if($jenis != 2) $strError=$strError."<li> Logo harus JPEG.";
		if($panjang != 160) $strError=$strError."<li> Lebar logo harus 160 pixels.";
		if($lebar != 80) $strError=$strError."<li> Tinggi logo harus 80 pixels.";
	}
	
	if(strlen($mount) < 1) $strError=$strError."<li> Belum mengisi nama Icecast Mount.";

	if(strlen($strError) < 1)
	{
		if(!isset($shoutcast)) $shoutcast = 0;
		if(!isset($status)) $status = 0;
		if(!isset($flag_24jam0)) $flag_24jam0 = 0;
		if(!isset($flag_24jam1)) $flag_24jam1 = 0;
		if(!isset($flag_24jam2)) $flag_24jam2 = 0;
		if(!isset($flag_24jam3)) $flag_24jam3 = 0;
		if(!isset($flag_24jam4)) $flag_24jam4 = 0;
		if(!isset($flag_24jam5)) $flag_24jam5 = 0;
		if(!isset($flag_24jam6)) $flag_24jam6 = 0;
		if(!isset($stereo)) $stereo = 0;
		
		$sql = "update radio set nama = '$nama',
			     ket_singkat='".addslashes(strip_tags($ket_singkat))."',
			     keterangan='".addslashes($keterangan)."',
					 mount = '$mount',
					 shoutcast = '$shoutcast',
					 stereo = '$stereo',
			     status = $status,
				 flag_24jam0 = '$flag_24jam0',
				 flag_24jam1 = '$flag_24jam1',
				 flag_24jam2 = '$flag_24jam2',
				 flag_24jam3 = '$flag_24jam3',
				 flag_24jam4 = '$flag_24jam4',
				 flag_24jam5 = '$flag_24jam5',
				 flag_24jam6 = '$flag_24jam6',
				 status_tambahan = '$status_tambahan',
				id_kota = $kota,
				ym_id = '$ym_id',
				url_fb = '$url_fb',
				url_twitter = '$url_twitter'
				 where radio_id = $id
				  ";
		
		//echo $sql;
		
		mysql_query($sql);

		if(is_uploaded_file($_FILES['logo']['tmp_name'])) {
			if(is_file("../images/logo/$radio_id.jpg")) unlink("../images/logo/$id.jpg");
			if(is_file("../images/logo_thumbs/$radio_id.jpg")) unlink("../images/logo_thumbs/$id.jpg");
			resizeImage($_FILES['logo']['tmp_name'], "../images/logo_thumbs", $id, 158, 77);
			move_uploaded_file($_FILES['logo']['tmp_name'], "../images/logo/$id.jpg");
		}

		Header("Location: listRadio.php");
		exit;
	}
}

if($act == 'del') {
	mysql_query(sprintf("delete from radio_alamat where radio_alamat_id = %d", $radio_detail_id));
	mysql_query("optimize table radio_alamat");


	header(sprintf("Location: editRadio.php?act=edit&id=%d", $id));
	exit;
}


if($act == 'edit') {
	$r = mysql_query("select * from radio where radio_id = '$id'");
	$d = mysql_fetch_assoc($r);
	
	//print_r($d);
	@extract($d);
}
?>
	<!--sisi kanan mulai-->
		<br />
		&nbsp;&nbsp;<span class="judul_menu">Edit Radio ::</span>
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
			<td valign=top><textarea name="ket_singkat" rows="4" cols="30" class="inputPesan"><?echo $ket_singkat;?></textarea></td>
		</tr>
		<tr>
			<td valign=top><b><i>Keterangan</i></b></td>
			<td valign=top>:</td>
			<td valign=top>
			<?php
			// include the config file and editor class:
			include_once ('../editor_files/config.php');
			include_once ('../editor_files/editor_class.php');
			// create a new instance of the wysiwygPro class:
			$editor = new wysiwygPro();
			// set_name
			$editor->set_name('keterangan');
			$editor->set_stylesheet('../inc/style.css');
			// insert some HTML
			$editor->set_code($keterangan);
			//$editor->removebuttons('print,bookmark,format');
			// print the editor to the browser:
			$editor->print_editor(540, 300);
			?>
			</td>
		</tr>
		<tr>
			<td align=left valign=top>Logo</td><td align=left valign=top>:</td>
			<td align=left valign=top>
				<?
				if(is_file("../images/logo/$id.jpg")) echo '<img src="../images/logo/'.$id.'.jpg" width="100px"/><br />';
				?>
				<input type="file" name="logo" class="inputpesan" /> <br />
				Nb. ukuran Logo harus 160 x 80 pixels
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
							
							if($id_kota == $row['id_kota']) {
								$temp = "selected";
								
							}else {
								$temp ="";
							}
							
							echo "<option value='".$row['id_kota']."' ".$temp.">".$row['kota']."</option>";
							
						}
					?>
					
				</select>
			</td>
		</tr>
		<tr>
			<td align=left valign=top>Icecast Mount Name</td><td align=left valign=top>:</td>
			<td align=left valign=top><INPUT TYPE=TEXT NAME="mount" value="<?echo $mount;?>" class="inputpesan"></td>
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
			<td align=left valign=top>Status</td><td align=left valign=top>:</td>
			<td align=left valign=top><input type="checkbox" name="status" value="1"<?=($status==1)? " checked":""?> /></td>
		</tr>
		<tr>
			<td align=left valign=top>Status tambahan</td><td align=left valign=top>:</td>
			<td align=left valign=top>
				<input type="radio" name="status_tambahan" value="0" <?=$status_tambahan==0?"checked='checked'":""?> /> tidak ada<br/>
				<input type="radio" name="status_tambahan" value="1" <?=$status_tambahan==1?"checked='checked'":""?> /> maintenance
			</td>
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
		<INPUT TYPE=hidden NAME="id" Value="<? echo $id;?>">
		</form>


<!--		<br /><br />
		<strong>Daftar Icecast Mount Name <?=$nama?></strong><br /><br />
		<?
		$r = mysql_query("select count(radio_alamat_id) as jml from radio_alamat where radio_id = '$id'");
		$d = mysql_fetch_assoc($r);
		if($d['jml'] < 2) {
		?>
		+<a href="addAlamatRadio.php?radio_id=<?=$id?>">Tambah Icecast Mount</a>+<br />
		<?
		}
		?>
		<table border="0" cellspacing="1" cellpadding="3" width="100%" bgcolor="#BBBABA">
		<tr bgcolor="#BBBABA">
			 <td valign="top" align="center"><b>No</b></td>
			 <td valign="top" align="center"><b>Alamat</b></td>
			 <td valign="top" align="center"><b>Hapus</b></td>
		</tr>
		<?
		$result = mysql_query("select * from radio_alamat where radio_id = '$radio_id' order by radio_alamat_id asc");
		$k=0;
		$z=0;
		while($rs = mysql_fetch_array($result)) {
		$k=$k+1;
		$z=$k+(($PageNo - 1)*$PageSize);
		$bID = $rs['radio_alamat_id'];
		$bJudul = $rs['url'];
		?>
		<tr bgcolor="#ebebeb" onMouseOver="this.style.background='#ffffff'" onMouseOut="this.style.background='#ebebeb'">
			 <td valign="middle" align="center"><?echo $z;?>.</td>
			 <td valign="middle"><a href="editAlamatRadio.php?act=edit&radio_id=<?=$id?>&radio_alamat_id=<?echo $bID?>"><?echo $bJudul;?></a></td>
			 <td valign="top" align="center"><a href="editRadio.php?act=del&radio_detail_id=<?=$bID?>&id=<?=$id?>" onclick="return confirm('Apakah akan menghapus alamat ini?')"><img src="../images/del.gif" alt="" border="0" /></a></td>
		</tr>
		<?
		}
		?>
		</table>
-->
	<!--sisi kanan selesai-->
<?
include("../inc/footerAdmin.php");
?>
