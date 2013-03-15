<?php

if ($_POST) {
	include_once("inc/config.php");
	
	$sql = "SELECT aqua_songlist.*,
				aqua_history.date_played,
				aqua_history.date_played as starttime
			FROM aqua_history, aqua_songlist
			WHERE (aqua_history.song_id = aqua_songlist.id)
			ORDER BY aqua_history.date_played DESC limit 0, 1";
	$res = mysql_query($sql);
	$num = mysql_num_rows($res);
	if ($num==1) {
		$row = mysql_fetch_object($res);
		$startTime = strtotime($row->date_played);
		$duration = $row->duration;
		$artist = $row->artist;
		$title = $row->title;
		$info = $row->comment;
		
		// calculate next request
		$curTime = time(); // - 3600; // check it whether date on server is 1 hour fast
		$timeLeft = $startTime+round($duration/1000) - $curTime; // dalam detik

		if($timeLeft>0) {
			$delay = $timeLeft*1000; // delay in milliseconds
		} else if ($timeLeft==0) {
			$delay = 1000;
		} else {
			$startTime = "";
			$duration = "";
			$artist = "radio";
			$title = "is";
			$info = "offline";
			$delay = -1;
		}
	} else {
		$startTime = "";
		$duration = "";
		$artist = "radio";
		$title = "is";
		$info = "offline";
		$delay = -1;
	}
	
	$txt_info = $artist." - ".$title; //." - ".$info;
	$txt_info = urlencode($txt_info);

	print "txt_info=".$txt_info."&txt_delay=".$delay;
	exit;
}

?>