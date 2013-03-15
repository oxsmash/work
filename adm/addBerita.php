<?
ob_start();
session_start();
$judulHalaman="TAMBAH BERITA";
include("../inc/headerAdmin.php");
?>
<?
$aksi = $_POST['aksi'];

if($aksi=="1")
{	
	$strError="";
	$judul=stripslashes($_POST['judul']);
	$pIsi=stripslashes($_POST['pIsi']);
	
	//$kategoriNya=1;
	if($judul=="") $strError=$strError."<li> Belum mengisi judul berita.";
	if(strlen($pIsi) < 20) $strError=$strError."<li> Belum mengisi isi berita.";
	
	
	if(strlen($strError) < 1)
	{
		$query = "INSERT INTO ".tabel_berita."(kategori_id,judul_berita,isi_berita,tgl_berita,ip_berita) VALUES('".addslashes($kategoriNya)."','".addslashes($judul)."','".addslashes($pIsi)."','".time()."','".getenv("REMOTE_ADDR")."')";
		mysql_query($query) or die(mysql_error());
		Header("Location: listBerita.php");
	}
	
}
?>
			<!--sisi kanan mulai-->
				<br />
				&nbsp;&nbsp;<span class="judul_menu">Tambah Berita ::</span>
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
				<td align=left valign=top><INPUT TYPE=TEXT NAME="judul" value="<?echo $judul;?>" class="inputpesan" size="50" maxlength="200"></td>
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