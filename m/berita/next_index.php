<?
	include"header.php";
?>

	<!--spacer-------------------------------------->
	<tr>
		<td width="320px" height="20px" valign="top" colspan="2" rowspan="0" >
			<a class="orange" href="index.php">
			<div class="font_12 right margin_3" style="background:; margin-right:10;">
				Index Berita
			</div>
			</a>
		</td>
	</tr>
	<!--middle / list of news ------------------------->
	<!--database-->
	<?
	//echo $_GET["ix"];
	$sqlview='	select * from '.cni_berita.'
				where status_berita=1
				and berita_id='.$_GET["ix"].'
				order by berita_id DESC';
	$resMerapi2 = mysql_query($sqlview);
	$rsMerapi2=mysql_fetch_assoc($resMerapi2)
	?>
	
	<tr>
		<td width="320px" height="" valign="top" colspan="2">
		<div class="green margin_15 font_14" style="margin-top:7;">
			<?=$rsMerapi2[judul_berita]?>
		</div>
		</td>
	</tr>
	<tr>
		<td width="320px" height="" valign="top" colspan="2">
			<div class="margin_15" style="margin-top:7;">
				<div class="font_14">
					<?=tglIndo($rsMerapi2[tgl_berita],"s_e2")?>
				</div>
				<div class="font_12">
					<?=$rsMerapi2[isi_berita]?>
				</div>
				
			</div>
		</td>
	</tr>
	
	<!--spacer-------------------------------------->
	<tr>
		<td width="320px" height="20px" valign="top" colspan="2" rowspan="0" >
			<a class="orange" href="index.php">
			<div class="font_12 right margin_3" style="background:; margin-right:10">
				Index Berita
			</div>
			</a>
		</td>
	</tr>
	
<?
	include"footer.php";
?>



