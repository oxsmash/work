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
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/skrp_adm.js"></script>
</head>
<body leftMargin="0" topMargin="0" marginheight="0" marginwidth="0" bgcolor="#BBBABA"> 
<table cellspacing="0" cellpadding="8" border="0" width="100%" bgcolor="#ffffff">
<tr>
	<td align="left" valign="middle" id="lg1"><IMG src="../images/logoStream.gif"></td>
	<td align="right">
		<table>
			<tr>
				<td align="center">
					<a href="selamat_datang.php"><img src="../images/home.jpg" border="0"> </a>
					<br> <a href="selamat_datang.php">Home</a>
				</td>
				<td><a href="logout.php"><img src="../images/logout.jpg" border="0"></a>
					<br> <a href="logout.php">Logout</a>
				</td>
			</tr>
		</table>		
	</td>
</tr>
<td class="kotak" colspan="2" align="left" valign="top" height="600" style="border-top:5px solid #BBBABA;">
	<table width="100%">
		<tr>
			<td width="20%" valign="top">
				<? if($_SESSION['SessionRadio']['id'] > 0 ){?>
				<table cellspacing="0" cellpadding="2" border="0" width="90%" id="menu">
					<tr>
						<td width="10%"><img src="../images/stat_kecil.jpg"  onclick="ikon('stat');" class="pointer" ></td>	
						<td align="left" valign="middle" onclick="ikon('stat');" class="pointer" style="border-bottom:1px solid #BBBABA;border-right:1px solid #BBBABA">Statistik & Durasi</td>
					</tr>
					<tr>
						<td></td>
						<td id="stat" valign="top">
							<div class="hilang">
								<table cellpadding="5">
									<tr>
										<td><a href="test_grafik.php" ><img src="../images/stat.jpg" border='0'></a></td>
										<td><a href="test_grafik.php" >Statistik Radio</a></td>
									</tr>
									<tr>
										<td><a href="listStat3.php" ><img src="../images/list.gif" border='0'></a></td>
										<td><a href="listStat3.php" >Daftar Log Radio</a></td>
									</tr>
									<tr>
										<td><a href="listStatWaktu.php" ><img src="../images/stat.jpg" border='0'></a></td>
										<td><a href="listStatWaktu.php" >Statistik Durasi Radio</a></td>
									</tr>
									<tr>
										<td><a href="listLogDurasi.php" ><img src="../images/list.gif" border='0'></a></td>
										<td><a href="listLogDurasi.php" >Log Durasi Radio</a></td>
									</tr>
								</table>	
									
									
							</div>
						</td>
					</tr>
					<tr>
						<td width="10%"><a href="gantiPassword.php"><img src="../images/password_kecil.jpg"  class="pointer" border="0"></a></td>	
						<td align="left" valign="middle" style="border-bottom:1px solid #BBBABA;border-right:1px solid #BBBABA"><a href="gantiPassword.php">Ganti Password</a></td>
					</tr>
				</table>	
				<?}?>
			</td>
			<td valign="top">

	