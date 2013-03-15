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

$sql2 = "SELECT * FROM ".cni_berita." where status_berita=1 and berita_id='".$idku."'";
$res = mysql_query($sql2) or die("");
$row_berita=mysql_fetch_array($res);




?>

				
					
					<!-- isi dinamis -->
						<table width="100%" border="0" cellpadding="0" cellspacing="5">
							<tr><td align="left" colspan="2"><a onclick="loadpagehalaman('index_berita.php')" class="orange f-11 pointer">index berita</a></td>
							</tr>
							<tr><td colspan=2 class="hijau f-11"><?echo tglIndo($row_berita[tgl_berita],"h");?></td></tr>
							<tr><td colspan=2 height="5"><img src="images/spacer.gif"></td></tr>
							<tr><td colspan=2 align="center" class="putih f-13 "><b><?echo $row_berita[judul_berita];?></b></td></tr>
							<tr><td colspan=2 height="5"><img src="images/spacer.gif"></td></tr>
							<tr><td colspan=2 class="abu"><?echo $row_berita[isi_berita];?></td></tr>
						</table>
					<!-- isi dinamis -->
					
					
					
				