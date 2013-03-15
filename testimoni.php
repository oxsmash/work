<?php

//ob_start();
//session_start();
include_once("inc/fungsi.php");
include_once("inc/config.php");

$sqlview="Select * from ".tabel_saksi." where status_kesaksian=1 order by kesaksian_id DESC";


$link=$PHP_SELF."";
$PageSize = 5;
$Jenis = "testimoni";
include "inc/barHalaman2.php";

?>

					
					<table cellpadding="0" cellspacing="0" border="0" width="100%">
						<tr>
							
							<td align="left" class="orange f-15">&nbsp;<b>What They Say</b><br><br></td>
							
						</tr>
						<tr>
							<td class="putih"><?echo $bar;?></td>
						</tr>
						<?php
							$result = mysql_query($sqlview) or die(mysql_error());
							$k=0;
							$z=0;
							while($barisSaksi = mysql_fetch_assoc($result)) {
							$k=$k+1;
							$z=$k+(($PageNo - 1)*$PageSize);
						?>
						<tr>
							<td class="putih" bgcolor="#5E5E5E" height="30"><?php echo "&nbsp;".$z.".&nbsp;&nbsp;".$barisSaksi['judul'];?></td>
							
						</tr>
						<tr>
							<td class="abu" style="padding:10px 0 10px 0px;">
								<p><?php echo html_entity_decode($barisSaksi['isi']);?></p>
								<br>
								<span><?php echo $barisSaksi['nama'];?> (<?php echo $barisSaksi['umur'];?>)</span><br>
								<span><?php echo tglIndo($barisSaksi['tgl_kesaksian'],"h");?></span>
							</td>
							
						</tr>
						
						<?php } ?>
						<tr>
							<td class="putih"><?echo $bar;?></td>
						</tr>
						
						<tr>
							<td style="border-top:1px dashed #fff;">
									<iframe width="100%" height="650" src="editor.php" frameborder="0"></iframe>	
									
										
							</td>
						</tr>
					</table>
					
					
					