<?php
ob_start();
session_start();
require("../inc/config.php");
require("../inc/fungsi.php");

//$userMasuk=stripslashes($userMasuk);
//$passMasuk=stripslashes($passMasuk);

$crypt = new MD5Crypt;

$SessionNya=array();
$SessionSetting=array();

if($_POST)
{

$userMasuk = $_POST['userMasuk'];
$passMasuk = $_POST['passMasuk'];
$kodeKunci = $_POST['kodeKunci'];
$hKode = $_POST['hKode'];

$stU=0;
$Login = "";
$Query = "SELECT ".tabel_user.".*,".tabel_user_detail.".* FROM ".tabel_user.",".tabel_user_detail." WHERE ".tabel_user.".user_name ='".addslashes($userMasuk)."' AND ".tabel_user.".level_id > 0 AND ".tabel_user_detail.".user_id=".tabel_user.".user_id";
//echo $Query;

$check = mysql_query($Query) or die("Error in Query: $Query. mySQL said " . mysql_error() . '.');
$Results = mysql_num_rows($check);


while($rs_arr = mysql_fetch_array($check)) {
	$SessionNya['id'] = $rs_arr[user_id];
	$SessionNya['user'] = $rs_arr[user_name];
	$SessionNya['nama'] = $rs_arr[nama];
	$SessionNya['email'] = $rs_arr[email];
	$SessionNya['level'] = $rs_arr[level_id];	
	$SessionNya['aplikasi'] = array(0);
	if(strlen($rs_arr[aplikasi_id]) > 0) $SessionNya['aplikasi'] = explode(",",$rs_arr[aplikasi_id]);
	$SessionNya['klien'] = $rs_arr[klien_id];
	$SessionNya['last_login'] = $rs_arr[last_login];
	$SessionNya['tgl_daftar'] = $rs_arr[tgl_daftar];
	$temp_pass = $rs_arr[user_pass];
	
	//echo $SessionNya['id'];
}

if($crypt->Decrypt($temp_pass,key_generator)!=$passMasuk) $Results=0;
if($crypt->Decrypt($hKode,key_generator)!=$kodeKunci) $Results=0;

if ($Results != 0)
{ echo "masuk";
$rt = mysql_query("UPDATE ".tabel_user." SET last_login='".time()."', last_ip='".getenv("REMOTE_ADDR")."',status_online=1 WHERE user_id='".$SessionNya['id']."'") or die("Log error");
$Login = session_generator;
/*session_register("Login");
session_register("SessionNya");
session_register("SessionSetting");*/
//setcookie('admin1', $userMasuk, time() +812400);
//Print("<b>Selamat Datang $userMasuk</b><br><br>");
$_SESSION['SessionNya'] = $SessionNya;
$_SESSION['Login'] = $Login;
$_SESSION['SessionSetting'] = $SessionSetting;

Header("Location: selamat_datang.php");
}
else
{
if($userMasuk=="" and $passMasuk=="") Header("Location: index.php");
else Header("Location: index.php");
}
}
?>

