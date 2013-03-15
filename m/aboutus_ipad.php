<?
include_once("../inc/fungsi.php");
include_once("../inc/config.php");
include_once('../inc/function_ip.php');
?>
<html>
<head>
<title>JOGJA STREAMERS</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="css/style-ipad.css" media="screen" />
<link rel="Shortcut Icon" href="js.ico" type="image/x-icon"/>
</head>
<body>
			
			<table width="100%" border="0" cellpadding="0" cellspacing="7" >
			<tr>
				<td class="orange f-15"><b>About Us</b><br></td>
			</tr>
			<tr>
				<td  align="justify"  style="color:white;">
					<? $r = mysql_query("select * from cni_streamer where status = '1' and id = 2");
					while($d = mysql_fetch_assoc($r)) {
					echo $d[isi];
					}?>
				</td>
			</tr>
			</table>		
</body>
</html>