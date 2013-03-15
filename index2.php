<?php

header("location:index.php");
exit;

// ob_start();
// session_start();
include_once("inc/fungsi.php");
include_once("inc/config.php");

if ($_GET) {
	$def_radio = "-1";
	
	$id = $_GET['play'];
	if (is_numeric($id) && $id>0) {
		include_once("inc/config.php");
		
		$sql = "select * from ".tabel_radio." where radio_id='".$id."' and status='1'";
		$res = mysql_query($sql);
		$row = mysql_fetch_object($res);
		$nama = $row->nama;
		$mount = $row->mount;
		if (empty($nama) || empty($mount)) {
			$def_radio = "-1";
		} else {
			$def_radio = "$id";
		}
	}
	
	$def_radio = '<div id="id_radio" style="color:#000;">'.$def_radio.'</div>';
}


$rs=mysql_query("select * from cni_streamer where status='1' and id='1'");
$row=mysql_fetch_array($rs);
$cuplikan=putusKalimat($row[isi],300);
$idwelcome = $row[id];


$sqlMerapi2 = "SELECT * FROM ".cni_berita." where status_berita=1 ORDER BY berita_id DESC limit 3";
$resMerapi2 = mysql_query($sqlMerapi2);

$folderNya="images/banner/";
$sql_text = "select * from ".cni_banner." where status_banner='1' and letak_banner='3' group by banner_id DESC limit 4";

$sql=mysql_query($sql_text);


if(!empty($_GET['play'])) {

	$cmd100 =   "INSERT INTO statistik(id_radio,tgl,referer,ip) 
			VALUES(
				'".$_GET['play']."',
				'".date("Y-m-d h:i:s")."',
				'".$_SERVER['HTTP_REFERER']."',
				'".$_SERVER['REMOTE_ADDR']."'
			)";
	
	
	
	mysql_query($cmd100) or die();

}

?>

<html>
<head>
<title>JOGJA STREAMERS</title>

<?php

include "inc/header.php";
?>

<?php echo $def_radio; ?>

			<td width="60%" align="center" valign="top"  style="padding:0 15px 0 15px;">
						
					<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#fff" >	
						<tr>
							<td style="background:url(images/kotakkratas.jpg) top left no-repeat;width:6px;"></td>
							<td class="putih f-11" height="25" align="left" style="background:url(images/kotaktnatas.jpg) repeat-x;width"><b>RADIO STATION LIST</b></td>
							<td class="putih f-12" height="25" align="right" style="background:url(images/kotaktnatas.jpg) repeat-x;"><span id="kt">Semua</span></td>
							<td style="background:url(images/kotakknatas.jpg) top right no-repeat;width:6px;"></td>
						</tr>
						
					</table>
					<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#3A3A3A">
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
						<img src="images/spacer.gif" width="167" height="1">
						
						<?php 
						while($res=mysql_fetch_assoc($sql)){ 
							echo '<div style="padding-bottom:10px;">';
						
							if($res['tipe'] == 'application/x-shockwave-flash'  ) {
							
								echo '
									<a href="klik_banner.php?id='.$res[banner_id].'" target="_blank" >
										<embed class="pointer" name="flashfile" src="images/banner/'.$res['file_banner'].'" wmode="transparent" menu="false" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="160" height="67">
										</embed>
									</a>';
							
							}else {
								echo '<a onclick=window.open("klik_banner.php?id='.$res[banner_id].'"); class="pointer"><img border="0" src="'.$folderNya.$res[file_banner].'"></a>';
							}
							
							echo "</div>";
						} ?>
						
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