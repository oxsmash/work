<?php
include("inc/config.php");
include("inc/fungsi.php");

if ($_POST['action']=="listener_remove") {
	/*
	$file = "";
	$pos = strpos($_POST['mount'],"?s=");
	if($pos===false) {
	} else {
		$file = substr($_POST['mount'],$pos+3);
	}
	//*/

	//$sql = "insert into tb_durasi(mount, duration, post_data,tgl) values('".mysql_real_escape_string($_POST['mount'])."','".$_POST['duration']."','".mysql_real_escape_string(print_r($_POST, true))."',now())";
	//mysql_query($sql);
	
	setDurasi(mysql_real_escape_string($_POST['mount']),$_POST['duration'],print_r($_POST, true));
}
?>