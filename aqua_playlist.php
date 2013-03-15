<?php

/* not used */
header("location:index.php");
exit;

function milli2hour($milliseconds) {
	$jam = floor($milliseconds / (1000*60*60));
	$menit = floor(($milliseconds % (1000*60*60)) / (1000*60));
	$detik = floor((($milliseconds % (1000*60*60)) % (1000*60)) / 1000);	
	if ($jam<10) $jam = "0".$jam;
	if ($menit<10) $menit = "0".$menit;
	if ($detik<10) $detik = "0".$detik;	
	return $jam.":".$menit.":".$detik;
}

$limitPlayed = 1;
$limitNext = 10;

$host = "localhost";
$user = "root";
$pass = "";
$db   = "samdb";

$con = mysql_connect($host, $user, $pass);
mysql_select_db($db, $con);

// get current n already played
$i = 0;
$arrPlayedSong = "";
$currentTime = "";
$sql = "SELECT songlist.*,
			historylist.listeners as listeners, 
			historylist.requestID as requestID,
			historylist.date_played as starttime
		FROM historylist, songlist
		WHERE (historylist.songID = songlist.ID)
		AND (songlist.songtype='S')
		ORDER BY historylist.date_played DESC limit 0, ".$limitPlayed;
$res = mysql_query($sql, $con);
while ($row = mysql_fetch_object($res)) {
	$startTime = str_replace(" ", "T", $row->starttime);
	// $duration = milli2hour($row->duration);
	$duration = $row->duration;
	$artist = $row->artist;
	$title = $row->title;
	$info = $row->info;
	if ($i==0) {
		$updated1 = strtotime($row->date_played);
		$currentTime = strtotime($row->starttime);
	}
	$arrPlayedSong =
	'<track>
		<startTime>'.$startTime.'</startTime>
		<duration>'.$duration.'</duration>
		<artist>'.$artist.'</artist>
		<title>'.$title.'</title>
		<info>'.$info.'</info>
	</track>'.$arrPlayedSong;
	$i++;
}

// get next song
$arrNextSong = "";
$sql = "SELECT songlist.*,
			queuelist.requestID as requestID
		FROM queuelist,songlist
		WHERE (queuelist.songID = songlist.ID)
		AND (songlist.songtype='S') 
		AND (songlist.artist <> '')
		ORDER BY queuelist.sortID ASC limit 0, ".$limitNext;
$res = mysql_query($sql, $con);
while ($row = mysql_fetch_object($res)) {
	$currentTime += $row->duration/1000;	
	$startTime = date("Y-m-d H:i:s", $currentTime);
	$startTime = str_replace(" ", "T", $startTime);
	// $duration = milli2hour($row->duration);
	$duration = $row->duration;
	$artist = $row->artist;
	$title = $row->title;
	$info = $row->info;
	$arrNextSong .=
	'<track>
		<startTime>'.$startTime.'</startTime>
		<duration>'.$duration.'</duration>
		<artist>'.$artist.'</artist>
		<title>'.$title.'</title>
		<info>'.$info.'</info>
	</track>';
}

$updated2 = time(); // now. NOTE: ada bugs di beberapa versi apache (g tau yg mana) pada fungsi time(). Bugs nya adalah membuat waktu maju satu jam. Jadi kalo skrg jam 1, yg tampil adlh jam 2.

$xml = 
	'<?xml version="1.0" encoding="ISO-8859-1"?>
	 <playlist station="aquarius">
		<updated1>'.$updated1.'</updated1>
		<updated2>'.$updated2.'</updated2>
		<list>
			'.$arrPlayedSong.'
			'.$arrNextSong.'
		</list>
	 </playlist>';

header ("content-type: text/xml");
echo $xml;

?>