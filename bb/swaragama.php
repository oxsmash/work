<?php
exit;
$id = 7;

// redirect jika bukan dari bb
$useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
if(!ereg("blackberry",$useragent)) {
	header("location:../index.php?play=7");
	exit;
}


include_once("../inc/fungsi.php");
include_once("../inc/config.php");

// server always in jogja
$cmdServer = "SELECT url FROM tb_url WHERE id='3'";
$resServer = mysql_query($cmdServer,$conn);
$rowServer = mysql_fetch_object($resServer);
$server	= $rowServer->url;

// get radio information
$cmdRadio = "SELECT r.*, k.kota FROM radio r, t_kota k WHERE r.status = 1 and r.radio_id = ".$id." and r.id_kota = k.id_kota";
$res = mysql_query($cmdRadio,$conn);
$row = mysql_fetch_object($res);
$radio	= $row->nama;
$kota	= $row->kota;
$mount	= $row->mount; //."bb";
$status_tambahan = $row->status_tambahan;

header("location:".$server.$mount);
// header("location:http://usa.jogjastreamers.com:7219/");
exit;

?>