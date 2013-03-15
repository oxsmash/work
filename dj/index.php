<?php
ob_start();
session_start();

include "header.php";

$cKode=utk5Digit(rand(1,32768));
$crypt = new MD5Crypt;
$hKode = $crypt->Encrypt($cKode,key_generator);

if ($_POST && $_POST['Submit'] == 1) {
	$strError = "";
	$user = htmlspecialchars(trim($_POST["userMasuk"]), ENT_QUOTES);
	$user = strtolower($user);
	$pass = htmlspecialchars(trim($_POST["passMasuk"]), ENT_QUOTES);
	$pass = strtolower($pass);
	$kodeKunci = $_POST['kodeKunci'];
	$code = $_POST['hKode'];
	
	// if($crypt->Decrypt($temp_pass,key_generator)!=$passMasuk) $Results=0;
	if (empty($user)) $strError .= "X";
	if (empty($pass)) $strError .= "X";
	if($crypt->Decrypt($code,key_generator)!=$kodeKunci) $strError .= "X";

	if (empty($strError)) {
		$sql = "select * from ".tabel_user_penyiar." where username='".$user."' and status='1'";
		$res = mysql_query($sql);
		$row = mysql_fetch_object($res);
		$id = $row->id_penyiar;
		$db_pass = $row->password;
		
		if($crypt->Decrypt($db_pass,key_generator)!=$pass) {
			header("location:".$_SERVER['PHP_SELF']);
			exit;
		} else {
			$sqlU = "update ".tabel_user_penyiar." set status_chat='1', last_chat=now(), last_login=now(), last_ip='".$_SERVER['REMOTE_ADDR']."', status_login='1' where id_penyiar='".$id."'";
			mysql_query($sqlU);
			
			$penyiarSession['id'] = $id;
			session_register("penyiarSession");
			
			header("location:appchat.php");
			exit;
		}
	}
}

?>

<table cellspacing="0" cellpadding="5" border="0" width="100%">
<tr>
<td align="center" valign="middle">
	<form method="POST" action="index.php">
	<table cellspacing="0" cellpadding="5" border="0">		
		<tr>
		<td align="center" valign="top" colspan="3"><br><span class="agak_besar"><b>Log In</b></span></td>
		</tr>
		<tr>
		      <td align="center">Username:<br><input type="text" name="userMasuk" size="16" class="inputpesan"></td>
		</tr>
		<tr>
		      <td align="center">Password:<br><input type="password" name="passMasuk" size="16" class="inputpesan"></td>
		</tr>		
		<tr>
		      <td align="center">
		      <?php echo "<img src=\"../bikinKode.php?string=$cKode\" width=\"50\" height=\"20\">"; ?><br>
		      Silahkan isi kode diatas:<br>
		      <input class="inputpesan" type="text" name="kodeKunci" size="12" maxlength="12" />
		      </td>
		</tr>
		<tr>
		<td align="center" valign="top" colspan="3">
		<input type="hidden" name="hKode" value="<?=$hKode?>" class="tombol" />
		<input type="submit" name="Submit" value="Login" class="tombol" />
		<input type="hidden" name="Submit" value="1" /></td>
		</tr>		
	</table>
	</form>
</td>
</tr>
</table>

<?
include "footer.php";
?>