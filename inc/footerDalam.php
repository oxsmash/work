						</td>
					</tr>
					</table>
				</td>
				</tr>
				<tr><!--footer-->
					<td background="images/bd_kiri_tengah.gif"><img src="images/bd_kiri_tengah.gif"></td>
					<td valign="bottom"><img src="images/mp3pro.gif"><img src="images/wm9compatible.gif"><img src="images/winamp.gif"></td>
				</tr>				
				</table>
			</td>
			<td valign="top"><!--banner kanan-->
				<table border="0" width=160 height=400>
				<tr>
					<td valign=top>
					<table cellpadding="0" border="0">
					<?
					$folderNya="images/banner/";
					$sql=mysql_query("select * from ".cni_banner." where status_banner='1' and letak_banner='1' group by banner_id DESC limit 5");
					while($res=mysql_fetch_assoc($sql)){ ?>
					<tr>
						<td align="center">
						<a href="klik_banner.php?id=<?=$res[banner_id]?>" target="_blank"><img src="<?=($folderNya.$res[file_banner])?>"></a>
						</td>
					</tr>
					<tr>
						<td height="7"><img src="images/spacer.gif" width="1" height="7"></td>
					</tr>
					<?}?>
					<tr><td style="padding-bottom:10px;"><img src="images/spacer.gif" width="1" height="7"></td></tr>
					</table>
					</td>
				</tr>
				</table>
			</td>
			<td background="images/bd_knn_tengah.gif" valign="top"><img src="images/bd_knn_tengah3.gif"></td>
		</tr>
		</table>
	</td>
	</tr>
	<tr>
	<td width="100%">
		<table cellpadding="0" cellspacing="0" width=100% border="0" bgcolor="ebebeb">
		<tr>
		<td widht="24" height="21"><img src="images/bd_kiri_down2.gif" widht="24" height="21"></td>
		<td background="images/footer.gif" width=100%><img src="images/footer.gif"></td>
		<td widht="11" height="21"><img src="images/bd_knn_down.gif" widht="11" height="21"></td>
		</tr>
		</table>
	</td>		
	</tr>
	</table>
</td>
</tr>
<tr>

<td class="copy">Copyright &#169; 2007. Jogja Streamers. All Rights reserved.</td>

</tr>
</table>
</center>
</body>
</html>
