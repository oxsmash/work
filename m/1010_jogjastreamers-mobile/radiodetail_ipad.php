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
<?	


		
	$cmd = "SELECT * FROM radio WHERE radio_id='".$_GET["id"]."' and status = '1' limit 1";	
	$res = mysql_query($cmd);
	while($brs = mysql_fetch_array($res)){
		?>
		<table width="100%" border="0" cellpadding="0" cellspacing="7" >
		<tr>
			<td><b><?echo strtoupper($brs[nama]);?></b><br></td>
		</tr>
		<tr>
			<td  align="justify"  class="abu">
			<?echo $brs[keterangan];?>
			</td>
		</tr>
		</table>
		<?
	}
?>
</body>
</html>