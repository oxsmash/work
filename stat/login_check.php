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
$Query = "SELECT * FROM cni_user_penyiar WHERE username ='".addslashes($userMasuk)."' AND level = 100  AND  status = '1' ";
echo $Query;

$check = mysql_query($Query) or die("Error in Query: $Query. mySQL said " . mysql_error() . '.');
$Results = mysql_num_rows($check);


while($rs_arr = mysql_fetch_array($check)) {
	$SessionRadio['id'] = $rs_arr[id_penyiar];
	$SessionRadio['user'] = $rs_arr[username];
	$SessionRadio['radio'] = $rs_arr[id_radio];
	$temp_pass = $rs_arr[password];
	
	
	//echo $SessionNya['id'];
}

if($crypt->Decrypt($temp_pass,key_generator)!=$passMasuk) $Results=0;
if($crypt->Decrypt($hKode,key_generator)!=$kodeKunci) $Results=0;

//echo '<br> sekuriti : '.$crypt->Decrypt($hKode,key_generator)."<br> pass : ".$crypt->Decrypt($temp_pass,key_generator)!=$passMasuk;

//echo $hKode."<br>".$kodeKunci."<br>".$temp_pass;

if ($Results != 0){ 
//echo "masuk";
$rt = mysql_query("UPDATE cni_user_penyiar SET last_login='".time()."', last_ip='".getenv("REMOTE_ADDR")."' WHERE id_penyiar='".$SessionRadio['id']."'") or die("Log error");
$Login = session_generator;

$cmd = "SELECT nama,mount FROM radio WHERE radio_id = '".$SessionRadio['radio']."' ";

//echo $cmd;

$res = mysql_query($cmd);
$brs = mysql_fetch_array($res);

$SessionRadio['nama_radio'] = $brs['nama'];
$SessionRadio['mount_radio'] = $brs['mount'];

$_SESSION['SessionRadio'] = $SessionRadio;


Header("Location: selamat_datang.php");
}
else
{
//if($userMasuk=="" and $passMasuk=="") Header("Location: index.php"); //echo "form salah";//
//else Header("Location: index.php"); //echo "lainnya";//
}
}
?>

