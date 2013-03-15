<?php

session_start();
include_once("../inc/fungsi.php");
include_once("../inc/config.php");

// $agent = $_SERVER['HTTP_USER_AGENT'];
// if($agent!="bb_js") exit;

$cKode=utk5Digit(rand(1,32768));
$crypt = new MD5Crypt;
$hKode = $crypt->Encrypt($cKode,key_generator);

if (!isset($_SESSION["radioSession"])) {
	$_SESSION['radioSession'] = $hKode;
}

$radioXML = '';

// server always in usa
$cmdServer = "SELECT url FROM tb_url WHERE id='1'";
$resServer = mysql_query($cmdServer,$conn);
$rowServer = mysql_fetch_object($resServer);
$server	= $rowServer->url;

// $server = "http://69.64.33.149";

// get radio information
$cmdRadio = "SELECT r.nama, r.mount, k.kota, r.radio_id FROM radio r, t_kota k WHERE r.status = 1 and r.id_kota = k.id_kota order by r.nama asc";
$res = mysql_query($cmdRadio,$conn);
while ($row = mysql_fetch_object($res)) {
	$rad_id	= trim($row->radio_id);
	$radio	= trim($row->nama);
	$kota	= trim($row->kota);
	$mount	= trim($row->mount."?f=m");
	// $mount  = ":8160/";
	$radioXML.=
		'<radio>
			<fullname>'.$radio.'</fullname>
			<mount>'.$mount.'</mount>
			<id>'.$rad_id.'</id>
		</radio>';
}

$updated = date("Y-m-d")."T".date("H:i:s");

$radioXML =
	'<?xml version="1.0" encoding="ISO-8859-1"?>
	<playlist>
        <updated>'.$updated.'</updated>
        <server>'.$server.'</server>
        <list>'.$radioXML.'</list>'.
	'</playlist>';

header("Content-Type: application/xml");
echo $radioXML;
exit;
?>