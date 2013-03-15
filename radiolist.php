<?php

//ob_start();
//session_start();
include_once("inc/fungsi.php");
include_once("inc/config.php");

$cmdRadio = "";
$tmp ="";
if(!empty($_GET['id'])) {
	$tmp = " AND id_kota = '".$_GET['id']."' ";
	$cmdRadio = "SELECT * FROM radio WHERE status = 1 ".$tmp." ORDER BY rand() DESC ";
}else {
	$tmp ="";
	$cmdRadio = "SELECT r.*, k.kota FROM radio r, t_kota k WHERE r.status = 1 AND r.id_kota = k.id_kota ORDER BY rand() DESC ";
}

$res = mysql_query($cmdRadio,$conn);

$jml_row = mysql_num_rows($res);


?>

		
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
					
						<?php
							
							$i = 0;
							$j = 1;
							
							while($row = mysql_fetch_array($res)) {
						?>
							
							<td width="50%">
								<table align="center" border="0" cellspacing="4" width="100%">
									<tr>
										<td rowspan="3" width="110">
											<div style="position:relative;">
												<?php
													if($row[ 'flag_24jam'.date("w") ]=="1") {
												?>
													<div align="right" style="position:absolute;top:-6px;right:-6px;z-index:100;height:25px;width:110px;"><img src="images/24jam_r.png"/></div>
												<?php } ?>
												<img style="z-index:50;border-color:#616161;" border="1" src="pic.php?id=<?php echo $row['radio_id'];?>"/>												
											</div>
										</td>
									</tr>
									<tr>
										<td >
											<?php
												/* if($row['stereo']=="1") {
													echo '<a class="pointer" onClick="changeRadio(\''.$row['radio_id'].'\',\'0\');stat(\''.$row['radio_id'].'\');"><img src="images/listen_mono.jpg" border="0"></a>';
													echo '<br/>';
													echo '<a class="pointer" onClick="changeRadio(\''.$row['radio_id'].'\',\'1\');stat(\''.$row['radio_id'].'\');"><img src="images/listen_stereo.jpg" border="0"></a>';
												} else {
													echo '<a class="pointer" onClick="changeRadio(\''.$row['radio_id'].'\',\'0\');stat(\''.$row['radio_id'].'\');"><img src="images/tbl.jpg" border="0"></a>';
												} */
												
												echo '<table border="0" cellpadding="2" cellspacing="0"><tr>';
												if($row['shoutcast']=="1") {
													echo '<td align="left" valign="middle" width="1">';
													echo '<a class="pointer" onClick="changeRadio(\''.$row['radio_id'].'\',\'1\');stat(\''.$row['radio_id'].'\');"><img src="images/radio_stereo2.png" border="0" width="41" height="19" /></a>';
													echo '</td>';
												}
												else{												
														echo '<td align="left" valign="middle" width="1">';
														echo '<a class="pointer" onClick="changeRadio(\''.$row['radio_id'].'\',\'0\');stat(\''.$row['radio_id'].'\');"><img src="images/radio_mono2.png" border="0" width="41" height="19" /></a>';
														echo '</td>';
														if($row['stereo']=="1") {
															echo '<td align="left" valign="middle" width="1">';
															echo '<a class="pointer" onClick="changeRadio(\''.$row['radio_id'].'\',\'1\');stat(\''.$row['radio_id'].'\');"><img src="images/radio_stereo2.png" border="0" width="41" height="19" /></a>';
															echo '</td>';
														}
												}
												echo '</tr></table>';
												
												echo '<table border="0" cellpadding="2" cellspacing="0"><tr>';
												if(strlen($row['ym_id'])>0) {
													echo '<td align="left" valign="middle" width="1">';
													echo '<a href = "ymsgr:sendim?'.$row['ym_id'].'">'.Get_YMstatus($row['ym_id']).'</a>';
													echo '</td>';
												}
												if(strlen($row['url_twitter'])>0) {
													echo '<td align="left" valign="middle" width="1">';
													echo '<a target="blank" href = "'.$row['url_twitter'].'"><img src="images/radio_tw.png" border="0" width="18" height="18" /></a>';
													echo '</td>';
												}
												if(strlen($row['url_fb'])>0) {
													echo '<td align="left" valign="middle" width="1">';
													echo '<a target="blank" href = "'.$row['url_fb'].'"><img src="images/radio_fb.png" border="0" width="18" height="18" /></a>';
													echo '</td>';
												}												
												echo '<td>&nbsp;</td></tr></table>';
											?>
										</td>
									</tr>
									<tr>
										<td ><span class="abu f-11 pointer" onclick="loadRadioDetail('<?php echo $row['radio_id'];?>');" >More About Us</span></td>
									</tr>
									<tr>
										<td colspan="2" class="putih"><?php echo empty($tmp)? $row['nama']." - ".$row['kota'] : $row['nama'];?></td>
									</tr>
								</table>
							</td>
							
						<?php			
							
							if($j == $jml_row) {
	
								if($jml_row	 % 2 != 0) {
									echo '<td width="50%" >
											&nbsp;
									</td>';
								}
							}
								
								$i++;
								$j++;
								
								if($i == 2) {
									echo "</tr><tr>";
									$i =0;
								}
							}
						?>
						</tr>
					</table>
						