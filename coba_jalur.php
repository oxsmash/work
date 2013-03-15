<?

function ip2integer($fip) {
	$fipx = split('\.', $fip);
	return $fipx[3] * pow(2,0) + $fipx[2] * pow(2,8) + $fipx[1] * pow(2,16)  + $fipx[0] * pow(2,24) ;
}

$ippengguna = "212.182.212.54";

$ippengguna_integer = ip2integer($ippengguna);

$cmd = "select * from tbiixjkt where numawal<=$ippengguna_integer AND numakhir>=$ippengguna_integer";

echo $cmd;
?>