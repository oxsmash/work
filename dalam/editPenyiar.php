<?
ob_start();
session_start();
$judulHalaman="EDIT PENYIAR RADIO";
include("../inc/headerAdmin.php");
?>
<?

$id = 0;
if ($_GET) {
	$id = $_GET['id'];
}

$aksi = $_POST['aksi'];
if ($_POST) {
	$id = $_POST['id'];
}

$id = intval($id);
if ($id>0) {
	$sqlU = "select * from ".tabel_user_penyiar." where id_penyiar='".$id."'";
	$resU = mysql_query($sqlU);
	
	if (mysql_num_rows($resU)!=1) {
		Header("Location: listPenyiar.php");
		exit;
	}
	
	$rowR = mysql_fetch_object($resU);
	$username = $rowR->username;
	$radio = $rowR->id_radio;
	$vStatus = $rowR->status;
	$level = $rowR->level;
}

if($aksi=="1") {
	$strError="";
	$radio = intval($_POST['radio']);
	$vStatus = $_POST['vStatus'];
	if($vStatus!="1") { $vStatus="0"; }
	$level = intval($_POST['level']);	
	
	if ($radio<1) $strError .= "<li>radio belum dipilih.</li>";
	if ($level<1) $strError .= "<li>level belum dipilih.</li>";
	
	if (empty($strError)) {
		$sql = "update ".tabel_user_penyiar." set id_radio='".$radio."', level='".$level."', status='".$vStatus."' where id_penyiar='".$id."'";
		mysql_query($sql);
		$err = strtolower(mysql_error());
		if (!empty($err)) {
			$pos = strpos($err, "duplicate entry");
			if ($pos===false) {
				$strError .= "<li>".$err."</li>";
			} else { $strError .= "<li>Account untuk Radio terpilih sudah ada.</li>"; }
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
		&nbsp;&nbsp;<span class="judul_menu">Edit Penyiar Radio ::</span>
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
			<td align=left valign=top><?=$username?></td>
		</tr>
		<tr>
			<td align=left valign=top>Password</td><td align=left valign=top>:</td>
			<td align=left valign=top>tidak ditampilkan</td>
		</tr>
		<tr>
			<td align=left valign=top>Radio</td><td align=left valign=top>:</td>
			<td align=left valign=top><?=$selRadioUI?></td>
		</tr>
		<tr>
			<td align=left valign=top>Level</td><td align=left valign=top>:</td>
			<td align=left valign=top>
				<input type="radio" name="level" value="10" <?=$level==10?'checked="checked"':'';?>> Penyiar
				<input type="radio" name="level" value="100" <?=$level==100?'checked="checked"':'';?>> Admin
			</td>
		</tr>
		<tr>
			<td align=left valign=top>Status</td><td align=left valign=top>:</td>
			<td align=left valign=top><INPUT TYPE=checkbox NAME="vStatus" value=1 <?if($vStatus==1) echo "Checked";?>></td>
		</tr>
		<tr>
		<td><br />&nbsp;</td>
		<td><br />&nbsp;</td>
		<INPUT TYPE=hidden NAME="id" Value="<?=$id?>">
		<INPUT TYPE=hidden NAME="aksi" Value="1">
		<td valign=top><br /><INPUT TYPE=SUBMIT Value="Kirim Data" class="tombol"></FORM></td>
		</tr>
		</table>
		</form>
	<!--sisi kanan selesai-->
<?
include("../inc/footerAdmin.php");
?>
