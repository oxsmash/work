<?
ob_start();
session_start();
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/fungsi_khusus.php");
//if(basename($PHP_SELF)!="index.php")require("../inc/cekLogin.php");
if(!isset($_SESSION['SessionRadio']['id'])) {
	header("location:index.php");
}


$cKode=utk5Digit(rand(1,32768));
$crypt = new MD5Crypt;
$hKode = $crypt->Encrypt($cKode,key_generator);

$titikFolder="../";



?>
<html>
<head>
<title>Admin Area</title>
<meta http-equiv="Content-Type" content="text/html; ">
<meta name="Author" content="CV Citraweb Nusa InfoMedia ---- Web designer: Anjung Sakti Mapayoga, Web programmer: Ronal Rivandy" />
<link href="style.css" type="text/css" rel="stylesheet">
<link rel="Shortcut Icon" href="js.ico" type="image/x-icon" />
<script language=JavaScript src="<?php echo $titikFolder.'inc/fungsi_java.js';?>" type=text/javascript></script>
</head>
<body leftMargin="0" topMargin="0" marginheight="0" marginwidth="0" bgcolor="#BBBABA"> 

<table cellspacing="0" cellpadding="0" border="0" width="100%" bgcolor="#ffffff">
<tr>
	<td align="left" valign="middle"><IMG src="../images/logoStream.gif"></td>
</tr>
<tr>
	<td align="left" valign="top" bgcolor="#EBEBEB"><img src="../images/spacer.gif" height="2" alt="" /></td>
</tr>
<tr>
	<td align="left" valign="top" bgcolor="#BBBABA"><img src="../images/spacer.gif" height="4" alt="" /></td>
</tr>
</table>

<table cellspacing="1" cellpadding="0" border="0" width="100%" height="80%">
<tr>
<td class="kotak" width="1%">&nbsp;</td>
<? if($_SESSION['SessionRadio']['id'] > 0 ){?>
<td class="kotak" align="left" valign="top" width="20%">
	<table cellspacing="0" cellpadding="2" border="0" width="90%">
	<tr>
	<td align="center" valign="top"><span class="judul_menu"><a href="selamat_datang.php">:: Menu Utama ::</a></span><br /><br /></td>
	</tr>

	<tr>
		<td align="left" valign="top"><a href="test_grafik.php" class="mainlevel-topnav">+ Statistik Radio</a></td>
	</tr>
	<tr>
		<td align="left" valign="top"><a href="listStat3.php" class="mainlevel-topnav">+ Daftar Log Radio</a></td>
	</tr>
	<tr>
		<td align="left" valign="top"><a href="listStatWaktu.php" class="mainlevel-topnav">+ Statistik Durasi Radio</a></td>
	</tr>
	<tr>
		<td align="left" valign="top"><a href="listLogDurasi.php" class="mainlevel-topnav">+ Log Durasi Radio</a></td>
	</tr>
	<tr>
		<td align="left" valign="top"><a href="gantiPassword.php" class="mainlevel-topnav">+ Ganti Password</a></td>
	</tr>
	<tr>
	<td align="left" valign="top"><a href="logout.php" class="mainlevel-topnav">+ Logout</a></td>
	</tr>
	</table>
</td>
<?}?>
<td class="kotak" align="left" valign="top">
