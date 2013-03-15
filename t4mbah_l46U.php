<?php

header("location:index.php");
exit;

if ($_POST) {
	include_once("inc/config.php");
	
	$file = htmlspecialchars(urldecode($_POST['file']));
	$artist = htmlspecialchars(urldecode($_POST['artist']));
	$title = htmlspecialchars(urldecode($_POST['title']));
	$duration = htmlspecialchars(urldecode($_POST['duration']));
	$comment = htmlspecialchars(urldecode($_POST['comment']));
		
	$sql = "insert into aqua_songlist(file, artist, title, duration, comment, count_played, status, tgl_buat) values ('" . $file . "','" . $artist . "','" . $title . "','" . $duration . "','" . $comment . "', '0', '1', now())";
	mysql_query($sql) or die(mysql_error());
	echo "Data file ".$file." berhasil disimpan.";
	exit;
}
?>