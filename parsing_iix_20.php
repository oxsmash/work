<?

/*****************************************************************************\

	IP Function ver 1.00 [2004/01/17]

	IP Function ver 1.01 [2004/01/18]

	by: Valens Riyadi (valens@valens.net

\*****************************************************************************/

	

function is_in_subnet($fipa,$fips,$fipb){ //fipa = IP A ;  fips = subnet of IP A ; fipb = IP B

  return ( (ip2integer($fipb) < ip2integer(get_network_ip($fipa,$fips))) OR (ip2integer($fipb) > ip2integer(get_broadcast_ip($fipa,$fips))) )? false : true;

}



function ip2integer($fip) {

	$fipx = split('\.', $fip);

	return $fipx[3] * pow(2,0) + $fipx[2] * pow(2,8) + $fipx[1] * pow(2,16)  + $fipx[0] * pow(2,24) ;

}



function integer2ip($fip) {

	$fip1 = floor($fip/(pow(2,24))); $sisa1 = fmod($fip,(pow(2,24)));

	$fip2 = floor($sisa1/(pow(2,16))); $sisa2 = fmod($sisa1,(pow(2,16)));

	$fip3 = floor($sisa2/(pow(2,8)));

	$fip4 = fmod($sisa2,(pow(2,8)));

	return $fip1 . "." . $fip2 . "." . $fip3 . "." . $fip4 ;

}



function get_network_ip($fipa,$fipb) {	// $fipa = ip address ; $fipb = subnet

	$fipx = ip2integer($fipa);

	$fipy = number_of_ip($fipb);

	return integer2ip($fipx-(fmod($fipx,$fipy)));

}



function get_broadcast_ip($fipa,$fipb) { // $fipa = ip address ; $fipb = subnet

	$fipx = ip2integer($fipa);

	$fipy = number_of_ip($fipb);

	return integer2ip($fipx + ($fipy - fmod($fipx,$fipy)) - 1);

}



function number_of_ip($fips){

	// $fips = subnet mask

	return pow(2,(32 - $fips));

}



function is_valid_ip($fip){

	// $fip = ip

	$fip = trim($fip);

	$fipx = split('\.', $fip);

	$iptmp = str_replace(".","", $fip);

	$iptmp = 0 + $iptmp;

	//if (is_int($iptmp) == false) return false;

	for ($ipx=0 ; $ipx<4 ; $ipx++){

		$fipx[$ipx] = 0 + $fipx[$ipx];

		if (is_int($fipx[$ipx]) == false) return false;

		if ($fipx[$ipx] < 0 OR $fipx[$ipx] > 255) return false;

		if ($ipx != 0) {

			$ipj .= '.' . $fipx[$ipx];

		} else {

			$ipj = $fipx[$ipx];

		}

	}

	return ($ipj == $fip) ? true : false;

}



function is_valid_subnet($fis){

	// $fis = subnet

	$fis = trim($fis);

	$fisx = 0 + $fis;

	if (is_int($fisx) == false) return false;

	if ($fisx < 0 OR $fisx > 32) return false;

	return ($fisx == $fis) ? true : false;

}



/*****************************************************************************\

	end of IP Function

\*****************************************************************************/



$nf = "http://ixp.mikrotik.co.id/download/nice.rsc?x=".rand(0,10000);



$c = fopen($nf, "r");

while ($line=fgets($c,1000)) { $alltext.=$line;}

fclose ($c);



$strkey = "nice\"]";

$pos1 = strpos($alltext,$strkey);

$pos1 = $pos1 + strlen($strkey);



$newtext = substr($alltext,$pos1);



$alltext = trim($newtext);



//echo $alltext;



$pt = split("\n", $alltext);

$jml = count($pt);





$subnetcek = "20";



//echo $jml;

$a = 0;

$b = 0;

$c = 0;

for ($i=0; $i < $jml; $i++){

		$xpos1 = strpos($pt[$i],"\"");

		$xpos2 = strpos($pt[$i],"\"", $xpos1 + 1);

		$ipnsn = trim(substr($pt[$i],$xpos1+1,($xpos2-$xpos1-1)));

		//echo "<br>" . $ipnsn;

		$posx = strpos($ipnsn,"/");

		$xip = substr($ipnsn,0,$posx);

		$xsn = substr($ipnsn , $posx+1 , strlen($ipnsn) - $posx - 1 );

		//echo " - " . $xip;

		//echo " - " . $xsn;

			$ip24[$a] = $xip;

			$sn24[$a] = $xsn;

			$ip24int[$a] = ip2integer($xip);

			$a++;

}



//echo $a;



echo "\n\nINSERT DATA TO MYSQL\n\n";



//$host = "202.65.113.114";

$host = "localhost";
$user = "chijog09_jstream";
$pass = "dbstream2007";
$db = "chijog09_jogstream";



function db_con($hostname, $username, $password, $dbnames) {

	$sock = mysql_connect($hostname, $username, $password) or die("Cannot Connect to MySQL Server!!");

	mysql_select_db($dbnames, $sock) or die("Cannot Find The Database!!!");

	return $sock;

}



$sock = db_con($host, $user, $pass, $db);


if($a > 100)
	{
	$cmd = "delete from tbiixjkt";
	
	$res = mysql_query($cmd, $sock) or die("Cannot execute query($cmd)");
	
	$cmd = "OPTIMIZE TABLE tbiixjkt";
	
	$res = mysql_query($cmd, $sock) or die("Cannot execute query($cmd)");
	}


for ($i=0; $i < $a; $i++){

  //$tulis .= "add list=nice address=\"" . $qip24[$i] . "/" . $qsn24[$i] . "\"\n";

	$ipinst = $ip24[$i];

	$sninst = $sn24[$i];

  $numawal = ip2integer(get_network_ip($ipinst, $sninst));

  $numakhir = ip2integer(get_broadcast_ip($ipinst, $sninst));

	if($numawal > 0 && $ipinst!="")
		{
		$cmd = "INSERT INTO tbiixjkt (ip, subnet, numawal, numakhir) VALUES (\"$ipinst\",\"$sninst\",$numawal,$numakhir)";	
	
		$res = mysql_query($cmd, $sock) or die("Cannot execute query($cmd)");
		}

}



?>

