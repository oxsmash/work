<?php

include_once("inc/config.php");
include_once("inc/fungsi.php");

if(!empty($_POST['id'])) {
	
	$cmd = "INSERT INTO statistik(id_radio,tgl,referer,ip) 
			VALUES(
				'".$_POST['id']."',
				now(),
				'".$_SERVER['HTTP_REFERER']."',
				'".$_SERVER['REMOTE_ADDR']."'
			)";
	
	
	
	//mysql_query($cmd) or die();
	
	
if (! isset($_COOKIE["PHPSESSID"]) && ! isset($_GET["PHPSESSID"]))
{  
  $cookies_disabled = "1";
}
elseif (! isset($_COOKIE["PHPSESSID"]) && isset($_GET["PHPSESSID"]))
{  
  $cookies_disabled = "1";
}
else
{
  $cookie_disabled = "0";
}
	

if($cookie_disabled == "0")	
	{
	
	if(!in_array($_POST['id'],$_SESSION['radio_klik']))
		{
		array_push($_SESSION['radio_klik'],$_POST['id']);		
		
		$jumlahHIT = cekJumlahHit($_POST['id']);
		if($jumlahHIT < 20)
			{
			setStatistik($_POST['id']);
			rankingHarian($_POST['id']);
			}
		}
	}	
	//echo $_SERVER['HTTP_REFERER'];
	
}



?>