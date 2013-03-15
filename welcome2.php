<?php

//ob_start();
//session_start();
include_once("inc/fungsi.php");
include_once("inc/config.php");

if(!empty($_GET['idku'])) {
	$idku = $_GET['idku'];
}else {
	$idku = '';
}

$sql3 = "SELECT * FROM ".cni_streamer." where status=1 and id='".$idku."'";
$res3 = mysql_query($sql3) or die("");
$row_berita=mysql_fetch_array($res3);


?>



		
					<table cellpadding="0" cellspacing="0" border="0" width="100%">
						<tr><td height="5" align="right"><a onclick="loadHome('slow');" class="orange f-11 pointer" title="close"><img src="images/panahturun.gif" alt="[close]"/></a></td></tr>
						<tr>
							
							<td align="left" class="orange f-15"><b>Welcome to JogjaStreamers</b></td>
							
						</tr>
						<tr>
							
							<td>
							<table width="100%" border="0" cellpadding="0" cellspacing="7" >
							<tr>
								<td  align="justify"  class="abu">
								<?=$row_berita[isi];?>
								</td>
							</tr>
							</table>
							</td>
							
						</tr>
						
					</table>
					
					
		
