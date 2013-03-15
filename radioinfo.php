<?
include_once("inc/config.php");
include_once("inc/fungsi.php");
$cmdRadio = "SELECT r.*,tk.* FROM radio r
left join t_kota tk on (tk.id_kota=r.id_kota)
WHERE r.radio_id='$_GET[id]' and r.status=1";
$res = mysql_query($cmdRadio,$conn);
$jml_row = mysql_num_rows($res);
?>
<div style="height:78px; width: 158px; background-color: #161616;" id="streomono<?=$_GET['id']?>" onmouseout="backtonormal('<?=$_GET['id']?>')">
<div style="background: url(images/logo_thumbs/<?=$_GET['id']?>.jpg) center center no-repeat; height:78px; width: 158px; 
 filter: alpha(opacity=40);
  -moz-opacity:0.4; 
  -khtml-opacity: 0.4; 
  opacity: 0.4;">
   </div>
 <div style="position:absolute; margin-top: -60px; margin-left: 30px; width:100px" align="center">  
<? while($row = mysql_fetch_array($res)) {?>
	
											
									
                                    
                          <?  
						  
						  if($row['shoutcast']=="1") {
												
						echo '<a class="pointer" onClick="plays(\''.$row['radio_id'].'\',\'1\');stat(\''.$row['radio_id'].'\');"><img src="images/radio_stereo2.png" border="0" width="41" height="19" /></a>';
												
						}
						else{												
						echo '<a class="pointer" onClick="plays(\''.$row['radio_id'].'\',\'0\');stat(\''.$row['radio_id'].'\');"><img src="images/radio_mono2.png" border="0" width="41" height="19" /></a>';
						if($row['stereo']=="1") {
														
						echo '<a class="pointer" onClick="plays(\''.$row['radio_id'].'\',\'1\');stat(\''.$row['radio_id'].'\');"><img src="images/radio_stereo2.png" border="0" width="41" height="19" /></a>';
												}
							}				
						if(strlen($row['ym_id'])>0) {
						echo '<br/><a href = "ymsgr:sendim?'.$row['ym_id'].'">'.Get_YMstatus($row['ym_id']).'</a>';
						 }
						if(strlen($row['url_twitter'])>0) {
												
						echo '<a target="blank" href = "'.$row['url_twitter'].'"><img src="images/radio_tw.png" border="0" width="18" height="18" /></a>';
											
												          }
						if(strlen($row['url_fb'])>0) {
											
						echo '<a target="blank" href = "'.$row['url_fb'].'"><img src="images/radio_fb.png" border="0" width="18" height="18" /></a>';
												
												    }				
						   } ?>
                           <br/>
                 <a onClick="loadRadioDetail('<?=$_GET['id']?>')" class="pointer" style="color:#FFFFFF">More About Us</a>    </div>
                  </div>