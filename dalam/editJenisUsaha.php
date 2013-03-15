<?
ob_start();
session_start();
$judulHalaman="EDIT JENIS USAHA";
include("../inc/headerAdmin.php");
?>
<?

$aksi = $_POST['aksi'];
$act = $_GET['act'];
$id = $_GET['id'];



if($aksi=="1")
{
	$strError="";

	$jenis_usaha=stripslashes($_POST['jenis_usaha']);
	
	$status = $_POST['status'];
	if ($status!="1") $status = "0";
	$id = $_POST['id'];
	
	
	//$kategoriNya=1;
	if($jenis_usaha=="") $strError=$strError."<li> Belum mengisi jenis usaha.";
	
	if(strlen($strError) < 1)
	{
		if(!isset($status)) $status = 0;
		$sql = "update ".tabel_jenis_usaha." set jenis_usaha = '$jenis_usaha',  
			     
			     status = '$status' where id_ju = $id";
		
		
		
		mysql_query($sql);

	
		Header("Location: listJenisUsaha.php");
		exit;
	}
}
/*
if($act == 'del') {
	mysql_query(sprintf("delete from t_kota where id_kota = %d", $radio_detail_id));
	mysql_query("optimize table radio_alamat");


	header(sprintf("Location: editJenisUsaha.php?act=edit&id=%d", $id));
	exit;
}
*/

if($act == 'edit') {
	$r = mysql_query("select * from ".tabel_jenis_usaha." where id_ju = '$id'");
	$d = mysql_fetch_assoc($r);

	@extract($d);
	$id = $id_ju;
}
?>
	<!--sisi kanan mulai-->
		<br />
		&nbsp;&nbsp;<span class="judul_menu">Edit Jenis Usaha ::</span>
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
			<td align=left valign=top>Status</td><td align=left valign=top>:</td>
			<td align=left valign=top><input type="checkbox" name="status" value="1"<?=($status==1)? " checked":""?> /></td>
		</tr>
		
		<tr>
		<td><br />&nbsp;</td>
		<td><br />&nbsp;</td><INPUT TYPE=hidden NAME="aksi" Value="1">
		<INPUT TYPE=hidden NAME="id" Value="<? echo $id;?>">
		<td valign=top><br /><INPUT TYPE=SUBMIT Value="Kirim Data" class="tombol"></td>
		</tr>
		</table>
		</form>


<!--		
-->
	<!--sisi kanan selesai-->
<?
include("../inc/footerAdmin.php");
?>
