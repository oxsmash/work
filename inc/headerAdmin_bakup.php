<?
ob_start();
session_start();
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/fungsi_khusus.php");
//if(basename($PHP_SELF)!="index.php")require("../inc/cekLogin.php");
if(!isset($_SESSION['SessionNya']['id'])) {
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
<style type="text/css" rel="stylesheet">
@media print {
	#menu{display:none;}	
	#flash {display:block;}
	#foot{display:none;}
	#frm{display:none;}
	#lg1,#lg2,#lg3{display:none;}
	.judul_menu{display:none;}
	input{display:none;}
	table,td{border:0px solid #fff;background:#fff}
	.kotak{border:0px solid #fff;}
}

</style>

</head>
<body leftMargin="0" topMargin="0" marginheight="0" marginwidth="0" bgcolor="#BBBABA"> 

<table cellspacing="0" cellpadding="0" border="0" width="100%" bgcolor="#ffffff">
<tr>
	<td align="left" valign="middle" id="lg1"><IMG src="../images/logoStream.gif"></td>
</tr>
<tr>
	<td align="left" valign="top" bgcolor="#EBEBEB" id="lg2"><img src="../images/spacer.gif" height="2" alt="" /></td>
</tr>
<tr>
	<td align="left" valign="top" bgcolor="#BBBABA" id="lg3"><img src="../images/spacer.gif" height="4" alt="" /></td>
</tr>
</table>

<table cellspacing="1" cellpadding="0" border="0" width="100%" height="80%">
<tr>
<td class="kotak" width="1%">&nbsp;</td>
<? if($_SESSION['SessionNya']['id'] > 0 and $_SESSION['Login'] = "STUPPAhjklmnbv"){?>
<td class="kotak" align="left" valign="top" width="20%">
	<table cellspacing="0" cellpadding="2" border="0" width="90%" id="menu">
	<tr>
	<td align="center" valign="top"><span class="judul_menu"><a href="selamat_datang.php">:: Menu Utama ::</a></span><br /><br /></td>
	</tr>
	<tr>
		<td align="left" valign="top"><a href="listJenisUsaha.php" class="mainlevel-topnav">+ Daftar Jenis Usaha</a></td>
	</tr>
	<tr>
		<td align="left" valign="top"><a href="addJenisUsaha.php" class="mainlevel-topnav">+ Tambah Jenis Usaha</a></td>
	</tr>
	<tr>
		<td align="left" valign="top"><a href="listKota.php" class="mainlevel-topnav">+ Daftar Kota</a></td>
	</tr>
	<tr>
		<td align="left" valign="top"><a href="addKota.php" class="mainlevel-topnav">+ Tambah Kota</a></td>
	</tr>
	<tr>
		<td align="left" valign="top"><a href="listRadio.php" class="mainlevel-topnav">+ Daftar Radio</a></td>
	</tr>
	<tr>
		<td align="left" valign="top"><a href="addRadio.php" class="mainlevel-topnav">+ Tambah Radio</a></td>
	</tr>
	<tr>
		<td align="left" valign="top"><a href="listPenyiar.php" class="mainlevel-topnav">+ Daftar Penyiar</a></td>
	</tr>
	<tr>
		<td align="left" valign="top"><a href="addPenyiar.php" class="mainlevel-topnav">+ Tambah Penyiar</a></td>
	</tr>
	<tr>
		<td align="left" valign="top"><a href="listBerita.php" class="mainlevel-topnav">+ Daftar Berita</a></td>
	</tr>
	<tr>
		<td align="left" valign="top"><a href="addBerita.php" class="mainlevel-topnav">+ Tambah Berita</a></td>
	</tr>
	<tr>
		<td align="left" valign="top"><a href="listBanner.php" class="mainlevel-topnav">+ Daftar Banner</a></td>
	</tr>
	<tr>
		<td align="left" valign="top"><a href="addBanner.php" class="mainlevel-topnav">+ Tambah Banner</a></td>
	</tr>
	<tr>
		<td align="left" valign="top"><a href="listLogBanner.php" class="mainlevel-topnav">+ Daftar log Banner</a></td>
	</tr>
	<tr>
		<td align="left" valign="top"><a href="listServer.php" class="mainlevel-topnav">+ Daftar Server</a></td>
	</tr>
	<tr>
		<td align="left" valign="top"><a href="addServer.php" class="mainlevel-topnav">+ Tambah Server</a></td>
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
		<td align="left" valign="top"><a href="editAbout.php?act=edit" class="mainlevel-topnav">+ Edit About Us</a></td>
	</tr>
	
	<tr>
		<td align="left" valign="top"><a href="editWelcome.php?act=edit" class="mainlevel-topnav">+ Edit welcome</a></td>
	</tr>
	<tr>
		<td align="left" valign="top"><a href="editAdvertisement.php?act=edit" class="mainlevel-topnav">+ Edit Advertisement</a></td>
	</tr>
	<tr>
		<td align="left" valign="top"><a href="editTerms.php?act=edit" class="mainlevel-topnav">+ Edit Terms & Condition</a></td>
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
