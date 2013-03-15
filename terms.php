<?

include_once("inc/config.php");
?>

	<table align="left" width="100%">
		<tr><td height="5" align="right"><a onclick="loadHome('slow');" class="orange f-11 pointer" title="close"><img src="images/panahturun.gif" alt="[close]"/></a></td></tr>
		<tr>
			
			<td align="left" class="orange f-15"><b>Terms & Condition</b></td>
			
		</tr>
		<tr>
			<td class="abu">
		<? $r = mysql_query("select * from cni_streamer where status = '1' and id = 4");
			while($d = mysql_fetch_assoc($r)) {
			echo $d[isi];
			}?>
			</td>
		</tr>
	</table>