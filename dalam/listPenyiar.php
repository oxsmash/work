<?
ob_start();
session_start();
$judulHalaman="DAFTAR PENYIAR RADIO";

include("../inc/headerAdmin.php");

$act = $_GET['act'];
$status = $_GET['status'];
$id = $_GET['id'];
$katakunci = $_GET['katakunci'];
$PageNo = $_GET['PageNo'];
$cHidden = $_GET['cHidden'];
$Submit = $_GET['Submit'];

if($act=="hapus" && $id > 0) {
	$sqlU="Update ".tabel_user_penyiar." set status='".$status."' where id_penyiar='".$id."'";
	mysql_query($sqlU);
}

if($act=="reset" && $id > 0) {
	$crypt = new MD5Crypt;
	$pass = mysql_real_escape_string($crypt->Encrypt(default_pass,key_generator));
	$sqlU="Update ".tabel_user_penyiar." set password='".$pass."' where id_penyiar='".$id."'";
	mysql_query($sqlU);
}

if($cHidden=="1") {
	$katakunci=trim($katakunci);	
	
	$arrKataKunci= explode(" ",$katakunci);  

	for($dd=0;$dd < count($arrKataKunci);$dd++) {
		$detQuery=$detQuery."(LCASE(username)) LIKE '%".strtolower($arrKataKunci[$dd])."%' AND ";		
	}
		
	$sqlview = "SELECT * FROM ".tabel_user_penyiar." where ". $detQuery ."ORDER BY id_penyiar DESC";
	$sqlview = str_replace("AND ORDER","ORDER",$sqlview);
} else {
	$sqlview = "SELECT * FROM ".tabel_user_penyiar." ORDER BY id_penyiar DESC";
}

// get all radio name
$sqlR = "select radio_id, nama from ".tabel_radio." ";
$resR = mysql_query($sqlR);
$arrR = array();
while ($rowR = mysql_fetch_object($resR)) {
	$arrR[$rowR->radio_id] = $rowR->nama;
}

//utk membuat otomatis bar halaman sesuai setting berita
$link=$PHP_SELF."";
$PageSize = 10;
include "../inc/barHalaman.php";
?>
	<!--sisi kanan mulai-->
	<br />
	&nbsp;&nbsp;<span class="judul_menu">Daftar Penyiar Radio ::</span>
	<br />
	<br />
	<form action="<?=$PHP_SELF;?>" method="get">
	<table cellpadding="0" cellspacing="0" border="0">
	<tr><td>Kata Kunci</td><td>:</td><td><input type="text" name="katakunci" value="<?=$katakunci?>" class="inputPesan"> 
	<input type="hidden" name="cHidden" value="1"> 
	<input type="submit" name="cSubmit" value="Cari" class="tombol"></td></tr>
	</table>
	</form>
	<? 
	if(strlen($katakunci) > 0) echo "Hasil pencarian dengan kata kunci \"<b>".$katakunci."\"</b><br />Ada <b>".$RecordCount."</b> data yang ditampilkan dalam <b>".$MaxPage."</b> halaman.";
	?>								
	<?echo $bar; ?>
	<table border="0" cellspacing="1" cellpadding="3" width="100%" bgcolor="#BBBABA">
	<tr bgcolor="#BBBABA">
	   <td valign="top" align="center"><b>No</b></td>
	   <td valign="top" align="center"><b>Username</b></td>
	   <td valign="top" align="center"><b>Nama Radio</b></td>
	   <td valign="top" align="center"><b>Level</b></td>
	   <td valign="top" align="center"><b>Login Terakhir</b></td> 
	   <td valign="top" align="center"><b>Status</b></td>
	   <td valign="top" align="center"><b>Reset Password</b></td>
	</tr>
	<?
	
	$result = mysql_query($sqlview);
	
	$k=0;
	$z=0;
	while($rs = mysql_fetch_array($result)) {
	$k=$k+1;
	$z=$k+(($PageNo - 1)*$PageSize);
	$bID = $rs['id_penyiar'];
	$bUser = $rs['username'];
	$bRadio = $arrR[$rs['id_radio']];
	$level = $rs['level'];
	$bLevel = "";
	if ($level=="10") $bLevel = "Penyiar";
	if ($level=="100") $bLevel = "Admin";
	
	if ($rs['last_login']== "0000-00-00 00:00:00") {
		$lastLogin = "belum pernah login";
	} else {
		$lastLogin = tglIndo($rs['last_login'],"l",0);
	}
	?>
	<tr bgcolor="#ffffff" onMouseOver="this.style.background='#ebebeb'" onMouseOut="this.style.background='#ffffff'">
		<td valign="middle" align="center"><?echo $z;?>.</td>
		<td valign="middle"><a href="editPenyiar.php?act=edit&id=<?echo $bID?>"><?echo $bUser;?></a></td>	   
		<td valign="middle"><?=$bRadio?></td>
		<td valign="middle"><?=$bLevel?></td>
		<td valign="middle"><?=$lastLogin?></td>
		<td valign="top" align="center">
		   <?
		   if($rs['status']=="0")
		   {
		   	echo '<a href="listPenyiar.php?act=hapus&id='.$rs['id_penyiar'].'&status=1"><img src="../images/on3.gif" alt="Active" border="0"></a>&nbsp;';
		   	echo '<img src="../images/off2.gif" border="0" alt="Set Inactive">';				   	
		   }
		   else
		   {
		   	echo '<img src="../images/on2.gif" alt="Active">&nbsp;';
		   	echo '<a href="listPenyiar.php?act=hapus&id='.$rs['id_penyiar'].'&status=0"><img src="../images/off3.gif" border="0" alt="Set Inactive"></a>';
		   }
		   ?>
		</td>
		<td valign="top" align="center">
			<a href="listPenyiar.php?act=reset&id=<?=$rs['id_penyiar']?>"><img src="../images/arrow_refresh.gif" alt="Reset Password" border="0"></a>
		</td>
	</tr>
	<?
	}
	?>
	</table>
	<!--sisi kanan selesai-->
<?
include("../inc/footerAdmin.php");
?>
