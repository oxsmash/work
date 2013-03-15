<?
ob_start();
session_start();
$judulHalaman="EDIT BERITA";
$fileIndex="";
$fileSearch="";
include("../inc/headerAdmin.php");
if(($_SERVER['HTTP_HOST']=="jogjastramers.com")||($_SERVER['HTTP_HOST']=="web2.web")){
$server="jogjastreamers";
}
else{
$server="indostreamers";
}

$aksi = $_POST['aksi'];
$act = $_GET['act'];
$id = $_GET['id'];

if($act=="edit")
{	

if ($server=='jogjastreamers') {
$queryString  = "select * from cni_streamer where status = '1' and id = 2";
 }
 else{
  $queryString = "select * from cni_streamer where status = '1' and id = 3";
 }
	$result=mysql_query($queryString) or die("errorrrr");
	
	$row_array=mysql_fetch_array($result);
	$judul=$row_array[judul];
	$pIsi=$row_array[isi];
	$vStatus=$row_array[status];
}

if($aksi=="1")
{
	$strError="";
	$pIsi=stripslashes($_POST['pIsi']);
	$vStatus = $_POST['vStatus'];
	
	
	if(strlen($pIsi) < 20) $strError=$strError."<li> Belum mengisi isi berita.";
	
	if(strlen($strError) < 1)
	{
		if($vStatus=="1")
		{
			$vStatus=1;
		}
		else
		{
			$vStatus=0;
		}
		$query = "UPDATE cni_streamer set isi='".addslashes($pIsi)."',status='$vStatus' where id='2'";
		
		mysql_query($query)or die(mysql_error());
		//Header("Location: selamat_datang.php");
	}
}
?>
				<!--sisi kanan mulai-->
				<br />
				&nbsp;&nbsp;<span class="judul_menu">Edit About Us ::</span>
				<br />
				<br />
				<?php
				if (strlen($strError) > 0)
					{
					echo kotakError($strError);
					}
				?>
				<form onSubmit="submit_form()" name="tBisnis" method="post" action="<?echo $PHP_SELF;?>">
				<table border="0" cellpadding="3" cellspacing="0">
				<tr>
				<td align=left valign=top>Isi </td><td align=left valign=top>:</td>
				<td align=left valign=top>&nbsp</td>
				</tr>
				<tr>
				<td align=left valign=top colspan="3">
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
				$editor->print_editor(520, 300);
				
				?>
				</td>
				</tr>
				<tr>
				<td align=left valign=top>Status</td><td align=left valign=top>:</td>
				<td align=left valign=top><INPUT TYPE=checkbox NAME="vStatus" value=1 <?if($vStatus==1) echo "Checked";?> class="inputPesan"></td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<INPUT TYPE=hidden NAME="id" Value="<? echo $id;?>">
				<INPUT TYPE=hidden NAME="aksi" Value="1">
				<td valign=top><INPUT TYPE=SUBMIT Value="Kirim Data" class="tombol"></td>
				</tr>
				</table>
				</form>
				<!--sisi kanan selesai-->
<?
include("../inc/footerAdmin.php");
?>
