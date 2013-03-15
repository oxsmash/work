<?php
ob_start();
session_start();

include "header.php";

$minKarakter = 6;
if ($_POST) {
	$crypt = new MD5Crypt;
	$vPassLama = htmlspecialchars(trim($_POST["vPassLama"]), ENT_QUOTES);
	$vPassLama = strtolower($vPassLama);
	$vPass1 = htmlspecialchars(trim($_POST["vPass1"]), ENT_QUOTES);
	$vPass1 = strtolower($vPass1);
	$vPass2 = htmlspecialchars(trim($_POST["vPass2"]), ENT_QUOTES);
	$vPass2 = strtolower($vPass2);
	$strError = "";
	$id = $_SESSION["penyiarSession"]["id"];
	
	if (empty($vPassLama)) {
		$strError .= "<li>Password lama masih kosong</li>";
	} else {
		$sql = "select * from ".tabel_user_penyiar." where id_penyiar='".$id."'";
		$res = mysql_query($sql);
		$row = mysql_fetch_object($res);
		$passDB = $row->password;
		if($vPassLama != $crypt->Decrypt($passDB,key_generator)) $strError .= "<li>Password lama salah</li>";
	}
	if (empty($vPass1)) $strError .= "<li>Password baru masih kosong</li>";
	if (!empty($vPass1) && strlen($vPass1)<$minKarakter)  $strError .= "<li>Jumlah karakter Password Baru minimal ".$minKarakter.".</li>";
	if (empty($vPass2)) $strError .= "<li>Ketik ulang password baru masih kosong</li>";
	if ($vPass1 != $vPass2) $strError .= "<li>Harap mengisi retype password yang sama</li>";
	
	if (empty($strError)) {
		$sqlU = "update ".tabel_user_penyiar." set password='".mysql_real_escape_string($crypt->Encrypt($vPass1,key_generator))."' where id_penyiar='".$id."'";
		mysql_query($sqlU);
		header("location:gantiPassword.php?sukses=1");
		exit;
	}
	
}


?>
&nbsp;&nbsp;<span class="judul_menu">Ganti Password ::</span>
<br /><br />
<?php
	if (strlen($strError)>0) { kotakError($strError); }
	if ($_GET['sukses']==1) { echo "<b>&bull; Password berhasil diubah!</b><br/><br/>"; }
?>
<form method="post" action="<?=$PHP_SELF;?>">
<table border=0>
<tr>
<td align=left valign=top>Password Lama</td><td align=left valign=top>:</td>
<td align=left valign=top><INPUT TYPE=Password NAME="vPassLama" value="" class="inputpesan"></td>
</tr>
<tr>
<td align=left valign=top>Password Baru</td><td align=left valign=top>:</td>
<td align=left valign=top><INPUT TYPE=Password NAME="vPass1" value="" class="inputpesan"> (minimal <?=$minKarakter?> karakter)</td>
</tr>
<tr>
<td align=left valign=top>Ketik Ulang Password Baru</td><td align=left valign=top>:</td>
<td align=left valign=top><INPUT TYPE=Password NAME="vPass2" value="" class="inputpesan"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td><INPUT TYPE=hidden NAME="aksi" Value="1">
<td valign=top><INPUT TYPE=SUBMIT Value="Submit" class="tombol"></td>
</tr>
</table>
</form>

<?
include "footer.php";
?>