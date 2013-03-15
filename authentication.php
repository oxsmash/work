<?php

include("inc/config.php");

$modeAuth = "xfile";

if($modeAuth=="file") {
	$file = "temp/".$_POST['ip']."_".str_replace("/","",$_POST['mount']).".txt";
	$filebaru = "temp/".$_POST['port']."_".$_POST['client']."_".str_replace("/","",$_POST['mount']).".on";
}

if ($_POST['action']=="listener_add") {

	$hasil = 0;
	
	if($modeAuth=="file") {
		if (file_exists($file)) $hasil = unlink($file);
	} else {
		$file = "";
		
		// mysql_query("insert into tes set isi='".print_r($_SERVER,true)."--".print_r($_POST,true)."'");
		
		// check apakah dari iphone/bukan
		if (ereg("jogjastreamers/", $_POST['agent'])) { // dari iphone
			$hasil = 1;
		} else if (ereg("Android", $_POST['agent'])) { // dari android
			$hasil = 1;
		} else if(ereg("f=m", $_POST['mount'])) { // generic mobile
			$hasil = 1;
		} else {
			$pos = strpos($_POST['mount'],"?s=");
			if($pos===false) {
			} else {
				$file = substr($_POST['mount'],$pos+3);
			}
			
			$sql = "select id, now()-interval 2 minute as tgl from tb_zpendengar where session_id='".$file."' limit 1";
			$res = mysql_query($sql);
			
			if(mysql_num_rows($res)>0) {
				$row = mysql_fetch_object($res);
				$tgl = $row->tgl;
				$sql2 = "delete from tb_zpendengar where tgl<'".$tgl."'";
				mysql_query($sql2);
				$hasil = 1;
			}
		}
		
		/*
		$sql3x = "insert into tb_zpendengar set session_id=2___".$file."";
		$sql3 = "insert into tb_zpendengar set session_id='".$sql3x."'";
		mysql_query($sql3);
		$hasil = 1;
		//*/
	}
	header('icecast-auth-user: '.$hasil);
}
/*
else if ($_POST['action']=="listener_remove") {
	//$hase = unlink($filebaru);
	
	$sql = "insert into tb_durasi(mount, duration, post_data,tgl) values('".mysql_real_escape_string($_POST['mount'])."','".$_POST['duration']."','".mysql_real_escape_string(print_r($_POST, true))."',now())";
	mysql_query($sql);

	//unlink($filebaru);
}
*/
?>