<?php

header("location:index.php");
exit;

// ob_start();
session_start();
include_once("inc/fungsi.php");
include_once("inc/config.php");

if(!empty($_GET['idku'])) {
	$idku = $_GET['idku'];
}else {
	$idku = '';
}

$sql2 = "SELECT * FROM ".cni_berita." where status_berita=1 and berita_id='".$idku."'";
$res = mysql_query($sql2) or die("");
$row_berita=mysql_fetch_array($res);

$folderNya="images/banner/";
$sql_text = "select * from ".cni_banner." where status_banner='1' and letak_banner='1' group by banner_id DESC limit 4";
$sql=mysql_query($sql_text);


?>

<html>
<head>
<title>JOGJA STREAMERS</title>

<?php

include "inc/header.php";
?>

				<td width="60%" align="center" valign="top"  style="padding:0 15px 0 15px;">
					
					<!-- isi dinamis -->
						<table width="100%" border="0" cellpadding="0" cellspacing="5">
							<tr><td height="5"><img src="images/spacer.gif"></td></tr>
							<tr><td class="hijau f-11"><?echo tglIndo($row_berita[tgl_berita],"h");?></td></tr>
							<tr><td height="5"><img src="images/spacer.gif"></td></tr>
							<tr><td align="center" class="putih f-13 "><b><?echo $row_berita[judul_berita];?></b></td></tr>
							<tr><td height="5"><img src="images/spacer.gif"></td></tr>
							<tr><td class="abu"><?echo $row_berita[isi_berita];?></td></tr>
						</table>
					<!-- isi dinamis -->
					
					
					
					</td>
					<td width="5%" align="right" valign="top">
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
				
			</table><br>
		</td>
	</tr>





<?php

include "inc/footer.php";
?>