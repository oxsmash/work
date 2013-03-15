<?
ob_start();
session_start();
$judulHalaman="TAMBAH RADIO";
include("../inc/headerAdmin.php");
?>
<?
if($aksi=="1")
{	
	$strError="";
	$url=stripslashes($url);
	
	//$kategoriNya=1;
	if($url=="") $strError=$strError."<li> Belum mengisi url radio.";
	
	if(strlen($strError) < 1)
	{
		mysql_query("update radio_alamat set url = '$url' where radio_alamat_id = '$radio_alamat_id'");
		
		Header("Location: editRadio.php?act=edit&id=$radio_id");
		exit;
	}
}

if($act == 'edit') {	
	$r = mysql_query(sprintf("select url from radio_alamat where radio_alamat_id = '%d'", $radio_alamat_id));
	$d = mysql_fetch_assoc($r);
	
	@extract($d);
}
?>
	<!--sisi kanan mulai-->
		<br />
		<?
		$r = mysql_query("select nama from radio where radio_id = '$radio_id'");
		$d = mysql_fetch_assoc($r);
		?>
		&nbsp;&nbsp;<span class="judul_menu">Edit Alamat Radio <?=ucwords(strtolower($d['nama']))?> ::</span>
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
			<td align=left valign=top>Url</td><td align=left valign=top>:</td>
			<td align=left valign=top>http://<INPUT TYPE=TEXT NAME="url" value="<?echo $url;?>" class="inputpesan"></td>
		</tr>		
		<tr>
		<td><br />&nbsp;</td>
		<td><br />&nbsp;</td><INPUT TYPE=hidden NAME="aksi" Value="1">
		<INPUT TYPE=hidden NAME="radio_id" Value="<? echo $radio_id;?>">
		<INPUT TYPE=hidden NAME="radio_alamat_id" Value="<? echo $radio_alamat_id;?>">
		<td valign=top><br /><INPUT TYPE=SUBMIT Value="Kirim Data" class="tombol"></FORM></td>
		</tr>
		</table>
		</form>
	<!--sisi kanan selesai-->
<?
include("../inc/footerAdmin.php");
?>