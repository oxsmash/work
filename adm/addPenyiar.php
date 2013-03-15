<?
ob_start();
session_start();
$judulHalaman="TAMBAH PENYIAR RADIO";
include("../inc/headerAdmin.php");
?>
<?

$aksi = $_POST['aksi'];

if($aksi=="1") {
	$strError="";
	$username = stripslashes($_POST['username']);
	$radio = intval($_POST['radio']);
	$level = intval($_POST['level']);
	
	if (empty($username)) $strError .= "<li>Username masih kosong.</li>";
	if ($radio<1) $strError .= "<li>radio belum dipilih.</li>";
	if ($level<1) $strError .= "<li>level belum dipilih.</li>";
	
	if (empty($strError)) {
		$crypt = new MD5Crypt;
		$pass = mysql_real_escape_string($crypt->Encrypt(default_pass,key_generator));
		
		$sql = "insert into ".tabel_user_penyiar."(username, password, id_radio, level, last_ip, status) values('".mysql_real_escape_string($username)."','".$pass."','".$radio."','".$level."','".$_SERVER['REMOTE_ADDR']."','1')";
		mysql_query($sql);
		$err = strtolower(mysql_error());
		if (!empty($err)) {
			$pos = strpos($err, "duplicate entry");
			if ($pos===false) {
				$strError .= "<li>".$err."</li>";
			} else { $strError .= "<li>Account username atau radio sudah ada.</li>"; }
		} else {
			Header("Location: listPenyiar.php");
			exit;
		}
	}
}

$selRadioUI = "";
$sqlR = "select radio_id, nama from ".tabel_radio." ";
$resR = mysql_query($sqlR);
while ($rowR = mysql_fetch_object($resR)) {
	if ($radio==$rowR->radio_id) {
		$seld = 'selected="selected"';
	} else {
		$seld = '';
	}
	$selRadioUI .= '<option '.$seld.' value="'.$rowR->radio_id.'">'.$rowR->nama.'</option>';
}
$selRadioUI = '<select name="radio"><option value="0">Pilih Radio</option>'.$selRadioUI.'</select>';

?>
	<!--sisi kanan mulai-->
		<br />
		&nbsp;&nbsp;<span class="judul_menu">Tambah Penyiar Radio ::</span>
		<br />
		<br />
		<?php
		if (strlen($strError) > 0)
			{
			echo kotakError($strError);
			echo '<br /><br />';
			}
		?>
		<form method="post" action="<?echo $PHP_SELF;?>">
		<table border="0" cellpadding="3" cellspacing="0">
		<tr>
			<td align=left valign=top>Username</td><td align=left valign=top>:</td>
			<td align=left valign=top><INPUT TYPE=TEXT NAME="username" value="<?=$username?>" class="inputpesan"></td>
		</tr>
		<tr>
			<td align=left valign=top>Password</td><td align=left valign=top>:</td>
			<td align=left valign=top><?=default_pass?> (password default)</td>
		</tr>
		<tr>
			<td align=left valign=top>Level</td><td align=left valign=top>:</td>
			<td align=left valign=top>
				<input type="radio" name="level" value="10" <?=$level==10?'checked="checked"':'';?>> Penyiar
				<input type="radio" name="level" value="100" <?=$level==100?'checked="checked"':'';?>> Admin
			</td>
		</tr>
		<tr>
			<td align=left valign=top>Radio</td><td align=left valign=top>:</td>
			<td align=left valign=top><?=$selRadioUI?></td>
		</tr>
		<tr>
		<td><br />&nbsp;</td>
		<td><br />&nbsp;</td><INPUT TYPE=hidden NAME="aksi" Value="1">
		<td valign=top><br /><INPUT TYPE=SUBMIT Value="Kirim Data" class="tombol"></FORM></td>
		</tr>
		</table>
		</form>
	<!--sisi kanan selesai-->
<?
include("../inc/footerAdmin.php");
?>
