<?
ob_start();
session_start();
$judulHalaman="TAMBAH SERVER";
include("../inc/headerAdmin.php");
?>
<?

$aksi = $_POST['aksi'];
$act = $_GET['act'];
$id = $_GET['id'];



if($aksi=="1")
{
	$strError="";

	$area=stripslashes($_POST['area']);
	$url=stripslashes($_POST['url']);
	
	
	$id = $_POST['id'];
	
	
	//$kategoriNya=1;
	if($area=="") $strError=$strError."<li> Belum mengisi area.";
	if($url=="") $strError=$strError."<li> Belum mengisi url.";
	
	if(strlen($strError) < 1)
	{
		if(!isset($status)) $status = 0;
		$sql = "update tb_url set area = '$area',  
			     
			    url = '$url' where id = $id";
		
		
		
		mysql_query($sql);

	
		Header("Location: listServer.php");
		exit;
	}
}

if($act == 'del') {
	mysql_query(sprintf("delete from tb_url where id = %d", $id));
	mysql_query("optimize table radio_alamat");


	header(sprintf("Location: editKota.php?act=edit&id=%d", $id));
	exit;
}


if($act == 'edit') {
	$r = mysql_query("select * from tb_url where id = '$id'");
	$d = mysql_fetch_assoc($r);

	@extract($d);
}
?>
	<!--sisi kanan mulai-->
		<br />
		&nbsp;&nbsp;<span class="judul_menu">Edit Server ::</span>
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
		<INPUT TYPE=hidden NAME="id" Value="<? echo $id;?>">
		</form>


<!--		
-->
	<!--sisi kanan selesai-->
<?
include("../inc/footerAdmin.php");
?>
