<?php

header("location:index.php");
exit;

//ob_start();
//session_start();
include_once("inc/fungsi.php");
include_once("inc/config.php");


$rs=mysql_query("select * from cni_streamer where status='1' and id='1'");
$row=mysql_fetch_array($rs);
$cuplikan=putusKalimat($row[isi],300);
$idwelcome = $row[id];


$sqlMerapi2 = "SELECT * FROM ".cni_berita." where status_berita=1 ORDER BY berita_id DESC limit 3";
$resMerapi2 = mysql_query($sqlMerapi2);

$folderNya="images/banner/";
$sql_text = "select * from ".cni_banner." where status_banner='1' and letak_banner='3' group by banner_id DESC limit 4";
$sql=mysql_query($sql_text);

?>

<html>
<head>
<title>JOGJA STREAMERS</title>

<?php

include "inc/header.php";
?>

			<td width="60%" align="center" valign="top"  style="padding:0 15px 0 15px;">
						
					<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#3A3A3A">	
						<tr>
							<td style="background:url(images/kotakkratas.jpg) top left no-repeat;width:6px;"></td>
							<td class="putih f-11" height="25" align="left" style="background:url(images/kotaktnatas.jpg) repeat-x;"><b>RADIO STATION LIST</b></td>
							<td class="putih f-12" height="25" align="right" style="background:url(images/kotaktnatas.jpg) repeat-x;">Jogjakarta</td>
							<td style="background:url(images/kotakknatas.jpg) top right no-repeat;width:6px;"></td>
						</tr>
						<tr>		
							<td colspan="4" style="border-left:1px solid #616161;border-right:1px solid #616161;">		
								<div id="radiobox" >
									<div id="radioboxall" ></div>
									<div id="radioboxscroll" style="height:140px;overflow:auto;display:none;"></div>
								</div>
														
							</td>
						</tr>
						<tr>
							<td style="background:url(images/kotakkrbwh.jpg) top left no-repeat;width:6px;height:11px;"></td>
							<td colspan="2" style="border-bottom:1px solid #616161;height:11px;"></td>
							<td style="background:url(images/kotakknbwh.jpg) top right no-repeat;width:5px;"></td>
						</tr>
						</table>
						<br>
						<div id="loading" style="display:none;"><img src="images/blue-loading.gif"></div>
						<div id="hal" style="display:block;"></div>
					</td>
					<td width="5%" align="right" valign="top">
						<img src="images/spacer.gif" width="167" height="1"><br>
						<?php 
						while($res=mysql_fetch_assoc($sql)){ 
							
						?>
							
							<a href="klik_banner.php?id=<?=$res[banner_id]?>" target="_blank" ><img border="0" src="<?=($folderNya.$res[file_banner])?>"></a>
						
						<?php } ?>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td align="center" colspan="3" >
						
					</td>
				</tr>
			</table><br>
		</td>
	</tr>

<?php

include "inc/footer.php";
?>