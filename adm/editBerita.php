<?
ob_start();
session_start();
$judulHalaman="EDIT BERITA";
$fileIndex="";
$fileSearch="";
$halaman_member=true;
$minimal_level=90;
//if(in_array(2,$_SESSION['SessionNya']['aplikasi'])) $minimal_level=1;
include("../inc/headerAdmin.php");
?>
<?

$aksi = $_POST['aksi'];
$act = $_GET['act'];
$id = $_GET['id'];

if($act=="edit")
{	
	$queryString = "SELECT * from ".tabel_berita." where berita_id='".$id."'";
	
	$result=mysql_query($queryString) or die("errorrrr");
	
	$row_array=mysql_fetch_array($result);
	$kategoriNya=$row_array[kategori_id];
	$judul=$row_array[judul_berita];
	$pIsi=$row_array[isi_berita];
	$pSumber=$row_array[sumber_berita];
	$vStatus=$row_array[status_berita];	
	
}

if($aksi=="1")
{
	$strError="";
	$judul=stripslashes($_POST['judul']);
	$pIsi=stripslashes($_POST['pIsi']);
	$vStatus = $_POST['vStatus'];
	$id = stripslashes($_POST['id']);
	
	//$kategoriNya=1;
	if($judul=="") $strError=$strError."<li> Belum mengisi judul berita.";
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
		$query = "UPDATE ".tabel_berita." set kategori_id='".addslashes($kategoriNya)."',judul_berita='".addslashes($judul)."',isi_berita='".addslashes($pIsi)."',status_berita='$vStatus',tgl_berita='".time()."',ip_berita='".getenv("REMOTE_ADDR")."' where berita_id='".$id."'";
		echo $query;
		mysql_query($query)or die(mysql_error());
		Header("Location: listBerita.php");
	}
}
?>
				<!--sisi kanan mulai-->
				<br />
				&nbsp;&nbsp;<span class="judul_menu">Edit Berita ::</span>
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
				<td align=left valign=top>Judul Berita</td><td align=left valign=top>:</td>
				<td align=left valign=top><INPUT TYPE=TEXT NAME="judul" value="<?echo $judul;?>" class="inputPesan" size="50" maxlength="200"></td>
				</tr>
				<tr>
				<td align=left valign=top>Isi Berita </td><td align=left valign=top>:</td>
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
