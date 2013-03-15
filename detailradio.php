<?php

//ob_start();
//session_start();
include_once("inc/fungsi.php");
include_once("inc/config.php");

if(!empty($_GET['id'])) {
	$id = $_GET['id'];
}else {
	$id = '';
}

$sql3 = "SELECT * FROM radio where status=1 and radio_id='".$id."'";
$res3 = mysql_query($sql3) or die("");
$row_berita=mysql_fetch_array($res3);


?>

<b><?echo strtoupper($row_berita[nama]);?></b><br/>
	<?echo $row_berita[keterangan];?>

