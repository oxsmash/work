<?
ob_start();
session_start();
$judulHalaman="TAMBAH SERVER";
include("../inc/headerAdmin.php");
?>
<?

$aksi = $_POST['aksi'];

if($aksi=="1")
{
	$strError="";
	//$url=stripslashes($_POST['url']);
	$area=stripslashes($_POST['area']);
	
	$url = $_POST['url'];

	//$kategoriNya=1;
	if($area=="") $strError=$strError."<li> Belum mengisi area.";
	if($url=="") $strError=$strError."<li> Belum mengisi url.";
	
	
	if(strlen($strError) < 1){
		
		$cmd = "insert into tb_url(area, url)
			values('$area','$url')";
		
		//echo $cmd;
		
		mysql_query($cmd) or die(mysql_error());
		$id = mysql_insert_id();
		
//		if(strlen($url_jkt) > 0) 
//			mysql_query("insert into radio_alamat (radio_id, url, lokasi) values($radio_id, '$url_jkt', 'jkt')") or die(mysql_error());
//		
//		if(strlen($url_ygy) > 0) 
//			mysql_query("insert into radio_alamat (radio_id, url, lokasi) values($radio_id, '$url_ygy', 'ygy')") or die(mysql_error());
		

		

		Header("Location: listServer.php");
		exit;
	}
}
?>
	<!--sisi kanan mulai-->
		<br />
		&nbsp;&nbsp;<span class="judul_menu">Tambah Server ::</span>
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
			<td align=left valign=top>Nama Area</td><td align=left valign=top>:</td>
			<td align=left valign=top><INPUT TYPE=TEXT NAME="area" value="<?echo $area;?>" class="inputpesan"></td>
		</tr>
		<tr>
			<td align=left valign=top>Url</td><td align=left valign=top>:</td>
			<td align=left valign=top><INPUT TYPE=TEXT NAME="url" value="<?echo $url;?>" class="inputpesan" size="50"></td>
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
