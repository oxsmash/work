<?
	include"header.php";
?>
	
	<!--middle / list of news ------------------------->
	<!--database-->
	<?
	$sqlview = "SELECT * FROM ".cni_berita." where status_berita=1 ORDER BY berita_id DESC";
	$link=$PHP_SELF."";
	$PageSize = 10;
	$Jenis = "berita";
	include "inc/barHalaman2.php";
	?>
	<tr>
		<td width="320px" height="20px" valign="top" colspan="2">
			<div>
			<?//echo $bar;?>
			</div>
		</td>
	</tr>
	<?
	$resMerapi2 = mysql_query($sqlview);
	while($rsMerapi2=mysql_fetch_assoc($resMerapi2)){
	?>
	<tr>
		<!--no-->
		<td width="60px" height="40px">
			<div class="font_12 a_center" id="hs_container" style="color:#f6fec2;">
				<?=tglIndo($rsMerapi2[tgl_berita],"s_e2")?>
			</div>
		</td>
		<!--isi berita-->
		<td width="260">
			<a class="white" href="next_index.php?ix=<?=$rsMerapi2[berita_id]?>">
			<div class="font_14 margin_3">
				<?=$rsMerapi2[judul_berita]?>
			</div>
			</a>
		</td>
	</tr>
	<?
	}
	?>
	<!--spacer-------------------------------------->
	<tr>
		<td width="320px" height="4px" valign="top" colspan="2" rowspan="0" >
		<div class="" style="background:;">
			&nbsp;
		</div>
		</td>
	</tr>
	
<?
	include"footer.php";
?>



