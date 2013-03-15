<?php
ob_start();
session_start();
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/fungsi_khusus.php");

if (ereg("index.php", $_SERVER['PHP_SELF'])) {
	if (isset($_SESSION["penyiarSession"])) {
		header("location:utama.php");
		exit;
	}
} else {
	if (!isset($_SESSION["penyiarSession"])) {
		header("location:index.php");
		exit;
	}
}
?>
<html>
<head>
<title>Penyiar Area</title>
<link href="style.css" type="text/css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta name="Author" content="CV Citraweb Nusa InfoMedia ---- Web designer: Ardian Sukmaji, Web programmer: Muhammad Iskhaq Ali" />
</head>
<body leftMargin="0" topMargin="0" marginheight="0" marginwidth="0" bgcolor="#BBBABA">
<table cellspacing="0" cellpadding="0" border="0" width="100%" bgcolor="#FFFFFF">
<tr>
<td align="left" valign="middle"><img src="../images/logoStream.gif" alt="" /></td>
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
<?php if (isset($_SESSION["penyiarSession"])) { ?>
<td class="kotak" align="left" valign="top" width="20%">
	<table cellspacing="0" cellpadding="2" border="0" width="100%">
	<tr>
	<td align="center" valign="top"><span class="judul_menu">:: Menu Utama ::</span><br /><br /></td>
	</tr>
	<tr>
		<td align="left" valign="top"><a href="appchat.php" class="mainlevel-topnav">+ Aplikasi Chat</a></td>
	</tr>
	<tr>
		<td align="left" valign="top"><a href="gantiPassword.php" class="mainlevel-topnav">+ Ganti Password</a></td>
	</tr>
	<tr>
	<td align="left" valign="top"><a href="logout.php" class="mainlevel-topnav">+ Logout</a></td>
	</tr>
	</table>
</td>
<?php } ?>
<td class="kotak" align="left" valign="top">
		<br />