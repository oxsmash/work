<?

include_once("inc/config.php");
	if (akses=='jogjastreamers') {
 $r = mysql_query("select * from cni_streamer where status = '1' and id = 2");
 }
 else{
  $r = mysql_query("select * from cni_streamer where status = '1' and id = 3");
 }
			while($d = mysql_fetch_assoc($r)) {

	echo $d['isi'];
			
			}?>
		












