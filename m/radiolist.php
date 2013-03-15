<?
include_once("../inc/fungsi.php");
include_once("../inc/config.php");
include_once('../inc/function_ip.php');
	
		/*
		// menyiapkan pembungkus server
		if ($_SERVER['SERVER_NAME']=="web-web") {
			$arrSelf = pathinfo($_SERVER['PHP_SELF']);
			$server = "http://".$_SERVER['SERVER_NAME'].$arrSelf['dirname']."/";
		} else {
			$server = "http://".$_SERVER['SERVER_NAME']."/";
		}
		$mount = "radio_listen.php?id=".$id;
		*/
		
		// determine server
		$sql = "select * from ".tabel_url." order by id";
		$res = mysql_query($sql,$conn);
		$arrURL = array();
		while ($row = mysql_fetch_object($res)) {
			$arrURL[$row->area] = $row->url;
		}
		mysql_free_result($res);

header ("Content-type: application/xml");
echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
echo '<playlist>
        <updated>'.date("Y-m-d").'T'.date('H:i:s').'</updated>
        <server>'.$arrURL['international'].'</server>
        <list>';

		
	$cmd = "SELECT * FROM radio WHERE status = '1' ORDER BY rand()";	
	$res = mysql_query($cmd);
	while($brs = mysql_fetch_array($res)){
		echo '<radio>
                        <fullname>'.$brs[nama].'</fullname>
                        <mount>'.$brs[mount].'</mount>
                        <id>'.$brs[radio_id].'</id>
                </radio>';
		
	}
		
		
echo ' </list>
</playlist>';		



?>