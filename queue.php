<?php

if ($_POST) {
	include_once("inc/config.php");
	$isOk = false;
	$type = "rdm";
	// $addSql = " and last_played <= now() - interval 2 HOUR order by rand() ";
	$addSql = " order by rand() ";
	
	$sqlN = "select now() as skrg";
	$resN = mysql_query($sqlN);
	$rowN = mysql_fetch_object($resN);
	$time = $rowN->skrg;
	
	/* requested song played @hour
	$sqlN = "select UNIX_TIMESTAMP(now()) as second, now() as skrg, UNIX_TIMESTAMP(isi) as second2, isi from ".tabel_config." where kunci='next_song'";
	$resN = mysql_query($sqlN);
	$rowN = mysql_fetch_object($resN);
	$time = $rowN->skrg;
	$timeSec = $rowN->second; // now
	$time2 = $rowN->isi;
	$timeSec2 = $rowN->second2; // next request
	
	if($timeSec>=$timeSec2) {
	*/
		$sql4 = "select song_id from ".tabel_aq_request_candidate." order by count desc limit 1";
		$res4 = mysql_query($sql4);
		$num4 = mysql_num_rows($res4);
		if($num4>0) {
			$row4 = mysql_fetch_object($res4);
			$id4 = $row4->song_id;
			$type = "req";
			$addSql = " and id='".$id4."' ";
		}
	/*
	}
	*/
	
	$sql = "select id, file from ".tabel_aq_songlist." where status='1' ".$addSql." limit 1";
	$res = mysql_query($sql);
	$row = mysql_fetch_object($res);
	$id = $row->id;
	$file = $row->file;
	
	if ($id>0) {
		$sql2 = "insert into ".tabel_aq_history."(type, song_id, date_played, status) values ('".$type."', '".$id."', '".$time."', '1')";
		mysql_query($sql2);
	
		$sql3 = "update ".tabel_aq_songlist." set last_played= '".$time."', count_played = count_played + 1 where id='".$id."'";
		mysql_query($sql3);	
	}
	
	if ($type == "req") {
		// $sql5 = "update ".tabel_config." set isi= now() + interval 1 HOUR where kunci='next_song'";
		// mysql_query($sql5);
	
		$sql6 = "truncate table ".tabel_aq_request_candidate;
		mysql_query($sql6);
	}
	
	echo $file;
	exit;
}
?>