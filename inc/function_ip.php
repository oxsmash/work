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
?>