<?php
// ob_start();
session_start();
require_once("inc/config.php");
$id = $_GET['id'];

if($id > 0)
	{
	$cmdBN2="Select * from ".tabel_banner." where status_banner=1 and banner_id='".$id."'";
	$res_cmdBN2=mysql_query($cmdBN2);
	$rs_cmdBN2=mysql_fetch_array($res_cmdBN2);
	
	$lnk = $rs_cmdBN2[link_banner];
	$lnk = str_replace("http://", "", strtolower($lnk));
	
	$cmdKlik = "UPDATE ".tabel_banner." SET 
				klik_banner = klik_banner + 1 
				WHERE 	banner_id = ".$rs_cmdBN2[banner_id]." ";
				
	mysql_query($cmdKlik);			
		
	Header("Location: http://".$lnk);		
	}
?>



