<?php

include_once("header-m.php");

$cKode=utk5Digit(rand(1,32768));
$crypt = new MD5Crypt;
$hKode = $crypt->Encrypt($cKode,key_generator);

if (!isset($_SESSION["radioSession"])) {
	$_SESSION['radioSession'] = $hKode;
}

$radioUI = '';
$sql = "select radio_id, nama from ".tabel_radio." where status='1' ORDER BY rand() DESC";
$res = mysql_query($sql, $conn);
while($row=mysql_fetch_object($res)) {
	$radioUI .= '<li class="putih padlist f-12"><a href="play.php?id='.$row->radio_id.'">'.$row->nama.'</a></li>';
}
if(strlen($radioUI)>0) {
	$radioUI = '<ul>'.$radioUI.'</ul>';
}

echo $radioUI;
include_once("footer-m.php");
?>