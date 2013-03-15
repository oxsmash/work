<?php @header("location: index.php");
exit;

// ob_start();
session_start();

include_once("inc/fungsi.php");
include_once("inc/config.php");
include_once('inc/function_ip.php');

$id = $_GET['id'];
$stereo = $_GET['stereo'];
if ($stereo!="1") $stereo = "0";
$server = "";

if (!isset($_SESSION["radioSession"])) {
	header("HTTP/1.0 404 Not Found");
	exit;
}

/*
// blacklist these user agent
$isOk = true;
$client = strtolower($_SERVER['HTTP_USER_AGENT']);
$blacklist = array(); // sebaiknya pake whitelist biar gampang
array_push($blacklist, "nsplayer"); // WMP
array_push($blacklist, "wmfsdk"); // WMP
array_push($blacklist, "winamp"); // Winamp
for ($i=0;$i<count($blacklist);$i++) {
	$ausg = stristr($client, $blacklist[$i]);
	if(strlen($ausg)>0) {
		$isOk = false;
		break;
	}
}
*/

if (is_numeric($id) && $id>0) {
	$conn2 = mysql_connect($host,$user,$passwordMySql);
	mysql_select_db("jogstream",$conn2);

	// determine server
	$sql = "select * from ".tabel_url." order by id";
	$res = mysql_query($sql,$conn2);
	$arrURL = array();
	while ($row = mysql_fetch_object($res)) {
		$arrURL[$row->area] = $row->url;
	}
	mysql_free_result($res);

	$ippengguna = $_SERVER['REMOTE_ADDR'];
	//$ippengguna = "1.1.1.1"; // internasional
	//$ippengguna = "202.155.0.10"; // jakarta
	//$ippengguna = "202.65.112.2"; // jogja
	//$ippengguna = "123.223.153.252";
	$ippengguna_integer = ip2integer($ippengguna);

	// default.... server amerika
	$server = $arrURL['international'];

	// pemilihan server jakarta
	$cmd = "select * from tbiixjkt where numawal<=$ippengguna_integer AND numakhir>=$ippengguna_integer";
	$resX = mysql_query($cmd,$conn2);
	if(mysql_num_rows($resX) > 0) {
		$server = $arrURL['jakarta'];
	}
	mysql_free_result($resX);

	// pemilihat server JOGJA
	$f = fopen('ip1.txt', "r");
	if(!$f) continue;
	while(!feof($f)) {
			$buff = trim(fgets($f, 1024));
			if(empty($buff)) continue;
			$arr_buf = explode("/", $buff);
			if(is_in_subnet($arr_buf[0], $arr_buf[1], $ippengguna)) {  
				$server = $arrURL['jogjakarta'];
				break 1;
			}
	}
	fclose($f);

	// get mount information		
	$cmdRadio = "SELECT r.*, k.kota FROM radio r, t_kota k WHERE r.status = 1 and r.radio_id = '".$id."' and r.id_kota = k.id_kota";
	$resR = mysql_query($cmdRadio,$conn2);
	$row = mysql_fetch_object($resR);
	$mount	= $row->mount;
	$isSupportStereo = $row->stereo;
	mysql_free_result($resR);
	
	mysql_close($conn2);

	if ($stereo=="1" && $isSupportStereo=="1") {
		$mount .= "stereo";
	}

	if (empty($mount)) {
		$mount = "zxa";
	}
	
	$fileName = $server.$mount;
	if(!$fdl=@fopen($fileName,'r')){
	    header("HTTP/1.0 404 Not Found");
	} else {
	    header("Cache-Control: ");// leave blank to avoid IE errors
	    header("Pragma: ");// leave blank to avoid IE errors
	    header("Content-type: application/octet-stream");
	    // header("Content-Disposition: attachment; filename=\"".$nama."\"");
	    // header("Content-length:".(string)(filesize($fileName)));
	    // sleep(1);
	    fpassthru($fdl);
	}
	
} else {
	header("HTTP/1.0 404 Not Found");
}

?>