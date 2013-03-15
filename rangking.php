<?
include_once("inc/config.php");
include_once("inc/fungsi.php");
$action=$_GET['action'];


$jumlahview = isset ($_GET['jumlah'])?$_GET['jumlah']:NULL;
   $q= isset ($_GET['q'])?$_GET['q']:NULL;
		if($jumlahview!=''){
		$limit=$jumlahview;
		}
		else{
		$limit='10';
		}
		
		if($q=='0'){
		$cari="";
		$back='';
		}
		
		else if($q!=''){
		$cari=" and id_kota='$q' ";
		$back=' <div style="position:absolute;
              margin-top:210px;"><a href="./">Back</a></div>';
		}
		
		else{
		$cari="";
		$back="";
		}
		if($limit=='10'){
		$tinggi="230px";
		$sepuluh="selected";
		$duapuluh="";
		$limapuluh="";
		}
		else if($limit=='20'){
		$tinggi="450px";
	    $sepuluh="";
		$duapuluh="selected";
		$limapuluh="";		}
		else{
		$tinggi="1000px";
		$sepuluh="";
		$duapuluh="";
		$limapuluh="selected";
		}
?>
 <script>
		$(document).ready(function(){
				//To switch directions up/down and left/right just place a "-" in front of the top/left attribute
				//Vertical Sliding
				//Caption Sliding (Partially Hidden to Visible)
				$('.boxgrid.caption').hover(function(){
					$(".cover", this).stop().animate({top:'-40px',height:'180px',"display": "block"},{queue:false,duration:400});
				}, function() {
					$(".cover", this).stop().animate({top:'81px'},{queue:false,duration:400});
				});
			});

	$(function() {
        $( "#tabs" ).tabs();
    });	

		$(function(){

			$('#slider').anythingSlider({
				theme           : 'metallic',
				easing          : 'easeInOutBack',
				autoPlay            : false,  
				 navigationFormatter : null,      // Details at the top of the file on this use (advanced use) 
                 navigationSize      : false, 
				  expand              : true,     // If true, the entire slider will expand to fit the parent element 
                 resizeContents      : true,    
				onSlideComplete : function(slider){
					// alert('Welcome to Slide #' + slider.currentPage);
				}
			});

		});
		
	</script>
	<ul id="slider" style="list-style: none; float:left; margin-left: 0; margin-top: 15px;">
    <?
		   		echo "<li>";
					$cmd = _select_arr("Select radio.nama,radio.stereo,radio.radio_id,radio.shoutcast,radio.url_fb,radio.url_twitter,radio.ym_id,ranking_harian.jumlah,radio.flag_24jam0,radio.flag_24jam1,radio.flag_24jam2,radio.flag_24jam3,radio.flag_24jam4,radio.flag_24jam5,radio.flag_24jam6 from radio,ranking_harian where radio.radio_id=ranking_harian.id_radio and ranking_harian.tgl='".date("Y-m-d")."' and radio.status=1 order by ranking_harian.jumlah desc limit 10");
							foreach($cmd as $num => $rs){ ?>
  							  <div class="boxgrid caption">
                             <?php
													if($rs['flag_24jam'.date("w") ]=="1") {
												?>
													<div align="right" style="position:absolute;top:-6px;right:-6px;z-index:2;height:25px;width:110px;"><img src="images/24jam_r.png"/></div>
												<?php } ?>
								<img src="images/logo/<?=$rs['radio_id']?>.jpg" width="166" height="80" class="boxgridimg"/>
   									<div class="cover boxcaption">
                 						<?=$rs['nama']?>
                     						 <p>
                        						<br/>
												<? 
	 													if($rs['shoutcast']=="1") {
															echo '<a class="pointer" onClick="plays(\''.$rs['radio_id'].'\',\'1\');stat(\''.$rs['radio_id'].'\');"><img src="images/radio_stereo2.png" border="0" width="41" height="19" /></a>';
														}
														else{												
															echo '<a class="pointer" onClick="plays(\''.$rs['radio_id'].'\',\'0\');stat(\''.$rs['radio_id'].'\');"><img src="images/radio_mono2.png" border="0" width="41" height="19" /></a>';
																if($rs['stereo']=="1") {							
																	echo '<a class="pointer" onClick="plays(\''.$rs['radio_id'].'\',\'1\');stat(\''.$rs['radio_id'].'\');"><img src="images/radio_stereo2.png" border="0" width="41" height="19" /></a>';
																}
														}
														echo "<br/>";
														if(strlen($rs['ym_id'])>0) {
																	echo '<br/><a href = "ymsgr:sendim?'.$rs['ym_id'].'"><img src="http://opi.yahoo.com/online?u='.$rs['ym_id'].'&amp;m=g&amp;t=1"></a>';
														 }
														if(strlen($rs['url_twitter'])>0) {						
																	echo '<a target="blank" href = "'.$rs['url_twitter'].'"><img src="images/radio_tw.png" border="0" width="18" height="18" /></a>';
														}
														if(strlen($rs['url_fb'])>0) {					
																	echo '<a target="blank" href = "'.$rs['url_fb'].'"><img src="images/radio_fb.png" border="0" width="18" height="18" /></a>';
														}						
	?>
       													<br/>
              													   <a onClick="loadRadioDetail('<?=$rs['radio_id']?>')" class="pointer" style="color:#FFFFFF">More About Us</a>   	
                 							</p>						
									</div>
								</div>
                      	 <? } ?>
                    </li>  
		          
     	</ul><!-- End Slider area -->
 
 <?  exit; ?>