<tr>
		<td align="center">
			<table width="870" border="0" cellpadding="0" cellspacing="0" align="center">
				<tr>
					<td style="background:url(images/dot.gif) repeat-x">&nbsp;</td>
				</tr>
				
				<tr>
					<td align="center">
						<?php
							$sqlFooter = "SELECT * FROM ".tabel_banner." WHERE status_banner = '1' AND letak_banner = '2' LIMIT 1 ";
							
							$hsl = mysql_query($sqlFooter);
							while($brsFooter = mysql_fetch_array($hsl)) {
								if($brsFooter['tipe'] == 'application/x-shockwave-flash'  ) {
								
									echo '
										
										<a href="http://web-web/jogjastreamers/work_2009/klik_banner.php?id='.$brsFooter[banner_id].'" target="_blank" >
											<embed name="flashfile" src="http://web-web/jogjastreamers/work_2009/images/banner/'.$brsFooter['file_banner'].'" wmode="transparent" menu="false" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="673" height="94">
										
										</a>';
									
									
								
								}else {
									
									echo "<a onclick=window.open('klik_banner.php?id=".$brsFooter[banner_id]."'); class='pointer'><img border='0' src='images/banner/".$brsFooter['file_banner']."'></a>";
									
								}
							}
						
						?>
					</td>
				</tr>
				<tr>
					<td align="center" height="50">
						<span class="abu f-11">Copyright &copy; 2007. Jogja Streamers. All Rights Reserved. :: Powered by Citraweb Nusa Infomedia</span>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-7239425-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>