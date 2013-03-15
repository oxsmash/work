<?php
ob_start();
session_start();
$ke=$HTTP_REFERER;
header($ke);
require("../inc/headerStat.php");

if($sukses == 'ok') {

	echo "password baru telah disimpan ";

}else {

	$aksi = $_POST['aksi'];

	if($aksi=="1"){	
		$crypt = new MD5Crypt;
		$vID=$id;
		$strError="";
		$vPassLama=stripslashes($_POST['vPassLama']);
		$vPass1=stripslashes($_POST['vPass1']);
		$vPass2=stripslashes($_POST['vPass2']);
		
		if(strlen($vPassLama) < 1) $strError=$strError."<li>Silakan isi password lama."; 
		if(strlen($vPassLama) > 0) 
			{
			$queryCP = "SELECT * from cni_user_penyiar where id_penyiar='".$_SESSION['SessionRadio']['id']."'";
			$resultCP=mysql_query($queryCP) or die("errorrrr");		
				while($row_arrayCP=mysql_fetch_array($resultCP)) {
				$vPassLama2=$row_arrayCP[password];
				}
			if($vPassLama != $crypt->Decrypt($vPassLama2,key_generator)) $strError=$strError."<li>Password salah!"; 
			}
		
		if(strlen($vPass1) < 1) $strError=$strError."<li>Silakan isi password baru."; 
		if(strlen($vPass2) < 1) $strError=$strError."<li>Ketik ulang password baru."; 
		if(strlen($vPass1) > 0 AND strlen($vPass2) > 0)
			{
			if($vPass1 != $vPass2) $strError=$strError."<li>Pengetikan ulang password baru salah!";		
			}
		
		if(strlen($strError) < 1)
		{
		$cmd = "UPDATE cni_user_penyiar SET password='".addslashes($crypt->Encrypt($vPass1,key_generator))."' where id_penyiar ='".$_SESSION['SessionRadio']['id']."'";
		mysql_query($cmd) or die("Erroeerrrrr UPdate:".mysql_error());
		Header("Location: gantiPassword.php?sukses=ok");
		}
	}



?>

				<!--sisi kanan mulai-->
				&nbsp;&nbsp;<span class="judul_menu">Ganti Password ::</span>
				<br /><br />
					<?php
					if (strlen($strError) > 0)
						{
						echo kotakError($strError);
						}
					if($sukses!="ok"){
					?>
					<form method=post action="<?=$PHP_SELF;?>">
					<table border=0>
					<tr>
					<td align=left valign=top>Password Lama</td><td align=left valign=top>:</td>
					<td align=left valign=top><INPUT TYPE=Password NAME="vPassLama" value="<?echo $vPassLama;?>" class="inputpesan"></td>
					</tr>
					<tr>
					<td align=left valign=top>Password Baru</td><td align=left valign=top>:</td>
					<td align=left valign=top><INPUT TYPE=Password NAME="vPass1" value="<?echo $vPass1;?>" class="inputpesan"></td>
					</tr>
					<tr>
					<td align=left valign=top>Ketik Ulang Password</td><td align=left valign=top>:</td>
					<td align=left valign=top><INPUT TYPE=Password NAME="vPass2" value="<?echo $vPass2;?>" class="inputpesan"></td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td valign=top>
					<input type="hidden" name="aksi" Value="1">
					<input type="hidden" name="hid_update" value="1">
					<input type="hidden" name="idNya" value="<?=$idNya?>">
					<input type="hidden" name="khusus" value="<?=$khusus?>">								
					<input type="hidden" name="ok" value="Update" class="tombol">
					<input type="hidden" name="aksi" value="1">
					<input type="submit" value="Submit" class="tombol"></td>
					</tr>
					</table>	
					</form>
					<?
					}
					else
					{
					echo '<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;<b>Password has been changed succesfully</b><br />';
					}
					?>
				<!--sisi kanan selesai-->
<?

}

require("../inc/footerAdmin.php");
?>
