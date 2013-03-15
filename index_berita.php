<?php
//ob_start();
//session_start();
include_once("inc/fungsi.php");
include_once("inc/config.php");

$sqlview = "SELECT * FROM ".cni_berita." where status_berita=1 ORDER BY berita_id DESC";

$link=$PHP_SELF."";
$PageSize = 10;
$Jenis = "berita";
include "inc/barHalaman2.php";

?>

<table cellpadding="0" cellspacing="7" border="0" width="100%">
<tr><td colspan=2 height="5" align="right"></td></tr>
<tr>						
	<td colspan=2 align="left" class="orange f-15">&nbsp;<b>Daftar Berita</b><br><br></td>
</tr>
<tr>
	<td colspan=2 class="putih" style="border-bottom:1px dashed #fff;"><?echo $bar;?></td>
</tr>
<?
	$resMerapi2 = mysql_query($sqlview);
	while($rsMerapi2=mysql_fetch_assoc($resMerapi2)){?>
<tr>
	<td valign="top" class="hijau"><?=tglIndo($rsMerapi2[tgl_berita],"s")?></td>
	<td><a onclick="loadBeritaDetail('<?php echo $rsMerapi2[berita_id]; ?>');" class="putih pointer"><?=$rsMerapi2[judul_berita]?></a></td>
</tr>
<?}?>

</table>