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

	$kota=stripslashes($_POST['kota']);
	
	$status = $_POST['status'];
	$id = $_POST['id'];
	
	
	//$kategoriNya=1;
	if($kota=="") $strError=$strError."<li> Belum mengisi kota.";
	
	if(strlen($strError) < 1)
	{
		if(!isset($status)) $status = 0;
		$sql = "update t_kota set kota = '$kota',  
			     
			     status = $status where id_kota = $id";
		
		
		
		mysql_query($sql);

	
		Header("Location: listKota.php");
		exit;
	}
}

if($act == 'del') {
	mysql_query(sprintf("delete from t_kota where id_kota = %d", $radio_detail_id));
	mysql_query("optimize table radio_alamat");


	header(sprintf("Location: editKota.php?act=edit&id=%d", $id));
	exit;
}


if($act == 'edit') {
	$r = mysql_query("select * from t_kota where id_kota = '$id'");
	$d = mysql_fetch_assoc($r);

	@extract($d);
}
?>
	<!--sisi kanan mulai-->
		<br />
		&nbsp;&nbsp;<span class="judul_menu">Edit Kota ::</span>
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
			<td align=left valign=top>Nama KOta</td><td align=left valign=top>:</td>
			<td align=left valign=top><INPUT TYPE=TEXT NAME="kota" value="<?echo $kota;?>" class="inputpesan"></td>
		</tr>
		
		<tr>
			<td align=left valign=top>Status</td><td align=left valign=top>:</td>
			<td align=left valign=top><input type="checkbox" name="status" value="1"<?=($status==1)? " checked":""?> /></td>
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


<!--		
-->
	<!--sisi kanan selesai-->
<?
include("../inc/footerAdmin.php");
?>
