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
<td class="kotak" colspan="2" align="left" valign="top" height="600" style="border-top:5px solid #BBBABA;"><br><br><br>

	