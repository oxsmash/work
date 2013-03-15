<?
ob_start();
session_start();
$judulHalaman="TAMBAH JENIS USAHA";
include("../inc/headerAdmin.php");
?>
<?

$aksi = $_POST['aksi'];

if($aksi=="1")
{
	$strError="";
	$jenis_usaha=stripslashes($_POST['jenis_usaha']);
	
	$url = $_POST['url'];

	//$kategoriNya=1;
	if($jenis_usaha=="") $strError=$strError."<li> Belum mengisi jenis usaha.";
	
	
	if(strlen($strError) < 1){
		
		$cmd = "insert into ".tabel_jenis_usaha."(jenis_usaha, status)
			values('$jenis_usaha','1')";
		
		//echo $cmd;
		
		mysql_query($cmd) or die(mysql_error());
//		$radio_id = mysql_insert_id();
		
//		if(strlen($url_jkt) > 0) 
//			mysql_query("insert into radio_alamat (radio_id, url, lokasi) values($radio_id, '$url_jkt', 'jkt')") or die(mysql_error());
//		
//		if(strlen($url_ygy) > 0) 
//			mysql_query("insert into radio_alamat (radio_id, url, lokasi) values($radio_id, '$url_ygy', 'ygy')") or die(mysql_error());
		

		

		Header("Location: listJenisUsaha.php");
		exit;
	}
}
?>
	<!--sisi kanan mulai-->
		<br />
		&nbsp;&nbsp;<span class="judul_menu">Tambah Jenis Usaha ::</span>
		<br />
		<br />
		<?php
		if (strlen($strError) > 0)
			{
			echo kotakError($strError);
			echo '<br /><br />';
			}
		?>
		<form onSubmit="submit_form()" name="tBisnis" method="post" action="<?echo $PHP_SELF;?>">
		<table border="0" cellpadding="3" cellspacing="0">
		<tr>
			<td align=left valign=top>Nama Jenis Usaha</td><td align=left valign=top>:</td>
			<td align=left valign=top><INPUT TYPE=TEXT NAME="jenis_usaha" value="<?echo $jenis_usaha;?>" class="inputpesan"></td>
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
