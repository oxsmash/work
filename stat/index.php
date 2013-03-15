<?php
ob_start();
session_start();
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/fungsi_khusus.php");

$cKode=utk5Digit(rand(1,32768));
$crypt = new MD5Crypt;
$hKode = $crypt->Encrypt($cKode,key_generator);

$titikFolder="../";


?>
<html>
<head>
<title>Admin Area</title>
<link href="style.css" type="text/css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta name="Author" content="CV Citraweb Nusa InfoMedia ---- Web designer: Anjung Sakti Mapayoga, Web programmer: Ronal Rivandy" />
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
<td class="kotak" align="left" valign="top">
<?php

include "login.php";

?>

<?php

include("../inc/footerAdmin.php");
?>